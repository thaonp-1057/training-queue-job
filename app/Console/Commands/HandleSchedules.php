<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use App\Models\ScheduleUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class HandleSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedules:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $time = Carbon::now()->format('Y-m-d H:i');
        $schedules = Schedule::where('start_time', $time)->get();
        $users = User::all();
        foreach ($schedules as $schedule) {
            DB::transaction(function () use ($schedule, $users) {
                // $sendingTime = $schedule->start_time;
                // $scheduleId = $schedule->id;
                $schedule->update([
                    'mail_waiting'=> $users->count(),
                ]);

                $data = array();

                foreach ($users as $user) {
                    array_push($data, [
                        'schedule_id' => $schedule->id,
                        'user_id' => $user->id,
                        'status' => config('status.schedule_user.waiting'),
                        'sending_time' => $schedule->start_time,
                    ]);
                }

                DB::table('schedule_user')->insert($data);
            });
        }
    }
}
