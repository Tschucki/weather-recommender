<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Places extends Model
{
    use HasFactory;
    use HasSpatial;

    protected $guarded = [];

    protected $casts = [
        'location' => Point::class,
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_place');
    }
}
