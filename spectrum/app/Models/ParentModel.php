<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default 'parents'
    protected $table = 'parents'; 

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address'
    ];

    // Optionally, you can define relationships here (e.g., with students)
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
