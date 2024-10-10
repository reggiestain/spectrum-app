<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone','therapy_category_id',
                           'school_id','therapy_category_id','specialization', 'bio'];

    public function category() {
        return $this->belongsTo(TherapyCategory::class,"therapy_category_id","id");
    }
}
