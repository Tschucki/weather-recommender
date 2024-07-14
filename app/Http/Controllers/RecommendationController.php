<?php

namespace App\Http\Controllers;

use App\Jobs\Weather\FetchForecastJob;
use App\Models\Place;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use SKAgarwal\GoogleApi\PlacesApi;

class RecommendationController extends Controller
{
    private Place $place;

    public function __construct(Request $request)
    {
        FetchForecastJob::dispatchSync($request->place->id);
        $this->place = $request->place;
    }

    public function index(Place $place): Response
    {
        $forecast = $place->forecast()->get();
        $averageTemperature = $forecast->avg('temperature_max');
        $averageRain = $forecast->avg('rain_sum');
        $averageTimeRain = $forecast->avg('precipitation_hours');

        return Inertia::render('Recommendations/Index', [
            'place' => $place->toArray(),
            'weathers' => $place->forecast()->get()->toArray(),
            'averageTemperature' => $averageTemperature,
            'averageRain' => $averageRain,
            'averageTimeRain' => $averageTimeRain,
        ]);
    }

    public function outfit(Place $place): Response
    {
        $forecast = $place->forecast()->get();
        // get a outfit for male and female for every day
        // outfit consists of a top, bottom, shoes, and accessories
        // the outfit should be based on the weather forecast
        // the outfit should be based on the average temperature, rain, and time of rain

        return Inertia::render('Recommendations/Outfit', [
            'place' => $place->toArray(),
            'outfit' => $this->getOutfit($forecast->avg('temperature_max'), $forecast->avg('rain_sum'), $forecast->avg('precipitation_hours')),
        ]);
    }

    public function places(Place $place): Response
    {
        $forecast = $place->forecast()->get();

        return Inertia::render('Recommendations/Places', [
            'place' => $place->toArray(),
            'places' => $this->getPlaces($forecast->avg('temperature_max'), $forecast->avg('rain_sum'), $forecast->avg('precipitation_hours')),
        ]);
    }

