<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HardcoverSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_dashboard_statistics(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
        ]);

        Student::create([
            'nim' => '2023001',
            'nama' => 'Rina',
            'angkatan' => '2023',
            'no_tlp' => '081234567890',
            'email' => 'rina@example.com',
            'status_lulus' => 'Belum Lulus',
        ]);

        Student::create([
            'nim' => '2023002',
            'nama' => 'Budi',
            'angkatan' => '2023',
            'no_tlp' => '081234567891',
            'email' => 'budi@example.com',
            'status_lulus' => 'Lulus',
        ]);

        Submission::create([
            'student_id' => 1,
            'judul' => 'Skripsi A',
            'tipe' => 'skripsi',
            'tanggal_penyerahan' => '2026-08-04',
            'status' => 'sudah',
            'petugas_penerima' => 'Dina',
        ]);

        Submission::create([
            'student_id' => 2,
            'judul' => 'KKP B',
            'tipe' => 'kkp',
            'tanggal_penyerahan' => null,
            'status' => 'belum',
            'petugas_penerima' => null,
        ]);

        $response = $this->actingAs(User::find(1))->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Total Mahasiswa');
        $response->assertSee('2');
        $response->assertSee('Sudah Menyerahkan');
        $response->assertSee('1');
        $response->assertSee('Belum Menyerahkan');
        $response->assertSee('1');
    }
}
