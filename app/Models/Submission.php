<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'judul',
        'tipe',
        'tanggal_penyerahan',
        'status',
        'petugas_penerima',
    ];

    protected $casts = [
        'tanggal_penyerahan' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