    private function getOutfit($averageTemperature, $averageRain, $averageTimeRain)
    {
        $products = [
            'male' => [
                'head' => [
                    [
                        'title' => 'Pfiffige Mütze (für Dates geeignet)',
                        'minTemperature' => -20,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/61ATAfERE1L._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.com/-/de/dp/B0D3CRCJQP/',
                    ],
                    [
                        'title' => 'Cap Schwarz',
                        'minTemperature' => 18,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/61AELGi8+wL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/Carhartt-Percent-Moisture-Wicking-Ashland/dp/B00MNLR1ME/',
                    ],
                    [
                        'title' => 'Cap Schwarz',
                        'minTemperature' => 18,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/61pSuZP7SVL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/Flexfit-fusselfrei-6277-Schwarz-cm-18-4/dp/B073DWP91X/',
                    ],
                    [
                        'title' => 'Cap Weiß',
                        'minTemperature' => 18,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/41+BvpzM95L._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/Nike-Baseballkappe-White-Metallic-Silver/dp/B0C4YVFY9G/',
                    ],
                    [
                        'title' => 'Beanie Grün',
                        'minTemperature' => -20,
                        'maxTemperature' => 17,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/71cqFnoQ6CL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/Beechfield-Vintage-Beanie-Heritage-Beanie-Einheitsgr%C3%B6%C3%9Fe/dp/B076TNBVNP/',
                    ],
                    [
                        'title' => 'Beanie Schwarz',
                        'minTemperature' => -20,
                        'maxTemperature' => 17,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/71ff4Vv61zL._AC_SY879_.jpg',
                        'url' => 'https://www.amazon.de/Champion-Lifestyle-Caps-802405-Beanie-M%C3%BCtze-Schwarz/dp/B0BRL8QLBK/',
                    ],
                ],
                'top' => [
                    [
                        'title' => 'Hoodie Weiß',
                        'minTemperature' => -20,
                        'maxTemperature' => 18,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/51Sv3Bv8xxL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.com/-/de/dp/B0C784D8NB/',
                    ],
                    [
                        'title' => 'Hoodie Schwarz',
                        'minTemperature' => -20,
                        'maxTemperature' => 18,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/51cB8iGPJZL._AC_SY879_.jpg',
                        'url' => 'https://www.amazon.com/-/de/dp/B089VH8H6Q/',
                    ],
                    [
                        'title' => 'Flottes T-Shirt',
                        'minTemperature' => 10,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/B1pppR4gVKL._CLa%7C2140%2C2000%7C9130oad0UhL.png%7C0%2C0%2C2140%2C2000%2B0.0%2C0.0%2C2140.0%2C2000.0_AC_SX679_.png',
                        'url' => 'https://www.amazon.de/ninjesus-Funny-Jesus-Shirts-Christian/dp/B07G6JS572',
                    ],
                    [
                        'title' => 'T-Shirt für echte Männer',
                        'minTemperature' => 10,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/B1pppR4gVKL._CLa%7C2140%2C2000%7C91RIpngze0L.png%7C0%2C0%2C2140%2C2000%2B0.0%2C0.0%2C2140.0%2C2000.0_AC_SX679_.png',
                        'url' => 'https://www.amazon.de/Disney-Lightning-McQueen-Portrait-T-Shirt/dp/B07ZZTVWF2/',
                    ],
                ],
                'bottom' => [
                    [
                        'title' => 'Kurze Hose Schwarz',
                        'minTemperature' => 10,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/71y62GE0FJL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/PUMA-Herren-Shorts-Black-White/dp/B07822VW2X/',
                    ],
                    [
                        'title' => 'Jeans Hose',
                        'minTemperature' => -20,
                        'maxTemperature' => 40,
                        'rain' => false,
                        'image' => 'https://m.media-amazon.com/images/I/61tnxHHywrL._AC_SY879_.jpg',
                        'url' => 'https://www.amazon.de/JACK-JONES-Herren-Stretchjeans-Herrenhose/dp/B07NJ9NZDX/',
                    ],
                    [
                        'title' => 'Hose vielleicht wasserabweisend',
                        'minTemperature' => -20,
                        'maxTemperature' => 40,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/61thcpuREGL._AC_SX679_.jpg',
                        'url' => 'https://www.amazon.de/FEIXIANG-Trekkinghose-Atmungsaktiv-Softshellhose-Angeln-Aktivit%C3%A4ten/dp/B0BS1C78B6',
                    ],
                    [
                        'title' => 'Jogginghose Lässig',
                        'minTemperature' => -20,
                        'maxTemperature' => 40,
                        'rain' => true,
                        'image' => 'https://m.media-amazon.com/images/I/61WtsyFFHHS._AC_SY879_.jpg',
                        'url' => 'https://www.amazon.de/COMEOR-Jogginghose-Herren-Baumwolle-Sweathose/dp/B096N4J25F',
                    ],
                ],
            ],
        ];

        $products = collect($products);

        $outfit = $products->map(fn ($gender) => collect($gender)->map(fn ($category) => collect($category)->filter(fn ($product) => $product['minTemperature'] <= $averageTemperature && $product['maxTemperature'] >= $averageTemperature && $product['rain'] == ($averageRain > 10))->random()));

        return $outfit;
    }

    public function getPlaces($averageTemperature, $averageRain, $averageTimeRain)
    {
        $keywords = [];
        $keywords[] = 'museum';

        if ($averageTemperature > 20) {
            $keywords[] = 'beach';
        }
        if ($averageTemperature > 10) {
            $keywords[] = 'park';
        }
        if ($averageRain > 10) {
            $keywords[] = 'indoor';
        }
        if ($averageTimeRain > 15) {
            $keywords[] = 'indoor';
        }
        if ($averageTemperature < 0) {
            $keywords[] = 'ski';
        }
        if ($averageTemperature < 10) {
            $keywords[] = 'cafe';
        }
        if ($averageTemperature < 35) {
            $keywords[] = 'restaurant';
        }
        if ($averageTemperature > 25) {
            $keywords[] = 'beachbar';
        }

        $googlePlaces = new PlacesApi(config('services.google.key'));

        $places = $googlePlaces->nearbySearch($this->place->location->latitude.','.$this->place->location->longitude, 20, [
            'keyword' => $keywords[array_rand($keywords)],
        ]);
        if (! $places['results']) {
            return [];
        }

        return $places['results']->map(function ($place) {
            return [
                'name' => $place['name'],
                'rating' => $place['rating'] ?? null,
            ];
        });
    }
}
