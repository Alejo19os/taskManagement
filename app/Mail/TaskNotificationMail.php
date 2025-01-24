<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $subjectLine;

    public function __construct($task, $subjectLine)
    {
        $this->task = $task;
        $this->subjectLine = $subjectLine;
    }

    public function build()
    {
        return $this->view('mail.email')
                    ->subject($this->subjectLine)
                    ->with(['task' => $this->task]);
    }
}

