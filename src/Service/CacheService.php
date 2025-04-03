<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CacheService
{
    public function __construct(
        private CacheInterface $statsCache,
        private StatsService   $statsService,
    )
    {
    }

    public function getStats(): array
    {
        $cacheKey = $this->getCacheKey();
        return $this->statsCache->get($cacheKey, function (ItemInterface $item) {
            return $this->statsService->getStatsData();
        });
    }

    public function getCacheKey(): string
    {
        return sprintf('cache_%s', 'pour_user');
    }
}