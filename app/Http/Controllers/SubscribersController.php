<?php

namespace App\Http\Controllers;

use App\Dtos\Subscribers\SubscriberDTO;
use App\Helpers\ResponseHandler;
use App\Http\Requests\SaveSubscriptorRequest;
use App\Http\Resources\SubscriberResource;
use App\Services\Subscribers\SaveSubscriberService;
use Illuminate\Http\JsonResponse;

class SubscribersController extends Controller
{
    public function __construct(private readonly ResponseHandler $response){}

    public function saveSubscriber(SaveSubscriptorRequest $request, SaveSubscriberService $service) : JsonResponse {
        $dto = SubscriberDTO::fromArray($request->all());
        $newSubscriber = $service($dto);
        return $this->response->responseOk(201, ['data' => new SubscriberResource($newSubscriber)]);
    }
}
