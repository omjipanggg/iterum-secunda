<?php

namespace App\Jobs;

use App\Mail\SendRegister as SendEmail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipient;

    public function __construct($recipient)
    {
        $this->recipient = $recipient;
    }

    public function handle(): void
    {
        Mail::to($this->recipient->email)->send(new SendEmail($this->recipient));
    }
}
