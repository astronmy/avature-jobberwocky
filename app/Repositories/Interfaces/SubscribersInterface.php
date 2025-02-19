<?php

namespace App\Repositories\Interfaces;

use App\Dtos\Subscribers\SubscriberDTO;
use App\Models\Subscriber;
use Illuminate\Support\Collection;

interface SubscribersInterface
{
    public function findByPreferences(array $preferences): ?Collection;

    public function all(): ?Collection;
    public function create(SubscriberDTO $dto): Subscriber;
}
