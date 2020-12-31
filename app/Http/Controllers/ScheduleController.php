<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timeMin = Carbon::now()->format('Y-m-d') . 'T' . Carbon::now()->format('H:i');

        return view('schedules.new_schedule', compact('timeMin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $start_times = explode('T', $request->start_time);
        $data = $request->all();
        $data['content'] = $request->content;
        $data['start_time'] = $start_times[0] . ' ' . $start_times[1];
        $data['sender'] = config('mail.from.address');
        $data['mail_success'] = config('mail.number.init');
        $data['mail_failed'] = config('mail.number.init');
        $data['mail_waiting'] = config('mail.number.init');
        $schedule = Schedule::create($data);

        if ($schedule) {
            return redirect()->back()->with('success', trans('app.message.schedule.success'));
        } else {
            return redirect()->back()->with('failed', trans('app.message.schedule.failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
