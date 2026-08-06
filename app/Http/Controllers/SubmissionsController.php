<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::with('student');
        $statusFilter = $request->get('status');

        if ($statusFilter === 'sudah') {
            $query->whereIn('status', ['sudah', 'Sudah Menyerahkan']);
        } elseif ($statusFilter === 'belum') {
            $query->whereIn('status', ['belum', 'Belum Menyerahkan']);
        }

        $submissions = $query->latest()->get();

        // Mahasiswa yang belum memiliki record penyerahan sama sekali (jika filter 'belum')
        $studentsWithoutSubmissions = collect();
        if ($statusFilter === 'belum') {
            $studentsWithoutSubmissions = Student::whereDoesntHave('submissions')->get();
        }

        return view('submissions.index', compact('submissions', 'statusFilter', 'studentsWithoutSubmissions'));
    }

    public function create()
    {
        $students = Student::orderBy('nama')->get();

        return view('submissions.create', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:skripsi,kkp,ta'],
            'tanggal_penyerahan' => ['nullable', 'date'],
            'status' => ['required', 'string'],
            'petugas_penerima' => ['nullable', 'string', 'max:100'],
        ]);

        Submission::create($data);

        return redirect()->route('submissions.index')->with('success', 'Data penyerahan hardcover berhasil ditambahkan.');
    }

    public function show(Submission $submission)
    {
        $submission->load('student');

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json($submission);
        }

        return view('submissions.show', compact('submission'));
    }

    public function edit(Submission $submission)
    {
        $students = Student::orderBy('nama')->get();

        return view('submissions.edit', compact('submission', 'students'));
    }

    public function update(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'judul' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'in:skripsi,kkp,ta'],
            'tanggal_penyerahan' => ['nullable', 'date'],
            'status' => ['required', 'string'],
            'petugas_penerima' => ['nullable', 'string', 'max:100'],
        ]);

        $submission->update($data);

        return redirect()->route('submissions.index')->with('success', 'Data penyerahan hardcover berhasil diperbarui.');
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Data penyerahan hardcover berhasil dihapus.');
    }

    public function byType($type)
    {
        $type = strtolower($type);
        if (!in_array($type, ['skripsi', 'kkp', 'ta'])) {
            return redirect()->route('submissions.index');
        }

        $submissions = Submission::with('student')->where('tipe', $type)->latest()->get();

        $titles = [
            'skripsi' => 'Skripsi (Cover Orange)',
            'kkp' => 'KKP (Kuliah Kerja Praktek)',
            'ta' => 'Tugas Akhir / TA (Cover Biru)',
        ];
        $title = $titles[$type] ?? strtoupper($type);

        return view('submissions.type', compact('submissions', 'title', 'type'));
    }
}
