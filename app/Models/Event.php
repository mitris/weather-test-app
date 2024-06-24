<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Venue;

class Event extends Model
{
    use HasFactory;

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
}
