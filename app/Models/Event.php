<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Awcodes\Curator\Models\Media;
use App\Models\Venue;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_start' => 'date'
    ];

    public $timestamps = false;

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class)->withDefault();
    }
    public function posterImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'poster', 'id');
    }
}
