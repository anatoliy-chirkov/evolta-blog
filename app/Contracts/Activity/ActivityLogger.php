<?php

declare(strict_types=1);

namespace App\Contracts\Activity;

use Carbon\CarbonInterface;

interface ActivityLogger
{
    public function __invoke(string $url, CarbonInterface $date): void;
}
