<?php

namespace App\Infrastructure\Services;

interface ProviderInterface
{
    public function getContent(array $criteria): float|object|int|bool|array|string|null;
}