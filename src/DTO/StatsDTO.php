<?php

namespace App\DTO;

class StatsDTO
{
    public function __construct(
        private int $main,
        private int $first,
        private int $second,
        private int $third,
    ) {}

    public function getTotal(): int
    {
        return $this->getMain()
            + $this->getSecond()
            + $this->getThird()
            + $this->getFirst();
    }

    public function getMain(): int
    {
        return $this->main;
    }

    public function getFirst(): int
    {
        return $this->first;
    }

    public function getSecond(): int
    {
        return $this->second;
    }

    public function getThird(): int
    {
        return $this->third;
    }
}