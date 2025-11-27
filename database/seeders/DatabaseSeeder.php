<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Hisyam Sayyid Alzam',
                'email' => 'hisyam@gmail.com',
                'password' => bcrypt('hisyam123'),
                'roles' => ['operator'],
            ],
            [
                'name' => 'Hendra Detha Pratama',
                'email' => 'hendra@gmail.com',
                'password' => bcrypt('hendra123'),
                'roles' => ['operator'],
            ],
            [
                'name' => 'Nesya Ainurosi',
                'email' => 'nesya@gmail.com',
                'password' => bcrypt('nesya123'),
                'roles' => ['operator'],
            ],
            [
                'name' => 'Fanny Indriyani',
                'email' => 'fannycantik@gmail.com',
                'password' => bcrypt('fanny123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Foony Krisnawulan Prihatini',
                'email' => 'foony@gmail.com',
                'password' => bcrypt('foony123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Khairul Arifin',
                'email' => 'khairul@gmail.com',
                'password' => bcrypt('kahirul123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Anggi Laras Pratiwi',
                'email' => 'anggi@gmail.com',
                'password' => bcrypt('anggi123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Qisthina Arsi Febriani',
                'email' => 'qisti@gmail.com',
                'password' => bcrypt('qisti123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Arif Rahmadi',
                'email' => 'rahmadi@gmail.com',
                'password' => bcrypt('rahmadi123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Miftahul Zannah',
                'email' => 'miftahcayang@gmail.com',
                'password' => bcrypt('miftah123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Muhammad Usman',
                'email' => 'usman@gmail.com',
                'password' => bcrypt('usman123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Nurina Kartika Ayu',
                'email' => 'nurina@gmail.com',
                'password' => bcrypt('nurina123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Dalilah',
                'email' => 'dalilah@gmail.com',
                'password' => bcrypt('dalilah123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Dwiadi Eliyanto',
                'email' => 'dwiadi@gmail.com',
                'password' => bcrypt('dwiadi123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Maidya Nengsih',
                'email' => 'maidya@gmail.com',
                'password' => bcrypt('maidya123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Samuel Wicaksana',
                'email' => 'samuel@gmail.com',
                'password' => bcrypt('samuel123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Faradillah Aryani',
                'email' => 'faradillah@gmail.com',
                'password' => bcrypt('farah123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Dwi Yuniastuti',
                'email' => 'dwi@gmail.com',
                'password' => bcrypt('dwi123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Mexi Noviyanti',
                'email' => 'mexi@gmail.com',
                'password' => bcrypt('mexi123'),
                'roles' => ['walas', 'guru_piket'],
            ],
            [
                'name' => 'Azizah Khoiro Nissah',
                'email' => 'azizah@gmail.com',
                'password' => bcrypt('azizah123'),
                'roles' => ['walas'],
            ],
            [
                'name' => 'Nurhayatul Fadilla',
                'email' => 'fadilla@gmail.com',
                'password' => bcrypt('fadilla123'),
                'roles' => ['walas'],
            ],
        ];

        foreach ($users as $user){
            User::factory()->create($user);
        }
    }
}
