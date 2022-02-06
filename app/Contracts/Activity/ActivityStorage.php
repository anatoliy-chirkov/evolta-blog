<?php

declare(strict_types=1);

namespace App\Contracts\Activity;

use App\Models\Activity;
use App\Structs\QueryResult;

interface ActivityStorage
{
    /**
     * @return QueryResult<Activity>
     */
    public function find(int $limit, int $offset): QueryResult;
}
