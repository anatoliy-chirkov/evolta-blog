<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Contracts\Activity\ActivityStorage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

final class ShowActivity extends Controller
{
    public function __invoke(Request $request, ActivityStorage $activityStorage): View
    {
        $page = $request->query->getInt('page', 1);
        $perPage = 10;

        $queryResult = $activityStorage->find($perPage, ($page - 1) * $perPage);

        return view(
            'admin.activity.index',
            [
                'activities' => new LengthAwarePaginator(
                    $queryResult->items,
                    $queryResult->total,
                    $perPage,
                    $page,
                    ['path' => $request->getBasePath()]
                ),
            ]
        );
    }
}
