<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;


class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @param  $customer
     * @return void
     */
    public function __construct($email)
    {
        Log::info('(Jobs)Creating SendWelcomeEmail job with customer Email: ' . $email);
        $this->email = $email;
    }
    // public function __construct()
    // {
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('(Jobs)Sending email to: ' . $this->email);
        try {
            Mail::to($this->email)->send(new WelcomeEmail());
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }
}
