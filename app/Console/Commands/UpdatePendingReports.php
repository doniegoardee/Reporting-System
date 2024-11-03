<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reports;
use Carbon\Carbon;

class UpdatePendingReports extends Command
{
    protected $signature = 'reports:update-pending';
    protected $description = 'Update pending reports to closed if they are older than 3 days';

    public function handle()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        Reports::where('status', 'pending')
            ->where('created_at', '<', $threeDaysAgo)
            ->update(['status' => 'closed']);

        $this->info('Pending reports older than 3 days have been updated to closed.');
    }
}
