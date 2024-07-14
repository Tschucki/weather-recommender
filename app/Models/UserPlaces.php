<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPlaces extends Pivot
{
    protected $table = 'user_place';
    protected $guarded = [];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Places::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
