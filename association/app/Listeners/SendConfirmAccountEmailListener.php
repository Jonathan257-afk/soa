<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\SendConfirmAccountMail;
use Illuminate\Support\Facades\Mail;

class SendConfirmAccountEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try{
            Mail::to($event->email)->send(new SendConfirmAccountMail($event->code));
        }
        catch(Exception $e){

        }
    }
}
