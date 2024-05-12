<?php

declare(strict_types=1);

namespace App\Models;

final class Bus extends Vehicle
{
    public const NEEDED_SLOTS = 2;
    public const CATEGORY = "D";
    public const PRICE_DAY = 6;
    public const PRICE_NIGHT = 4;

    protected $table = 'cars';

    protected  string $category;

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
