<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobOfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? $this->_id,
            'name' => $this->name,
            'company' => $this->company,
            'location' => $this->location,
            'description' => $this->description,
            'modality' => $this->modality,
            'country' => $this->country,
            'salary' => $this->salary,
            'skills' => $this->skills,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
