<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Student::count();
        $sudahMenyerahkan = Submission::whereIn('status', ['sudah', 'Sudah Menyerahkan'])->count();
        $belumMenyerahkan = max($totalMahasiswa - $sudahMenyerahkan, 0);

        $countSkripsi = Submission::where('tipe', 'skripsi')->count();
        $countKkp = Submission::where('tipe', 'kkp')->count();
        $countTa = Submission::where('tipe', 'ta')->count();

        $latestSubmissions = Submission::with('student')->latest()->take(6)->get();

        return view('dashboard.index', compact(
            'totalMahasiswa',
            'sudahMenyerahkan',
            'belumMenyerahkan',
            'countSkripsi',
            'countKkp',
            'countTa',
            'latestSubmissions'
        ));
    }
}
