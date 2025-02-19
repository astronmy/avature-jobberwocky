<?php

namespace Tests\Feature;

use App\Dtos\Jobs\JobDto;
use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetJobOffersTest extends TestCase
{
    /** @test */
    public function it_should_return_a_list_of_job_offers(): void
    {
        Http::fake([
            config('avature.base_uri') . '*' => Http::response([
                "USA" => [
                    ["Cloud Engineer", 65000, "<skills><skill>AWS</skill><skill>Azure</skill><skill>Docker</skill></skills>"],
                    ["DevOps Engineer", 60000, "<skills><skill>CI/CD</skill><skill>Docker</skill><skill>Kubernetes</skill></skills>"]
                ],
                "Spain" => [
                    ["Machine Learning Engineer", 75000, "<skills><skill>Python</skill><skill>TensorFlow</skill><skill>Deep Learning</skill></skills>"]
                ]
            ], 200)
        ]);

        $mockRepository = \Mockery::mock(JobRepository::class);
        $mockRepository->shouldReceive('searchByParams')
            ->andReturn(collect([
                new JobDto(
                    id: '1',
                    name: 'Backend Developer',
                    company: 'Tech Corp',
                    location: 'Remote',
                    description: 'A backend developer role',
                    modality: 'remote',
                    skills: ['PHP', 'Laravel', 'MongoDB'],
                    salary: 80000,
                    country: 'USA',
                    created_at: now()->toDateTimeString()
                ),
                new JobDto(
                    id: '2',
                    name: 'Frontend Developer',
                    company: 'Web Inc',
                    location: 'New York',
                    description: 'A frontend developer role',
                    modality: 'hybrid',
                    skills: ['React', 'VueJS'],
                    salary: 75000,
                    country: 'USA',
                    created_at: now()->toDateTimeString()
                )
        ]));

        $this->app->instance(JobRepository::class, $mockRepository);

        $response = $this->get('api/v1/jobs/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_return_a_empty_of_job_offers(): void
    {
        Http::fake([
            config('avature.base_uri') . '*' => Http::response([], 200)
        ]);

        $mockRepository = \Mockery::mock(JobRepository::class);
        $mockRepository->shouldReceive('searchByParams')
            ->andReturn(collect([]));

        $this->app->instance(JobRepository::class, $mockRepository);

        $response = $this->get('api/v1/jobs/');

        $response->assertStatus(200);
    }
}
