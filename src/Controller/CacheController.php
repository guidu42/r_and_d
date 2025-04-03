<?php

namespace App\Controller;

use App\Service\CacheService;
use App\Service\StatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CacheController extends AbstractController
{
    public function __construct(
        private StatsService $statsService,
        private CacheService $cacheService,
    )
    {
    }

    #[Route('/cache_index')]
    public function __invoke(Request $request): Response
    {
        $this->cacheService->getStats();
        $stats = $this->statsService->getStatsData();
        return $this->render('cache_index.html.twig', [
            'stats' => $stats,
        ]);
    }
}