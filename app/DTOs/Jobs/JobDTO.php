<?php

namespace App\Dtos\Jobs;

final class JobDto
{
    private const MODALITY_OPTIONS = ['remote', 'hybrid', 'presential', 'part-time', 'full-time'];

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $company,
        public readonly string $location,
        public readonly string $description,
        public readonly string $modality,
        public readonly mixed $skills,
        public readonly float $salary,
        public readonly string $country,
        public readonly string $created_at,
    ) {}

    public static function fromArray(array $data): self
    {
        $instance = new self(
            id: $data['id'] ?? uniqid(),
            name: $data['name'] ?? 'No Name',
            company: $data['company'] ?? 'Unknown Company',
            location: $data['location'] ?? 'Remote',
            description: $data['description'] ?? '',
            modality: $data['modality'] ?? 'remote',
            skills: $data['skills'] ?? '',
            salary: isset($data['salary']) ? (float) $data['salary'] : 0.0,
            country: $data['country'] ?? 'Unknown',
            created_at: $data['created_at'] ?? now()->toDateTimeString(),
        );

        return $instance->sanitize();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->company,
            'location' => $this->location,
            'description' => $this->description,
            'modality' => $this->modality,
            'skills' => implode(',', $this->skills),
            'salary' => $this->salary,
            'country' => $this->country,
            'created_at' => $this->created_at,
        ];
    }

    private function sanitize(): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            company: $this->company,
            location: $this->location,
            description: $this->description,
            modality: $this->validateModality($this->modality),
            skills: $this->parseSkills($this->skills),
            salary: max(0, $this->salary),
            country: $this->country,
            created_at: $this->created_at,
        );
    }

    private function validateModality(string $modality): string
    {
        return in_array(strtolower($modality), self::MODALITY_OPTIONS) ? strtolower($modality) : 'remote';
    }

    private function parseSkills(string $skills): array
    {
        return array_filter(array_map('trim', explode(',', $skills)));
    }
}
