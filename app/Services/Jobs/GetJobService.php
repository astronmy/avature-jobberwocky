<?php

namespace App\Services\Jobs;

use App\Repositories\JobRepository;

final class GetJobService {

    public function __construct(
        private readonly JobRepository $jobRepository
    ) {}

    public function __invoke(?string $id = null) : \Illuminate\Support\Collection|\App\Models\JobOffer
    {
        return $id == null ?
            $this->jobRepository->all() :
            $this->jobRepository->findById($id);
    }

}
