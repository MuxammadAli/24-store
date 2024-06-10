<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductCount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Product
     */
    private $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->subject('24seven');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(env('MAIL_USERNAME'), '24seven')
            ->view('mail.product.count', ['product' => $this->product]);
    }
}
