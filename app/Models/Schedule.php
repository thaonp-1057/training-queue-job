<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'start_time',
        'end_time',
        'sender',
        'mail_success',
        'mail_failed',
        'mail_waiting',
    ];

    public $timestamps = true;
}
