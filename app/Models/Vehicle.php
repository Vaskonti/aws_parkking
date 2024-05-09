<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Vehicle extends Model
{
    use HasFactory;

    protected string $registration_plate;
    protected string $brand;
    protected string $model;
    protected string $color;
    protected string $category;

    protected $table = 'cars';

    //@review not something major, but in general the db columns and in that number mongo fields should be lowercase_separated_by_underscores
    protected $fillable = [
        'registration_plate',
        'brand',
        'model',
        'color',
        'time_entered',
        'time_exited',
        'category',
        'card',
        'sumPaid',
    ];

    public function newFromBuilder($attributes = [], $connection = null): self
    {
        $model = match ($attributes['category']) {
            'B' => new Car($attributes),
            'D' => new Bus($attributes),
            'C' => new Truck($attributes),
            default => $this->newInstance(),
        };
        $model->exists = true;
        $model->setRawAttributes((array)$attributes, true);

        return $model;
    }

    public static function vehicleInsideParking(string $registrationPlate)
    {
        return self::where('registration_plate', $registrationPlate)->whereNull('time_exited')->exists();
    }

    protected function getPrices(): array
    {
        return [
            'day' => 0,
            'night' => 0,
        ];
    }

}
