<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'therapist_id',
        'report_title',
        'file_path',
        'file_type',
        'notes',
        'file_size',
        'report_date',
    ];

    // Relationship with Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship with Therapist (assuming Therapist model exists)
    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}
