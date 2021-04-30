<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class uploadAudioVideoFilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content, $user, $type, $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($content, $file, $user, $type)
    {
        $this->content = $content;
        $this->user = $user;
        $this->type = $type;
        $this->filename = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 'audio') {
            Storage::put('Audio/' . $this->filename, (string)$this->content, 'public');
        } else {
            Storage::put('Video/' . $this->filename, (string)file_get_contents($this->content), 'public');
        }
    }
}
