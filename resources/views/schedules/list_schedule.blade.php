@extends('layouts.app')

@section('content')
<div id="list_schedule" class="mt-5">
    <h1 class="mt-5 mb-5 text-center">@lang('app.list_schedule.title')</h1>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>@lang('app.list_schedule.id')</th>
                <th>@lang('app.list_schedule.time_schedule')</th>
                <th>@lang('app.list_schedule.end_time')</th>
                <th>@lang('app.list_schedule.mails_success')</th>
                <th>@lang('app.list_schedule.mail_failed')</th>
                <th>@lang('app.list_schedule.mails_waiting')</th>
                <th>@lang('app.list_schedule.status')</th>
                <th>@lang('app.list_schedule.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $index => $schedule)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time == null ? 'N/A' :  $schedule->end_time }}</td>
                    <td>{{ $schedule->mail_success }}</td>
                    <td>{{ $schedule->mail_failed }}</td>
                    <td>{{ $schedule->mail_waiting }}</td>
                    <td>
                        @if ($schedule->end_time != null)
                            <span class="badge badge-success">@lang('app.list_schedule.success')</span>
                        @else
                            <span class="badge badge-warning">@lang('app.list_schedule.waiting')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('schedules.show', ['schedule' => $schedule->id]) }}">
                            <button  @if ($schedule->end_time == null) disabled @endif class="btn btn-primary">
                                @lang('app.list_schedule.detail')
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection
