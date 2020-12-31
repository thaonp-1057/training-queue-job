@extends('layouts.app')

@section('content')

<h1 class="mt-5 mb-5 text-center">@lang('app.new_schedule.title')</h1>
@if (session('success'))
    <div id="messenger" class="alert alert-success" role="alert">
        <i data-feather="check"></i>
        <span class="mx-2">{{ session('success') }}</span>
    </div>
@endif

@if (session('failed'))
    <div id="messenger" class="alert alert-danger" role="alert">
        <i data-feather="check"></i>
        <span class="mx-2">{{ session('failed') }}</span>
    </div>
@endif

<form action="{{ route('schedules.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label>@lang('app.new_schedule.content')</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>

        @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>@lang('app.new_schedule.schedule_time')</label>
        <input class="form-control" type="datetime-local" value="{{ old('start_time') }}" name="start_time" id="start_time"
            min="{{ $timeMin }}">
        @error('start_time')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-primary" type="submit">@lang('app.new_schedule.submit')</button>
    </div>
</form>

@endsection
