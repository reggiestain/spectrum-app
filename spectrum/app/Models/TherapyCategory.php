<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapyCategory extends Model
{
    use HasFactory;

    use HasFactory;

    // Define which columns are mass-assignable
    protected $fillable = ['name', 'description'];
}
