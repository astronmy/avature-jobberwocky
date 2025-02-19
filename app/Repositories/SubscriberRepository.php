<?php

namespace App\Repositories;

use App\DTOs\Subscribers\SubscriberDTO;
use App\Models\Subscriber;
use App\Repositories\Interfaces\SubscribersInterface;
use Illuminate\Support\Collection;

class SubscriberRepository implements SubscribersInterface
{

    public function __construct(private readonly Subscriber $model)
    {
    }
    public function findByPreferences(array $preferences = null): Collection
    {
        return $this->model->query()
            ->get()
            ->filter(function ($subscriber) use ($preferences) {
                $jobPreferences = is_string($subscriber->job_preferences)
                    ? json_decode($subscriber->job_preferences, true)
                    : $subscriber->job_preferences;

                if (!is_array($jobPreferences)) {
                    return false;
                }

                return collect([
                    !isset($preferences['job_name']) ||
                    str_contains(strtolower($jobPreferences['job_name'] ?? ''), strtolower($preferences['job_name'])),

                    !isset($preferences['salary_min']) ||
                    (float) $preferences['salary_min'] <= (float) ($jobPreferences['salary_min'] ?? 0),

                    !isset($preferences['salary_max']) ||
                    (float) $preferences['salary_max'] >= (float) ($jobPreferences['salary_max'] ?? 0),

                    !isset($preferences['country']) ||
                    (is_array($preferences['country'])
                        ? count(array_intersect($preferences['country'], $jobPreferences['country'] ?? [])) > 0
                        : in_array($preferences['country'], $jobPreferences['country'] ?? [])
                    ),

                    !isset($preferences['modality']) ||
                    (is_array($preferences['modality'])
                        ? count(array_intersect($preferences['modality'], $jobPreferences['modality'] ?? [])) > 0
                        : in_array($preferences['modality'], $jobPreferences['modality'] ?? [])
                    ),
                ])->every(fn($condition) => $condition);
            });
    }

    public function create(SubscriberDTO $dto): Subscriber
    {
        return $this->model->query()->create($dto->toArray());
    }

    public function all(): Collection
    {
        return collect($this->model->query()->get());
    }

}
