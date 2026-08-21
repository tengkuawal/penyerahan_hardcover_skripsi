<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::query()
            ->join('students', 'submissions.student_id', '=', 'students.id')
            ->select('submissions.*')
            ->with('student');

        $statusFilter = $request->get('status');

        if ($statusFilter === 'sudah') {
            $query->whereIn('submissions.status', ['sudah', 'Sudah Menyerahkan']);
        } elseif ($statusFilter === 'belum') {
            $query->whereIn('submissions.status', ['belum', 'Belum Menyerahkan']);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('submissions.judul', 'like', "%{$search}%")
                  ->orWhere('submissions.petugas_penerima', 'like', "%{$search}%")
                  ->orWhere('submissions.tipe', 'like', "%{$search}%")
                  ->orWhere('students.nama', 'like', "%{$search}%")
                  ->orWhere('students.nim', 'like', "%{$search}%");
            });
        }

        $submissions = $query->orderBy('students.nama', 'asc')->get();

        // Mahasiswa yang belum memiliki record penyerahan sama sekali (jika filter 'belum')
        $studentsWithoutSubmissions = collect();
        if ($statusFilter === 'belum') {
            $studentQuery = Student::whereDoesntHave('submissions');
            if ($request->filled('search')) {
                $search = trim($request->search);
                $studentQuery->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('nim', 'like', "%{$search}%");
                });
            }
            $studentsWithoutSubmissions = $studentQuery->orderBy('nama', 'asc')->get();
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

    public function byType(Request $request, $type)
    {
        $type = strtolower($type);
        if (!in_array($type, ['skripsi', 'kkp', 'ta'])) {
            return redirect()->route('submissions.index');
        }

        $query = Submission::query()
            ->join('students', 'submissions.student_id', '=', 'students.id')
            ->select('submissions.*')
            ->where('submissions.tipe', $type)
            ->with('student');

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('submissions.judul', 'like', "%{$search}%")
                  ->orWhere('submissions.petugas_penerima', 'like', "%{$search}%")
                  ->orWhere('students.nama', 'like', "%{$search}%")
                  ->orWhere('students.nim', 'like', "%{$search}%");
            });
        }

        $submissions = $query->orderBy('students.nama', 'asc')->get();

        $titles = [
            'skripsi' => 'Skripsi (Cover Orange)',
            'kkp' => 'KKP (Kuliah Kerja Praktek)',
            'ta' => 'TA (Cover Blue)',
        ];
        $title = $titles[$type] ?? strtoupper($type);

        return view('submissions.type', compact('submissions', 'title', 'type'));
    }
}
