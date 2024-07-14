<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Weather extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
    ];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'place_id' => $this->place->id,
            'date' => Carbon::make($this->date)->format('d.m.Y'),
            'weather_code' => $this->weather_code,
            'weather_description' => $this->weatherDescription,
            'temperature_max' => $this->temperature_max,
            'temperature_min' => $this->temperature_min,
            'uv_index_max' => $this->uv_index_max,
            'rain_sum' => $this->rain_sum,
            'showers_sum' => $this->showers_sum,
            'snowfall_sum' => $this->snowfall_sum,
            'precipitation_hours' => $this->precipitation_hours,
            'created_at' => '2024-07-14 12:46:48',
            'updated_at' => '2024-07-14 12:46:48',
        ];
    }

    public function getWeatherDescriptionAttribute(): string
    {
        return match ($this->weather_code) {
            // Synop Present Weather Codes (WMO Code Table 4677)
            00 => 'Klarer Himmel',
            01 => 'Teilweise bewölkt',
            02 => 'Bewölkt',
            03 => 'Bewölkung zunehmend',
            04 => 'Bewölkung abnehmend',
            05 => 'Himmel unsichtbar, außer durch undurchsichtigen Dunst',
            10 => 'Nebel',
            20 => 'Nieseln',
            21 => 'Regen',
            22 => 'Schnee',
            23, 83 => 'Schneeregen',
            24, 56 => 'Eiskörner',
            25 => 'Schauer',
            26 => 'Gewitter',
            27 => 'Sandsturm, Staubsturm',
            30 => 'Leichter oder mäßiger Nebel',
            31 => 'Dichter Nebel',
            32 => 'Leichter oder mäßiger Nebel mit Sichtweite unter 1 km',
            33 => 'Dichter Nebel mit Sichtweite unter 1 km',
            40 => 'Dunst',
            41 => 'Staub oder Sand in der Luft, kein Wirbelwind',
            42 => 'Staub oder Sand in der Luft, mit Wirbelwind',
            43 => 'Rauch',
            44 => 'Eisnebel',
            45 => 'Nebelschwaden in Sichtweite',
            46 => 'Dunstschwaden',
            47 => 'Trockener Dunst',
            48 => 'Frostnebel',
            50 => 'Leichter Nieselregen',
            51 => 'Mäßiger Nieselregen',
            52 => 'Starker Nieselregen',
            53 => 'Gefrierender Nieselregen',
            54 => 'Gefrierender Nieselregen, mäßig',
            55 => 'Gefrierender Nieselregen, stark',
            57, 66 => 'Gefrierende Regentropfen',
            58, 67 => 'Gefrierende Regentropfen, mäßig oder stark',
            60 => 'Leichter Regen',
            61 => 'Mäßiger Regen',
            62 => 'Starker Regen',
            63 => 'Gefrierender Regen',
            64 => 'Gefrierender Regen, mäßig',
            65 => 'Gefrierender Regen, stark',
            68 => 'Gefrierender Nieselregen oder Regen mit Schnee',
            69 => 'Gefrierender Nieselregen oder Regen mit Schnee, mäßig oder stark',
            70 => 'Leichter Schneefall',
            71 => 'Mäßiger Schneefall',
            72 => 'Starker Schneefall',
            73 => 'Schneeschauer',
            74 => 'Schneeschauer, mäßig',
            75 => 'Schneeschauer, stark',
            76 => 'Graupelschauer',
            77 => 'Schneekörner',
            78 => 'Eisnadeln',
            79 => 'Graupel oder Hagel',
            80 => 'Schauerregen',
            81 => 'Mäßiger Schauerregen',
            82 => 'Starker Schauerregen',
            84 => 'Mäßiger Schneeregen',
            85 => 'Starker Schneeregen',
            86 => 'Hagel',
            87 => 'Gewitter mit Regen',
            88 => 'Gewitter mit Schnee',
            89 => 'Gewitter mit Hagel',
            90 => 'Gewitter ohne Niederschlag',
            91 => 'Gewitter in der Nähe',
            92 => 'Sandsturm oder Staubsturm in der Nähe',
            93, 98 => 'Tornado in der Nähe',
            94 => 'Wirbelwind',
            95 => 'Sandsturm oder Staubsturm',
            96 => 'Wasserhose',
            97 => 'Tornado',
            99 => 'Starkes Gewitter mit Hagel',
            default => 'Keine Ahnung was hier abgeht (Unbekannter Wettercode)',
        };
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
