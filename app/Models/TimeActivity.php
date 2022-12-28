<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeActivity extends Model
{
    use HasFactory;

    protected $fillable = ['userId', 'projectId', 'todoId', 'time_spent'];
}
