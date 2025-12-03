<!DOCTYPE html>
<html>
<head>
    <title>Import Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; max-width: 600px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
        input[type=file] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #007bff; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>📊 Upload CSV Siswa</h2>
    
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".csv" required>
        <button type="submit">🚀 Import Sekarang</button>
    </form>
    
    <p><small>Format CSV: kelas,nis,nama</small></p>
</body>
</html>
