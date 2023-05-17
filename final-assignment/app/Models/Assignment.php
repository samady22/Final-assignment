<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'question',
        'image_path',
        'solution',
        'status',
        'points',
        'answer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
