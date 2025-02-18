<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class JobOffer extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jobs_offers';
    protected $fillable = [
        'title', 'company', 'location', 'description', 'modality', 'skills', 'created_at'
    ];
    protected $casts = [
        'skills' => 'array',
        'created_at' => 'datetime',
    ];
}
