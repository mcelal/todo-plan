<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Provider2Service implements ProviderInterface
{
    protected string $endpoint = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';

    /**
     * @return array{ProviderDTO}
     */
    public function fetch(): array
    {
        try {
            $response = Http::get($this->endpoint);
        } catch (\Exception $exception) {
            Log::error('Provider2 Fetch Error:', [
                $exception->getMessage(),
                $exception->getFile(),
            ]);

            return [];
        }

        return collect($response->json())
            ->map(function ($item) {
                $dto = new ProviderDTO();
                $dto->setName(array_key_first($item));
                $dto->setEstimatedDuration($item[array_key_first($item)]['estimated_duration']);
                $dto->setLevel($item[array_key_first($item)]['level']);

                return $dto;
            })
            ->toArray();
    }
}
