<?php

namespace App\Jobs;

use App\Mail\LoyalEmail;
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
    protected $status;
    /**
     * Create a new job instance.
     *
     * @param  $customer
     * @return void
     */
    public function __construct($email, $status)
    {
        Log::info('(Jobs)Creating SendWelcomeEmail job with customer Email: ' . $email);
        Log::info('(Jobs)Creating SendWelcomeEmail job with customer Status: ' . $status);
        $this->email = $email;
        $this->status = $status;
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
        try {
            Log::info('(Jobs)Sending email to: ' . $this->email . ' with status: ' . $this->status);
            if ($this->status == 0) {
                Mail::to($this->email)->send(new WelcomeEmail());
            } else {
                Mail::to($this->email)->send(new LoyalEmail());
            }
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }
}
