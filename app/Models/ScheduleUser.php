<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleUser extends Model
{
    use HasFactory;

    protected $table = 'schedule_user';

    protected $fillable = [
        'sending_time',
        'status',
        'user_id',
        'sender',
        'schedule_id',
    ];

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }
}
