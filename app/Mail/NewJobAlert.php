<?php

namespace App\Mail;

use App\Models\JobOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewJobAlert extends Mailable
{
    use Queueable, SerializesModels;

    public JobOffer $job;

    public function __construct(JobOffer $job)
    {
        $this->job = $job;
    }

    public function build()
    {
        return $this->subject('New Job Offer: ' . $this->job->name)
            ->view('emails.job_offer_notification')
            ->with(['job' => $this->job]);
    }
}
