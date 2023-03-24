<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Provider1Service implements ProviderInterface
{
    protected string $endpoint = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';

    /**
     * @return array{ProviderDTO}
     */
    public function fetch(): array
    {
        try {
            $response = Http::get($this->endpoint);
        } catch (\Exception $exception) {
            Log::error('Provider1 Fetch Error:', [
                $exception->getMessage(),
                $exception->getFile(),
            ]);

            return [];
        }

        return collect($response->json())
            ->map(function ($item) {
                $dto = new ProviderDTO();
                $dto->setName($item['id']);
                $dto->setEstimatedDuration($item['sure']);
                $dto->setLevel($item['zorluk']);

                return $dto;
            })
            ->toArray();
    }
}
