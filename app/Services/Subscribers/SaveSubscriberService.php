<?php

namespace App\Services\Subscribers;

use App\Dtos\Subscribers\SubscriberDTO;
use App\Repositories\SubscriberRepository;

final class SaveSubscriberService {

    public function __construct(private readonly SubscriberRepository $repository) {}

    public function __invoke(SubscriberDTO $data) : object
    {
        return $this->repository->create($data);
    }

}
