<?php

namespace App\Services\Jobs;

use App\Dtos\Jobs\JobDto;
use App\Repositories\JobRepository;
use App\Services\External\AvatureExternalAPIService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class GetFilterJobService {

    public function __construct(
        private readonly JobRepository $jobRepository,
        private readonly AvatureExternalAPIService $avatureExternalAPIService
    ) {}

    public function __invoke(?array $filters = []) : array
    {
        $externalData = $this->avatureExternalAPIService->getExternalOffers($filters);
        $localData =  $this->jobRepository->searchByParams($filters);

        return $this->mapResponse($localData, $externalData);

    }

    private function mapResponse(Collection $localJobs, array $externalData): array {
        $result = [];

        foreach ($externalData as $country => $jobs) {
            foreach ($jobs as $jobData) {
                $id = Hash::make($jobData[0]. $country. $jobData[1]);

                $result[] = JobDto::fromArray([
                    'id' => $id,
                    'name' => $jobData[0] ?? 'No Title',
                    'company' => 'Unknown Company',
                    'location' => 'Remote',
                    'description' => '',
                    'modality' => 'remote',
                    'skills' => self::parseSkills($jobData[2] ?? ''),
                    'salary' => isset($jobData[1]) ? (float) $jobData[1] : 0.0,
                    'country' => $country,
                    'created_at' => now()->toDateTimeString(),
                ]);
            }
        }

        foreach ($localJobs as $jobData) {
            $result[] = JobDto::fromArray($jobData->toArray());
        }
        return $result;
    }

    private static function parseSkills(string $skillsXml): string
    {
        if (Str::contains($skillsXml, '<skill>')) {
            preg_match_all('/<skill>(.*?)<\/skill>/', $skillsXml, $matches);
            return implode(',', $matches[1] ?? []);
        }
        return $skillsXml == "<skills></skills>" ? '' : $skillsXml;
    }

}
