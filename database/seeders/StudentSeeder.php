<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definisikan kelas dan data siswanya
        $kelasData = [
            'XI RPL 2' => [
                ['nis' => '1004', 'nama' => 'Adrian Tegar Arya Putranto'],
                ['nis' => '1005', 'nama' => 'Aldiansyah Putra Hidayat'],
                ['nis' => '1006', 'nama' => 'Alif Setyo Nugroho'],
                ['nis' => '1007', 'nama' => 'Aliyatul Alya'],
                ['nis' => '1008', 'nama' => 'Atika Sapitri'],
                ['nis' => '1009', 'nama' => 'Cedric Naddif Digori'],
                ['nis' => '1010', 'nama' => 'Citra Handayani'],
                ['nis' => '1011', 'nama' => 'Danu Satya Rachman'],
                ['nis' => '1013', 'nama' => 'Faruq'],
                ['nis' => '1014', 'nama' => 'Fenisa Dwi Serviani'],
                ['nis' => '1015', 'nama' => 'Hisyam Sayyid Alzam'],
                ['nis' => '1186', 'nama' => 'Joy Christian Panduwinata'],
                ['nis' => '1017', 'nama' => 'Kusumah Habibi'],
                ['nis' => '1018', 'nama' => 'Livia Agustina Dima Istyyawati'],
                ['nis' => '1019', 'nama' => 'M. Aldrich'],
                ['nis' => '1020', 'nama' => 'Masayu Febriana'],
                ['nis' => '1022', 'nama' => 'Muhamad Iqbal'],
                ['nis' => '1023', 'nama' => 'Naurah Nur Faizah'],
                ['nis' => '1024', 'nama' => 'Nazril Galang Saputra'],
                ['nis' => '1025', 'nama' => 'Nesya Ainurrosi'],
                ['nis' => '1026', 'nama' => 'Rafi Ramadhan'],
                ['nis' => '1027', 'nama' => 'Rahmad Fadhil Herdiyanto'],
                ['nis' => '1028', 'nama' => 'Reyya Harisa Fitri'],
                ['nis' => '1029', 'nama' => 'Rifka Anggraini Putri Andini'],
                ['nis' => '1030', 'nama' => 'Sabitha Naura Zahra'],
                ['nis' => '1031', 'nama' => 'Safira Fitriani'],
                ['nis' => '1032', 'nama' => 'Salwa Salsabila'],
                ['nis' => '1033', 'nama' => 'Shafa Dhiya Hasanah'],
                ['nis' => '1034', 'nama' => 'Sheilla Aprilia Rachel Ibanez'],
                ['nis' => '1035', 'nama' => 'Steaven Octavian Galang'],
                ['nis' => '1036', 'nama' => 'Sultan Bagaskara'],
                ['nis' => '1037', 'nama' => 'Vivian Egri Mahdania'],
                ['nis' => '1038', 'nama' => 'Yogi Nur Isa'],
                ['nis' => '1039', 'nama' => 'Zakky Dillarro Ikhwan'],
            ],
            // Tambah kelas lain di sini
            'XI RPL 1' => [
                ['nis' => '120001', 'nama' => 'Ahmad Syahroni'],
                ['nis' => '120002', 'nama' => 'Yusuf'],
                ['nis' => '120003', 'nama' => 'Budi Sulistyo'],
                ['nis' => '120004', 'nama' => 'Marsel Hermawan'],
            ],
            // sample jika kelas lebih dari 2 atau seterusnya
        ];

        foreach ($kelasData as $kelas => $siswaList) {
            foreach ($siswaList as $studentData) {
                Student::firstOrCreate(
                    ['nis' => $studentData['nis']],
                    [
                        'kelas' => $kelas,
                        'nis' => $studentData['nis'],
                        'nama' => $studentData['nama']
                    ]
                );
            }
        }
    }
}
