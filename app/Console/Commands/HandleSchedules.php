<?php

namespace App\Console\Commands;

use App\Jobs\HandleSendMail;
use App\Models\Schedule;
use App\Models\ScheduleUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Exception;

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
    protected $description = 'Handle schedule send email';

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
        $schedules = Schedule::select([
            'id',
            'mail_waiting',
            'start_time',
            'content',
            'sender',
        ])->where('start_time', $time)->get();
        $users = User::select([
            'id',
            'email',
        ])->take(10000)->get();
        foreach ($schedules as $schedule) {
            DB::transaction(function () use ($schedule, $users) {
                $schedule->update([
                    'mail_waiting'=> $users->count(),
                ]);
                foreach ($users->chunk(5000) as $chunk) {
                    $data = [];
                    foreach ($chunk as $user) {
                        array_push($data, [
                            'schedule_id' => $schedule->id,
                            'user_id' => $user->id,
                            'status' => config('status.schedule_user.waiting'),
                            'sending_time' => $schedule->start_time,
                        ]);
                        HandleSendMail::dispatch($schedule->content, $user->email, $schedule->sender, $schedule->id, $user->id)->onQueue('mails');
                    }
                    DB::table('schedule_user')->insert($data);
                }
            });

        }
    }
}
