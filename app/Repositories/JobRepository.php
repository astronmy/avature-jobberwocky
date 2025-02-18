<?php

namespace App\Repositories;

use App\Dtos\Jobs\JobDto;
use App\Models\JobOffer;
use App\Repositories\Interfaces\JobInterface;
use Illuminate\Support\Collection;
use MongoDB\Laravel\Eloquent\Builder;

class JobRepository implements JobInterface
{

    public function __construct(private readonly JobOffer $model)
    {
    }
    public function all(): Collection
    {
        return collect($this->model->query()->get());
    }

    public function searchByParams(array $params = null): Collection
    {
        return $this->model->query()
            ->when(isset($params['name']), fn(Builder$query) => $query->where('name', 'like', '%' . $params['name'] . '%'))
            ->when(isset($params['salary_min']), fn(Builder $query) => $query->where('salary', '>=', $params['salary_min']))
            ->when(isset($params['salary_max']), fn(Builder $query) => $query->where('salary', '<=', $params['salary_max']))
            ->when(isset($params['country']), fn(Builder $query) => $query->where('country', $params['country']))
            ->get();
    }

    public function findById(string $id): JobOffer
    {
        return $this->model->query()->findOrFail($id);
    }

    public function create(JobDto $job): JobOffer
    {
        return $this->model->query()->create($job->toArray());
    }

    public function update(string $id, array $data): ?JobOffer
    {
        $job = $this->findById($id);
        $job->update($data);
        return $job;
    }

    public function delete(string $id): bool
    {
        return $this->model->query()->where('_id', $id)->delete();
    }
}
