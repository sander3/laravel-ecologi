<?php

namespace Soved\Laravel\Ecologi\Contracts;

interface EcologiContract
{
    public const API_URL = 'https://public.ecologi.com/';

    public function getImpact(string $username): array;

    public function getTrees(string $username): float;

    public function getCarbonOffset(string $username): float;

    public function purchaseTrees(int $quantity): array;

    public function test(): self;
}
