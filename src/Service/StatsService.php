<?php

namespace App\Service;

class StatsService
{
    public function getStatsData(): array
    {
//        sleep(8);
        return [
            'main' => 5,
            'first' => 3,
            'second' => 8,
            'third' => 47,
            'total' => 5 + 3 + 8 + 47,
        ];
    }
}