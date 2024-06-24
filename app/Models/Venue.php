<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Event;

class Venue extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'location',
    ];

    protected $appends = [
        'location',
    ];

    public $timestamps = false;


    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function getLocationAttribute(): array
    {
        return [
            "lat" => (float)$this->lat,
            "lng" => (float)$this->lng,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['lat'] = $location['lat'];
            $this->attributes['lng'] = $location['lng'];
            unset($this->attributes['location']);
        }
    }

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'lat',
            'lng' => 'lng',
        ];
    }
    public static function getComputedLocation(): string
    {
        return 'location';
    }
}
