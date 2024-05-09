<?php

namespace App\Models\Factories;

use App\Models\Bus;
use App\Models\Car;
use App\Models\Truck;
use App\Models\Vehicle;

class VehicleFactory
{
    public static function build(array $attributes)
    {
        return match ($attributes['category']) {
            'A' => new Car($attributes),
            'B' => new Bus($attributes),
            'C' => new Truck($attributes),
            default => new Vehicle(),
        };
    }
}
