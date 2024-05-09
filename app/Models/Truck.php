<?php

namespace App\Models;

final class Truck extends Vehicle
{
    public const NEEDED_SLOTS = 4;
    public const CATEGORY = "C";
    public const PRICE_DAY = 12;
    public const PRICE_NIGHT = 6;

    protected $table = 'cars';


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->category = self::CATEGORY;
    }

    public function getNeededSlots(): int
    {
        return self::NEEDED_SLOTS;
    }

    public function getPrices(): array
    {
        return [
          'day' => self::PRICE_DAY,
          'night' => self::PRICE_NIGHT,
        ];
    }

}
