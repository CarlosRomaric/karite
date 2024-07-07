<?php

namespace App\Jobs;

use App\Models\Region;
use App\Models\Lot;
use App\Models\Batch;
use App\Models\Sealed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreSealedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $current_year = date('y');
        $current_month = date('m');
        $region = Region::find($this->data['region_id']);

        $batch = new Batch();
        $batch->region_id = $this->data['region_id'];
        $batch->number = Batch::all()->count() + 1;
        $batch->code = sprintf('%02d', $region->code) . '-' . $current_month . $current_year . '-' . sprintf('%04d', $batch->number);
        $batch->sealeds = $this->data['number'];
        $batch->type = $this->data['type'];
        $batch->user_id = $this->data['user_id'];
        $batch->save();
        $count = Sealed::all()->count();

        $numBatchs = $this->data['number'] / 100;

        for ($i = 0; $i < $numBatchs; $i++) {
            
            $lot = new Lot();
            $lot->number = $i + 1;
            $lot->batch_id = $batch->id;
            $lot->agribusiness_id = null;
            $lot->code = sprintf('%02d', $batch->number) . '-' . $current_month . $current_year . '-' . sprintf('%04d', $lot->number);
            $lot->save();

            for ($j = 0; $j < 100; $j++) {
                $count++;
                $sealed = new Sealed();
                $sealed->lot_id = $lot->id;
                $increment = sprintf('%03d', $j);
                $short = $region->code . $current_month . $current_year . $increment;
                $ss = $this->ssKey($short);
                $sealed->code = $region->code . $current_month . $current_year . $count . $increment . $ss;
                $sealed->state = 'NOT USED';
                $sealed->save();
            }
        }

    }

    /**
     * Calculate ssKey.
     *
     * @param string $digits_12
     * @return string
     */
    public static function ssKey($digits_12)
    {
        $numbers = array_map('intval', str_split($digits_12));
        $sum = array_sum($numbers);
        $lastTwoDigits = substr($digits_12, -2);
        $digits_2 = intval($lastTwoDigits[0]) + intval($lastTwoDigits[1]);
        return sprintf('%02d', substr($digits_2 + $sum % 12, -2));
    }
}
