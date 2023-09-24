<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SendStorageToCloud implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name, $content;

    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function handle(): void
    {
        Storage::disk('ftp')->put('local/' . $this->name, file_get_contents($this->content));
    }
}
