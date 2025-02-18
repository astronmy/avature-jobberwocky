<?php

namespace App\Services\External;

use App\Dtos\Jobs\JobDto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class AvatureExternalAPIService  {
    public function getExternalOffers(array $queryParams): mixed
    {
        try {
            $params = http_build_query($queryParams);
            $uri = config('avature.base_uri') . '?' . $params;

            $response = Http::get($uri);

            if ($response->successful()) {
                return $response->json();
            }
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
