<?php

namespace App\Jobs\Places;

use App\Models\Place;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MatanYadaev\EloquentSpatial\Objects\Point;

class SavePlaceJob implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $placeData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $placeData)
    {
        $this->placeData = $placeData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->placeData['location'] = new Point($this->placeData['latitude'],
            $this->placeData['longitude'], 4326);

        $this->placeData['hash'] = Place::makeHash($this->placeData['name'], $this->placeData['latitude'], $this->placeData['longitude']);
        unset($this->placeData['latitude'], $this->placeData['longitude']);

        Place::firstOrCreate($this->placeData);
    }
}
