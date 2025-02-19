<?php

namespace App\Events;

use App\Models\JobOffer;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobCreated
{
    use Dispatchable, SerializesModels;

    public JobOffer $job;

    public function __construct(JobOffer $job)
    {
        $this->job = $job;
    }
}
