<table class="table table-striped table-sm table-responsive-md">
    <caption>{{ trans_choice('activity.count', $activities->total()) }}</caption>
    <thead>
        <tr>
            <th>@lang('activity.attributes.url')</th>
            <th>@lang('activity.attributes.visits')</th>
            <th>@lang('activity.attributes.last_visit')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->url }}</td>
                <td>{{ $activity->visits }}</td>
                <td>{{ humanize_date($activity->lastVisit, 'd/m/Y H:i:s') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $activities->links() }}
</div>
