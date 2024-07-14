<?php

namespace App\Http\Controllers;

use App\Jobs\Places\SavePlaceJob;
use App\Models\Place;
use Exception;
use Illuminate\Support\Facades\Http;

class PlacesController extends Controller
{
    public function search(string $searchTerm)
    {
        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name' => $searchTerm,
        ]);

        $results = collect($response->json()['results']);

        $results = $results->map(function ($result) {
            return [
                'name' => $result['name'],
                'latitude' => $result['latitude'],
                'longitude' => $result['longitude'],
                'population' => $result['population'] ?? null,
                'country_code' => $result['country_code'],
                'country' => $result['country'],
                'timezone' => $result['timezone'],
                'flag' => country_flag($result['country_code']),
            ];
        })->unique('name');

        $results->each(function ($placeData) {
            try {
                SavePlaceJob::dispatchSync($placeData);
            } catch (Exception $e) {
                // do nothing
            }
        });

        return Place::where('name', 'like', "%$searchTerm%")->get()->toArray();
    }
}
