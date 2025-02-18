<?php

namespace App\Services\Jobs;

use App\Dtos\Jobs\JobDto;
use App\Repositories\JobRepository;

final readonly class StoreJobService {

    public function __construct(private JobRepository $jobRepository) {}

    public function __invoke(JobDto $jobData) : array
    {
        $job = $this->jobRepository->create($jobData);
        return [$job];
    }

}
