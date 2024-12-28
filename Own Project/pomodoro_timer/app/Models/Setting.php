<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'work_time',
        'break_time',
        'focus_sound',
        'break_sound',
    ];
}
