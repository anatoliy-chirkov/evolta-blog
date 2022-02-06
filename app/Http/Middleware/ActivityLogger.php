<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Closure;
use App\Contracts\Activity\ActivityLogger as LogActivityCommand;

final class ActivityLogger
{
    private LogActivityCommand $logActivityCommand;

    public function __construct(LogActivityCommand $logActivityCommand)
    {
        $this->logActivityCommand = $logActivityCommand;
    }

    public function handle(Request $request, Closure $next)
    {
        ($this->logActivityCommand)($request->url(), Carbon::now());

        return $next($request);
    }
}
