<?php

namespace App\Jobs;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\Product_Out_Of_Stock_Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Product_Out_Of_Stock_Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $product   ;

    public function __construct(Product  $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       Mail::to("mazenkhaled.jr@gmail.com")->send(new Product_Out_Of_Stock_Mail($this->product)) ; 
    }
}
