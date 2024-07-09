<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Venue;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $append = [
        'period'
    ];

    protected $casts = [
        'media' => 'array',
        'date_start' => 'date',
        'date_end' => 'date',
    ];

    public $timestamps = false;

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class)->withDefault();
    }

    protected function getPeriodAttribute()
    {
        return $this->date_start?->format('Y-m-d') . 'to ' . $this->date_end?->format('Y-m-d');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
}
