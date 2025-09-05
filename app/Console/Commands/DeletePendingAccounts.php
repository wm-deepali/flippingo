<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccountDeletionRequest;
use Illuminate\Support\Facades\DB;

class DeletePendingAccounts extends Command
{
    protected $signature = 'accounts:delete-pending';
    protected $description = 'Automatically delete customer accounts after 7 days of pending deletion request';

    public function handle()
    {
        $this->info('Running pending account deletion check...');

        $requests = AccountDeletionRequest::where('status', 'pending')
            ->where('created_at', '<=', now()->subDays(7))
            ->get();

        foreach ($requests as $request) {
            $customer = $request->customer;

            if ($customer) {
                $customer->delete(); // Delete customer
            }

            $request->update(['status' => 'deleted']); // mark request as deleted
        }

        $this->info('Completed pending account deletions.');
    }
}
