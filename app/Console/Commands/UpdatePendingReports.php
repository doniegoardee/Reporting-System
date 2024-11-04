<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Notifications;
use App\Models\Reports;
use App\Models\User;
use Carbon\Carbon;

class UpdatePendingReports extends Command
{
    protected $signature = 'reports:update-pending';
    protected $description = 'Update pending reports to closed if they are older than 3 days';

    public function handle()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);

        $reports = Reports::where('status', 'pending')
            ->where('created_at', '<', $threeDaysAgo)
            ->get();

        foreach ($reports as $report) {
            $report->update(['status' => 'closed']);

            $user = User::find($report->user_id);
            if ($user) {
                $notificationMessage = 'Your report with ID ' . $report->id . ' has been closed due to no action taken.';
                Notification::send($user, new Notifications($notificationMessage));
            }
        }

        $this->info('Pending reports older than 3 days have been updated to closed and users notified.');
    }
}
