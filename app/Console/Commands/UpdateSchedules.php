<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status, mail failed, success, waiting for schedules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timeCurrent = Carbon::now()->format('Y-m-d H:i');
        $schedules = Schedule::where('start_time', '<=', $timeCurrent)
            ->whereNull('end_time')->get();
        foreach ($schedules as $schedule) {
            $scheduleUsers = $schedule->scheduleUsers;
            $mailsSuccess = $scheduleUsers->where('status', config('status.schedule_user.success'))->count();
            $mailsFailed = $scheduleUsers->where('status', config('status.schedule_user.failed'))->count();
            $mailsPending = $scheduleUsers->where('status', config('status.schedule_user.waiting'))->count();
            $attributes = [
                'mail_success' => $mailsSuccess,
                'mail_waiting' => $mailsPending,
                'mail_failed' => $mailsFailed,
            ];

            if ($mailsPending === 0) {
                $attributes['end_time'] = $scheduleUsers->max('sending_time');
                $schedule->update($attributes);
            } else {
                $schedule->update($attributes);
            }
        }

    }
}
