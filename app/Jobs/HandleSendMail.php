<?php

namespace App\Jobs;

use App\Models\ScheduleUser;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class HandleSendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content;
    protected $receiver;
    protected $sender;
    protected $scheduleId;
    protected $userId;

    public $tries = 3;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content, $receiver, $sender, $scheduleId, $userId)
    {
        $this->content = $content;
        $this->receiver = $receiver;
        $this->sender = $sender;
        $this->scheduleId = $scheduleId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // tạo điều kiện để job failed và success
        if ($this->userId % 2 == 0) {
            ScheduleUser::where([
                'schedule_id' => $this->scheduleId,
                'user_id' => $this->userId,
            ])->update([
                'status' => config('status.schedule_user.success'),
            ]);
        } else {
            throw new Exception();
        }
    }

    public function failed(Throwable $exception)
    {
        ScheduleUser::where([
            'schedule_id' => $this->scheduleId,
            'user_id' => $this->userId,
        ])->update([
            'status' => config('status.schedule_user.failed'),
        ]);
    }
}
