<?php

namespace App\Listeners;

use App\Events\DeleteFileEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;

class DeleteFileListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DeleteFileEvent $event)
    {
        if (File::exists('storage/' . $event->filePath)) {
            File::delete('storage/' . $event->filePath);
        }
    }
}
