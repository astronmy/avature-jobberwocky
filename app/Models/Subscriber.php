<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'subscribers';
    protected $fillable = [
        'email', 'name', 'job_preferences', 'alert_method'
    ];
    protected $casts = [
        'job_preferences' => 'array',
        'alert_method' => 'array',
    ];

}
