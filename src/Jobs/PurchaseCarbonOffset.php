<?php

namespace Soved\Laravel\Ecologi\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Soved\Laravel\Ecologi\Contracts\EcologiContract;

class PurchaseCarbonOffset implements ShouldQueue
{
    use Dispatchable;
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public int $quantity,
        public string $unit = 'Tonnes'
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EcologiContract $ecologi)
    {
        $ecologi->purchaseCarbonOffset($this->quantity, $this->unit);
    }
}
