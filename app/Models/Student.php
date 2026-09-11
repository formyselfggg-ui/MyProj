<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'student_id',
    'first_name',
    'middle_name',
    'last_name',
    'gender',
    'age',
    'course',
    'year_level',
    'email',
    'phone',
])]
class Student extends Model
{
    /** @use HasFactory<StudentFactory> */
    use HasFactory;
}
