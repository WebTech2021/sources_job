<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobSeekerBlocked extends Mailable
{
    use Queueable, SerializesModels;
    protected $job_seeker;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job_seeker)
    {
        $this->job_seeker = $job_seeker;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Account has been Blocked')
            ->view('admin.mail.jobSeeker_blocked')
            ->with([
                'name'=> $this->job_seeker->first_name .' '.$this->job_seeker->last_name,
            ]);
    }
}

