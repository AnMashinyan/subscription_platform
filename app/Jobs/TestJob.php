<?php
namespace App\Jobs;

use App\Mail\DemoMail;
use App\Models\Sender;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;



class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emailsToSent;

    public function __construct($emailsToSent)
    {
        $this ->emailsToSent = $emailsToSent;
    }

    public function handle()
    {

        foreach ($this->emailsToSent as $emailSent) {
            $subscriber = Subscriber::find($emailSent->subscriberId);
            Mail::to($subscriber->email)->send(new DemoMail($subscriber));
            Sender::where('id', $emailSent->id)->update(['isSend' => "1"]);
        }
    }
}
