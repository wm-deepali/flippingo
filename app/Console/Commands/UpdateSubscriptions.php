<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class UpdateSubscriptions extends Command
{
    protected $signature = 'subscriptions:update';
    protected $description = 'Fill newly added subscription columns from related package (one-time)';

    public function handle()
    {
        DB::beginTransaction();

        try {
            $subs = Subscription::with('package')
                ->where('status', 'active')
                ->get();

            $count = 0;

            foreach ($subs as $s) {
                if (!$s->package) continue;

                $s->update([
                    // fill ONLY if null
                    'listings' => $s->package->listings,

                    'sponsored' => $s->package->sponsored,
                    'sponsored_frequency' => $s->package->sponsored_frequency,
                    'sponsored_unit' => $s->package->sponsored_unit,

                    'whatsapp' => $s->package->whatsapp,
                    'whatsapp_frequency' => $s->package->whatsapp_frequency,
                    'whatsapp_unit' => $s->package->whatsapp_unit,

                    'featured' => $s->package->featured,
                    'featured_frequency' => $s->package->featured_frequency,
                    'featured_unit' => $s->package->featured_unit,

                    'alerts' => $s->alerts ?? $s->package->alerts,
                ]);

                $count++;
            }

            DB::commit();
            $this->info("Backfilled {$count} subscriptions.");
            return Command::SUCCESS;

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
