<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => ['required', 'string', 'max:20', 'unique:students,nim'],
            'nama' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'string', 'max:10'],
            'no_tlp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'status_lulus' => ['required', 'string', 'max:50'],
        ]);

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        $student->load('submissions');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nim' => ['required', 'string', 'max:20', 'unique:students,nim,' . $student->id],
            'nama' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'string', 'max:10'],
            'no_tlp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'status_lulus' => ['required', 'string', 'max:50'],
        ]);

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
