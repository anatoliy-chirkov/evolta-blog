@extends('admin.layouts.app')

@section('content')
  <div class="page-header">
    <h1>@lang('dashboard.activity')</h1>
  </div>

  @include ('admin/activity/_list')
@endsection
