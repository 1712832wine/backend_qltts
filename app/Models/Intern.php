<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'major',
        'school_year',
        'cv_file',
        'start_date',
        'end_date',
        'result'
    ];
}
