<?php

namespace App\Listeners;

use App\Enums\AlertMethodEnum;
use App\Events\JobCreated;
use App\Mail\NewJobAlert;
use App\Repositories\SubscriberRepository;
use Illuminate\Support\Facades\Mail;

class SendJobNotification
{
    public function handle(JobCreated $event)
    {
        $repository = app()->make(SubscriberRepository::class);

        $job = $event->job;

        $preferences = [
            'job_name' => $job->name,
            'salary_min' => $job->salary,
            'salary_max' => $job->salary,
            'country' => $job->country,
            'modality' => $job->modality,
        ];

        $subscribers = $repository->all();
        foreach ($subscribers as $subscriber) {
            if ($this->matchesPreferences($subscriber, $job)) {
                if ($subscriber->alert_method == AlertMethodEnum::EMAIL->value) {
                    Mail::to($subscriber->email)->send(new NewJobAlert($job));
                }
            }
        }
    }

    private function matchesPreferences($subscriber, $job): bool
    {

        $preferences = $subscriber->job_preferences;
        return in_array($job->modality, explode(',',$preferences['modality']) ?? [])
            || in_array($job->country, explode(',',$preferences['country']) ?? []);
    }

}
