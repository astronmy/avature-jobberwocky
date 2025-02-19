<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? $this->_id,
            'name' => $this->name,
            'email' => $this->email,
            'alert_method' => $this->alert_method,
            'job_preferences' => [
                'job_name' => $this->job_preferences['job_name'] ?? null,
                'salary_min' => $this->job_preferences['salary_min'] ?? null,
                'salary_max' => $this->job_preferences['salary_max'] ?? null,
                'country' => $this->job_preferences['country'] ?? [],
                'modality' => $this->job_preferences['modality'] ?? [],
            ],
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
