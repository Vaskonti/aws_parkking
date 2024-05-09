<?php

namespace App\Models\Factories;

use App\Models\Bus;
use App\Models\Car;
use App\Models\Truck;
use App\Models\Vehicle;

class VehicleFactory
{
    public static function build(array $attributes): Vehicle
    {
        return match ($attributes['category']) {
            'B' => new Car($attributes),
            'D' => new Bus($attributes),
            'C' => new Truck($attributes),
            default => new Vehicle(),
        };
    }
}
