<?php

namespace App\Jobs\Cron;

use App\Api\Sms;
use App\Models\NotificationAvailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifications = NotificationAvailable::where('sms', 0)->get();

        $sms = new Sms();

        foreach ($notifications as $notification) {
            $message = "24seven: Tovar {$notification->product->getName()} teper dostupen dlya pokupki";
            $sms->send($notification->phone, $message);

            $notification->delete();
            sleep(0.5);
        }
    }
}
