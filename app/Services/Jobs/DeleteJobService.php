<?php

namespace App\Services\Jobs;

use App\Repositories\JobRepository;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

final class DeleteJobService {
    public function __construct(
        private readonly JobRepository $jobRepository
    ) {}

    public function __invoke(?string $id = null) : void
    {
        $status = $this->jobRepository->delete($id);
        if( !$status ) {
            throw new ConflictHttpException(message: "Job couldn't be deleted", code: 100);
        }
    }

}
