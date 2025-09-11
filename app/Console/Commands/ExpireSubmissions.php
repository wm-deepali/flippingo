<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FormSubmission;
use Carbon\Carbon;

class ExpireSubmissions extends Command
{
    protected $signature = 'submissions:expire';
    protected $description = 'Mark submissions as expired if their expiry date has passed';

    public function handle()
    {
        $expiredCount = FormSubmission::where('status', '!=', 'expired')
            ->where('expires_at', '<', Carbon::now())
            ->update(['status' => 'expired']);

        $this->info("{$expiredCount} submissions marked as expired.");
    }
}
