<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default 'teachers'
    protected $table = 'teachers'; 

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'school_id', // Assuming there's a relationship with a school
    ];

    // Optionally, define relationships here (e.g., with classes or schools)
    public function classes()
    {
        return $this->hasMany(ClassType::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
