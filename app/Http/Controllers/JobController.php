<?php

namespace App\Http\Controllers;

use App\Dtos\Jobs\JobDto;
use App\Http\Requests\SaveJobRequest;
use App\Services\Jobs\GetJobService;
use App\Services\Jobs\StoreJobService;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function getJobs(Getjobservice $service) : JsonResponse {
        return response()->json(['data' =>$service()], 200);
    }

    public function storeJob(SaveJobRequest $request, StoreJobService $service) : JsonResponse {
        $jobDto = JobDto::fromArray($request->all());
        return response()->json(['data' =>$service($jobDto)], 201);
    }
}
