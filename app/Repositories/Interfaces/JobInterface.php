<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Jobs\JobDto;
use App\Models\JobOffer;
use Illuminate\Support\Collection;

interface JobInterface
{
    public function all(): Collection;
    public function findById(string $id): ?JobOffer;
    public function create(JobDto $job): JobOffer;
    public function update(string $id, array $data): ?JobOffer;
    public function delete(string $id): bool;
}
