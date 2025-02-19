<?php

namespace App\DTOs\Subscribers;

final class SubscriberDTO
{
    private const MODALITY_OPTIONS = ['remote', 'hybrid', 'presential', 'part-time', 'full-time'];
    private const ALERT_METHODS = ['email', 'sms', 'push'];

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $alert_method,
        public readonly array  $job_preferences,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        $instance = new self(
            id: $data['id'] ?? uniqid(),
            name: $data['name'] ?? 'Unknown',
            email: $data['email'] ?? '',
            alert_method: $data['alert_method'] ?? 'email',
            job_preferences: self::sanitizePreferences($data['job_preferences'] ?? []),
        );

        return $instance->validate();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'alert_method' => $this->alert_method,
            'job_preferences' => $this->job_preferences,
        ];
    }

    private function validate(): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            email: $this->email,
            alert_method: $this->validateAlertMethod($this->alert_method),
            job_preferences: self::sanitizePreferences($this->job_preferences),
        );
    }

    private function validateAlertMethod(string $method): string
    {
        return in_array(strtolower($method), self::ALERT_METHODS) ? strtolower($method) : 'email';
    }

    private static function sanitizePreferences(array $preferences): array
    {
        return [
            'job_name' => $preferences['job_name'] ?? null,
            'salary_min' => isset($preferences['salary_min']) ? max(0, (float)$preferences['salary_min']) : null,
            'salary_max' => isset($preferences['salary_max']) ? max(0, (float)$preferences['salary_max']) : null,
            'country' => array_filter($preferences['country'] ?? [], fn($c) => is_string($c) && strlen($c) >= 2),
            'modality' => array_filter(
                $preferences['modality'] ?? [],
                fn($m) => in_array(strtolower($m), self::MODALITY_OPTIONS)
            ),
        ];
    }
}
