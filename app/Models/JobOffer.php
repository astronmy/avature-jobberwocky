<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'jobs_offers';
    protected $fillable = [
        'name', 'company', 'location', 'description', 'modality', 'skills', 'created_at',
        'country', 'salary'
    ];
    protected $casts = [
        'skills' => 'array',
        'created_at' => 'datetime',
    ];
}
