<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->subject('Новый заказ');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): OrderCreated
    {
        return $this->from(env('MAIL_USERNAME'), '24seven')
            ->view('mail.order.create', ['order' => $this->order]);
    }
}
