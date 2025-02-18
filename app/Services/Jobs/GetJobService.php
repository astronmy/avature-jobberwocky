<?php

namespace App\Services\Jobs;

use App\Repositories\JobRepository;

final readonly  class GetJobService {

    public function __construct(private readonly JobRepository $jobRepository) {}

    public function __invoke() : array
    {
        return $this->jobRepository->all()->toArray();
    }

}
