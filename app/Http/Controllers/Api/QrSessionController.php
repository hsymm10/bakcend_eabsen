<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QrSession;
use App\Models\AttendanceScan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QrSessionController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'qr_text' => 'required|string|max:500',
            'expiry_hours' => 'nullable|integer|min:0|max:23',
            'expiry_minutes' => 'nullable|integer|min:0|max:59',
            'size' => 'nullable|integer|min:100|max:1000'
        ]);

        // Generate unique code
        do {
            $code = Str::random(12);
        } while (
            AttendanceScan::where('code', $code)->exists() ||
            QrSession::where('code', $code)->exists()
        );

        // Hitung expiry time
        $expiryHours = $request->expiry_hours ?? 0;
        $expiryMinutes = $request->expiry_minutes ?? 30;
        $expiryTime = Carbon::now()->addHours($expiryHours)->addMinutes($expiryMinutes);

        // Simpan QR session
        $qrSession = QrSession::create([
            'code' => $code,
            'qr_text' => $request->qr_text,
            'size' => $request->size ?? 300,
            'expiry_time' => $expiryTime,
            'is_active' => true,
            'generated_by' => Auth::id() ?? 1 // Default user ID untuk test
        ]);

        // Generate QR URL
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$qrSession->size}x{$qrSession->size}&data=" .
            urlencode($request->qr_text . "?code={$code}");

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $qrSession->id,
                'code' => $qrSession->code,
                'qr_url' => $qrUrl,
                'qr_text' => $request->qr_text,
                'size' => $qrSession->size,
                'expiry_time' => $expiryTime->format('Y-m-d H:i:s'),
                'expiry_formatted' => $expiryTime->translatedFormat('l, d F Y \j a \p H:i'),
                'is_active' => true
            ]
        ], 201);
    }

    /**
     * List semua QR sessions (TEST MODE)
     */
    public function index()
    {
        $sessions = QrSession::withCount(['attendances as attendance_count'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($session) {
                $isActive = $session->is_active && $session->expiry_time->isFuture();

                return [
                    'id' => $session->id,
                    'code' => $session->code,
                    'qr_text' => $session->qr_text,
                    'size' => $session->size,
                    'attendance_count' => $session->attendance_count,
                    'created_at' => $session->created_at->translatedFormat('d M Y H:i'),
                    'expires_at' => $session->expiry_time->translatedFormat('d M Y H:i'),
                    'is_active' => $isActive,
                    'is_expired' => $session->expiry_time->isPast(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $sessions
        ]);
    }

    /**
     * TEST ENDPOINT - List QR untuk debug
     */
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'QrSessionController berjalan!',
            'qr_sessions_count' => QrSession::count(),
            'latest_qr' => QrSession::latest()->first()?->only(['code', 'qr_text', 'expiry_time'])
        ]);
    }
}
