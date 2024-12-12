<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Product_Out_Of_Stock_Mail extends Mailable
{
    use Queueable, SerializesModels;

 
    public $product;

    public function __construct( Product $product)
    {
        $this->product = $product;
    }

    public function build()
    {
        return $this->subject('Product Details')->view('Emails.ProductMail');
    }


}
