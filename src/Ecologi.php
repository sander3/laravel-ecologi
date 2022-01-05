<?php

namespace Soved\Laravel\Ecologi;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Soved\Laravel\Ecologi\Contracts\EcologiContract;

class Ecologi implements EcologiContract
{
    public bool $test = false;

    public function getImpact(string $username): array
    {
        return $this->request('get', "users/{$username}/impact");
    }

    public function getTrees(string $username): float
    {
        $response = $this->request('get', "users/{$username}/trees");

        return Arr::get($response, 'total');
    }

    public function getCarbonOffset(string $username): float
    {
        $response = $this->request('get', "users/{$username}/carbon-offset");

        return Arr::get($response, 'total');
    }

    public function purchaseTrees(int $quantity): array
    {
        $data = ['number' => $quantity];

        return $this->request('post', 'impact/trees', $data);
    }

    public function purchaseCarbonOffset(int $quantity, string $unit = 'Tonnes'): array
    {
        $data = ['number' => $quantity, 'units' => $unit];

        return $this->request('post', 'impact/carbon', $data);
    }

    public function test(): self
    {
        $this->test = true;

        return $this;
    }

    private function request(string $method, string $url, array $data = [], bool $throwException = true): array
    {
        $request = Http::baseUrl(self::API_URL)
            ->withToken(config('ecologi.token'));

        $data['test'] = $this->test;

        $response = $request->{$method}($url, $data);

        if ($throwException) {
            // Throw an exception if a client or server error occurred...
            $response->throw();
        }

        return $response->json();
    }
}
