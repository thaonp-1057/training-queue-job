@extends('layouts.app')

@section('content')
<div id="detail_schedule" class="mt-5">
    <h1 class="mt-5 mb-5 text-center">@lang('app.detail_schedule.title')</h1>
    <div class="container-fluit mb-3">
        <div class="row">
            <div class="col-md-3">
                <div>
                    <strong>@lang('app.detail_schedule.time_schedule'):</strong>
                    <span>{{ $schedule->start_time }}</span>
                </div>
                <div>
                    <strong>@lang('app.detail_schedule.end_time'):</strong>
                    <span>{{ $schedule->end_time }}</span>
                </div>
                <div>
                    <strong>@lang('app.detail_schedule.status'):</strong>
                    <span>
                        @if ($schedule->end_time != null)
                            <span class="badge badge-success">@lang('app.list_schedule.success')</span>
                        @else
                            <span class="badge badge-warning">@lang('app.list_schedule.waiting')</span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <strong>@lang('app.detail_schedule.mails_success'):</strong>
                    <span>{{ $schedule->mail_success }}</span>
                </div>
                <div>
                    <strong>@lang('app.detail_schedule.mails_failed'):</strong>
                    <span>{{ $schedule->mail_failed }}</span>
                </div>
                <div>
                    <strong>@lang('app.detail_schedule.mails_waiting'):</strong>
                    <span>{{ $schedule->mail_waiting }}</span>
                </div>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>@lang('app.detail_schedule.id')</th>
                <th>@lang('app.detail_schedule.sending_time')</th>
                <th>@lang('app.detail_schedule.receiver')</th>
                <th>@lang('app.detail_schedule.status')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedule->scheduleUsers as $index => $mail)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $mail->sending_time }}</td>
                    <td>{{ $mail->user->email }}</td>
                    <td>
                        @if ($mail->status == config('status.schedule_user.success'))
                            <span class="badge badge-success">@lang('app.detail_schedule.success')</span>
                        @elseif ($mail->status == config('const.schedule_user.status.failed'))
                            <span class="badge badge-danger">@lang('app.detail_schedule.failed')</span>
                        @else
                            <span class="badge badge-warning">@lang('app.detail_schedule.waiting')</span>
                        @endif
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
