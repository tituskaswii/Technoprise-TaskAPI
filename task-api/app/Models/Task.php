<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'due_date'
    ];

    // Define default values
    protected $attributes = [
        'status' => 'pending',
    ];

    // Mutators to ensure 'due_date' is a valid date
    protected $casts = [
        'due_date' => 'datetime',
    ];
}
