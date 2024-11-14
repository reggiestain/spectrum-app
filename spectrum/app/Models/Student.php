<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name','school_id', 'parent_id','birth_date',
        'neuro_class_id','therapist_id','address','teacher_id','condition'
    ];

    // Relationships
    public function therapists()
    {
        return $this->belongsToMany(Therapist::class, 'student_therapists', 'student_id', 'therapist_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class);
    }

    public function class()
    {
        return $this->belongsTo(NeuroClass::class,'neuro_class_id','id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
