<?php

declare(strict_types=1);

namespace App\Adapters;

use App\Contracts\Activity\ActivityLogger;
use App\Contracts\Activity\ActivityStorage;
use App\Models\Activity;
use App\Structs\QueryResult;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function config;

final class ActivityJsonRpcAdapter implements ActivityLogger, ActivityStorage
{
    /**
     * @return QueryResult<Activity>
     */
    public function find(int $limit, int $offset): QueryResult
    {
        $response = $this->request('findActivity', ['limit' => $limit, 'offset' => $offset]);

        if (null === $response) {
            return new QueryResult(0, []);
        }

        return new QueryResult(
            $response['total'],
            array_map(
                fn (array $element): Activity => new Activity(
                    $element['url'],
                    $element['visits'],
                    new Carbon($element['lastVisit'])
                ),
                $response['items']
            )
        );
    }

    public function __invoke(string $url, CarbonInterface $date): void
    {
        $this->request('logActivity', ['url' => $url, 'date' => $date]);
    }

    private function request(string $method, array $params)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('activity.key'),
        ];

        $data = [
            'id' => 1,
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
        ];

        try {
            $response = Http::withHeaders($headers)->post(config('activity.url'), $data)->json();
        } catch (\Throwable $e) {
            Log::error('Activity app is not accessible');

            return null;
        }

        if (null === $response) {
            Log::error('Activity app not returned any content');

            return null;
        }

        if (isset($response['error'])) {
            Log::error(sprintf('Activity app returned error: %s', $response['error']['message']));

            return null;
        }

        if (!array_key_exists('result', $response)) {
            Log::error('Activity app returned response without \'result\' key presented');

            return null;
        }

        return $response['result'];
    }
}
