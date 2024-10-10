<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default 'class_types'
    protected $table = 'class_types'; 

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',           // Name of the class type (e.g., "Math", "Science", "Therapy")
        'description',    // Description of the class type
        'teacher_id',     // Assuming each class type is associated with a teacher
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
