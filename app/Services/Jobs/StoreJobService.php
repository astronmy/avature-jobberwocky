<?php

namespace App\Services\Jobs;

use App\Dtos\Jobs\JobDto;
use App\Repositories\JobRepository;

final class StoreJobService {

    public function __construct(private readonly JobRepository $jobRepository) {}

    public function __invoke(JobDto $jobData) : object
    {
        return $this->jobRepository->create($jobData);
    }

}
