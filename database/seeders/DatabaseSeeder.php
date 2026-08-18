<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Petugas Admin',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator System',
                'password' => Hash::make('password123'),
            ]
        );

        // Sample Students
        $student1 = Student::create([
            'nim' => '202001001',
            'nama' => 'Ahmad Rizky Pratama',
            'angkatan' => '2020',
            'no_tlp' => '081234567890',
            'email' => 'rizky@student.ac.id',
            'status_lulus' => 'Lulus',
        ]);


        $student3 = Student::create([
            'nim' => '202101003',
            'nama' => 'Budi Santoso',
            'angkatan' => '2021',
            'no_tlp' => '085612345678',
            'email' => 'santoso@student.ac.id',
            'status_lulus' => 'Belum Lulus',
        ]);



        $student5 = Student::create([
            'nim' => '202001005',
            'nama' => 'Doni Prasetyo',
            'angkatan' => '2020',
            'no_tlp' => '081355667788',
            'email' => 'prasetyo@student.ac.id',
            'status_lulus' => 'Lulus',
        ]);

        // Sample Submissions
        Submission::create([
            'student_id' => $student1->id,
            'judul' => 'Sistem Informasi Geografis Pemetaan Fasilitas Umum',
            'tipe' => 'skripsi',
            'tanggal_penyerahan' => '2026-07-15',
            'status' => 'Sudah Menyerahkan',
            'petugas_penerima' => 'Drs. Hendra M.T.',
        ]);


        Submission::create([
            'student_id' => $student3->id,
            'judul' => 'Aplikasi Manajemen Berbasis Web pada PT Areta',
            'tipe' => 'kkp',
            'tanggal_penyerahan' => '2026-08-01',
            'status' => 'Sudah Menyerahkan',
            'petugas_penerima' => 'Rian Hidayat S.T.',
        ]);


        Submission::create([
            'student_id' => $student5->id,
            'judul' => 'Rancang Bangun Network Security Operations Center',
            'tipe' => 'ta',
            'tanggal_penyerahan' => '2026-07-28',
            'status' => 'Sudah Menyerahkan',
            'petugas_penerima' => 'Drs. Hendra M.T.',
        ]);
    }
}
