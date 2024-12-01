<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';

    // Attributes that can be mass-assigned
    protected $fillable = [
        'emp_name',
        'dob',
        'phone',
        'job_position',
        'address',
        'email',
        'image',
        'salary',
        'status',
    ];

    // Attribute casting
    protected $casts = [
        'dob' => 'date',           // Ensure `dob` is always a date instance
        'salary' => 'decimal:2',   // Store salary as a decimal with 2 decimal places
        'status' => 'boolean',     // Ensure status is a boolean value
    ];
}
