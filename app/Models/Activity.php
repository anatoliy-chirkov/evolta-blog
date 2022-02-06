<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;

final class Activity
{
    public string $url;
    public int $visits;
    public CarbonInterface $lastVisit;

    public function __construct(string $url, int $visits, CarbonInterface $lastVisit)
    {
        $this->url = $url;
        $this->visits = $visits;
        $this->lastVisit = $lastVisit;
    }
}
