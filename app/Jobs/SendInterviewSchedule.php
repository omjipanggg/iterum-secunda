<?php

namespace App\Jobs;

use App\Mail\SendInterviewSchedule as SendEmail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInterviewSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::to($this->data['recipient'])->send(new SendEmail($this->data));
    }
}
