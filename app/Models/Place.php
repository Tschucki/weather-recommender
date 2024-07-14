<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Place extends Model
{
    use HasFactory;
    use HasSlug;
    use HasSpatial;

    protected $guarded = [];

    protected $casts = [
        'location' => Point::class,
    ];

    public function toArray()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'latitude' => $this->location->latitude,
            'longitude' => $this->location->longitude,
            'population' => $this->population,
            'country_code' => $this->country_code,
            'country' => $this->country,
            'timezone' => $this->timezone,
            'flag' => $this->flag,
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'country_code'])
            ->saveSlugsTo('slug');
    }

    public function weathers(): HasMany
    {
        return $this->hasMany(Weather::class);
    }

    public function forecast(): HasMany
    {
        return $this->hasMany(Weather::class)->orderBy('date', 'asc')->limit(7);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_place');
    }

    public static function makeHash(
        string $name,
        float $latitude,
        float $longitude
    ): string {
        return md5($name.$latitude.$longitude);
    }

    public function getFlagAttribute(): string
    {
        return country_flag($this->country_code);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
