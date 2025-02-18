<?php

namespace App\Http\Controllers;

use App\Dtos\Jobs\JobDto;
use App\Helpers\ResponseHandler;
use App\Http\Requests\SaveJobRequest;
use App\Http\Requests\SearchJobRequest;
use App\Http\Resources\JobOfferResource;
use App\Services\Jobs\GetFilterJobService;
use App\Services\Jobs\GetJobService;
use App\Services\Jobs\StoreJobService;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function __construct(private readonly ResponseHandler $response){}
    public function getJobs(SearchJobRequest $request, GetFilterJobService $service) : JsonResponse {
        try {
            $data = $service($request->all());
            return $this->response->responseOk(200, ['data' => JobOfferResource::collection($data)]);
        } catch (\Throwable $exception) {
            return $this->response->handleException($exception, 'GET_JOBS_ERROR', $exception->getMessage());
        }
    }

    public function getJob(string $jobId, Getjobservice $service) : JsonResponse {
        try {
            $data = $service($jobId);
            return $this->response->responseOk(200, ['data' => new JobOfferResource($data)]);
        } catch (\Throwable $exception) {
            return $this->response->handleException($exception, 'GET_JOB_ERROR', $exception->getMessage());
        }
    }

    public function storeJob(SaveJobRequest $request, StoreJobService $service) : JsonResponse {
        try {
            $jobDto = JobDto::fromArray($request->all());
            $newJob = $service($jobDto);
            return $this->response->responseOk(201, ['data' => new JobOfferResource($newJob)]);
        } catch (\Throwable $exception) {
            return $this->response->handleException($exception, 'STORE_JOB_ERROR', $exception->getMessage());
        }
    }
}
