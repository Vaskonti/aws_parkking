<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use App\Notifications\AggregationNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

final class SendAggregations extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'send:aggregations';

    /**
     * The console command description.
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle(): int
    {
        Cache::put('sum', 10, \now()->addHour());

        try {
            $yesterday = Carbon::yesterday();
            $tomorrow = Carbon::tomorrow();
            $sumAggregation = Cache::remember(
                'daily-aggregations:sum',
                now()->addHour(),
                static function () use ($yesterday, $tomorrow) {
                    $carsExited = Vehicle::whereBetween('exited', [$yesterday, $tomorrow])->get();
                    $sum = 0;

                    foreach ($carsExited as $item) {
                        $sum += $item->sumPaid;
                    }

                    return $sum;
                },
            );

            $carsRegisteredAggregation = Cache::remember('daily-aggregations:cars-registered', now()->addHour(), static fn () => Vehicle::whereBetween('entered', [$yesterday, $tomorrow])->count());
            $today = Carbon::today()->format('d-m-Y');
            Notification::route('mail', 'hello@admin.com')->notify(
                new AggregationNotification($sumAggregation, $carsRegisteredAggregation, $today),
            );

            return 0;
        } catch (\Throwable $e) {
            Log::error($e->getMessage());

            return 1;
        }
    }

}
