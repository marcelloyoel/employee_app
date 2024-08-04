<?php

namespace App\Console\Commands;

use App\Jobs\SendWelcomeEmail;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendScheduledEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-scheduled';
    protected $description = 'Send scheduled emails to customers';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('SendScheduledEmails command is running.');
        $customers = Customer::where('active', 1)->get();

        foreach ($customers as $customer) {
            dispatch(new SendWelcomeEmail($customer->email, $customer->status));
        }

        $this->info('Scheduled emails have been sent.');
        return Command::SUCCESS;
    }
}
