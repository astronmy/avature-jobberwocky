<?php

namespace App\Services\Jobs;

use App\Dtos\Jobs\JobDto;
use App\Events\JobCreated;
use App\Repositories\JobRepository;

final class StoreJobService {

    public function __construct(private readonly JobRepository $jobRepository) {}

    public function __invoke(JobDto $jobData) : object
    {
        $job = $this->jobRepository->create($jobData);

        event(new JobCreated($job));

        return $job;
    }

}
