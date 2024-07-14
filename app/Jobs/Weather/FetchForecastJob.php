<?php

namespace App\Jobs\Weather;

use App\Models\Place;
use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FetchForecastJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Place $place;

    /**
     * Create a new job instance.
     */
    public function __construct(int $placeId)
    {
        $this->place = Place::find($placeId);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (Cache::has("weatherforecast-fetched-at:{$this->place->id}")
            && Carbon::make(Cache::get("weatherforecast-fetched-at:{$this->place->id}")) > now()->subMinutes(60)) {
            return;
        }

        Cache::put("weatherforecast-fetched-at:{$this->place->id}", now());

        $latitude = $this->place->location->latitude;
        $longitude = $this->place->location->longitude;
        $response = Http::get("https://api.open-meteo.com/v1/forecast?latitude={$latitude}&longitude={$longitude}&daily=weather_code,temperature_2m_max,temperature_2m_min,uv_index_max,rain_sum,showers_sum,snowfall_sum,precipitation_hours");

        $results = $response->json();

        $days = $results['daily']['time'];
        $weatherCodes = $results['daily']['weather_code'];
        $temperatureMax = $results['daily']['temperature_2m_max'];
        $temperatureMin = $results['daily']['temperature_2m_min'];
        $uvIndexMax = $results['daily']['uv_index_max'];
        $rainSum = $results['daily']['rain_sum'];
        $showersSum = $results['daily']['showers_sum'];
        $snowfallSum = $results['daily']['snowfall_sum'];
        $precipitationHours = $results['daily']['precipitation_hours'];

        // map the data to the date

        $weatherData = collect($days)->map(fn ($day, $key) => [
            'date' => $day,
            'place_id' => $this->place->id,
            'weather_code' => $weatherCodes[$key],
            'temperature_max' => $temperatureMax[$key],
            'temperature_min' => $temperatureMin[$key],
            'uv_index_max' => $uvIndexMax[$key],
            'rain_sum' => $rainSum[$key],
            'showers_sum' => $showersSum[$key],
            'snowfall_sum' => $snowfallSum[$key],
            'precipitation_hours' => $precipitationHours[$key],
        ]);

        $weatherData->each(fn ($data) => Weather::updateOrCreate([
            'place_id' => $data['place_id'],
            'date' => $data['date'],
        ], $data));
    }
}
