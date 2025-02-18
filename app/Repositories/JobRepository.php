<?php

namespace App\Repositories;

use App\Dtos\Jobs\JobDto;
use App\Models\JobOffer;
use App\Repositories\Interfaces\JobInterface;
use Illuminate\Support\Collection;

class JobRepository implements JobInterface
{

    public function __construct(private readonly JobOffer $model)
    {
    }
    public function all(): Collection
    {
        return collect($this->model->query()->get());
    }

    public function findById(string $id): ?JobOffer
    {
        return $this->model->query()->find($id);
    }

    public function create(JobDto $job): JobOffer
    {
        return $this->model->query()->create($job->toArray());
    }

    public function update(string $id, array $data): ?JobOffer
    {
        $job = $this->findById($id);
        if (!$job) return null;

        $job->update($data);
        return $job;
    }

    public function delete(string $id): bool
    {
        return $this->model->query()->where('_id', $id)->delete();
    }
}
