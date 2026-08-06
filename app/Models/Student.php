<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'no_tlp',
        'email',
        'status_lulus',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
