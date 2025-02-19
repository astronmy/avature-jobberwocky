<?php

namespace App\Services\External;

use Illuminate\Support\Facades\Http;

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
