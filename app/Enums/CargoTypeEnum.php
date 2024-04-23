<?php

namespace App\Enums;

use App\Http\Controllers\CargoTypeCar;
use App\Http\Controllers\CargoTypeTent;
use App\Http\Controllers\Interfaces\CargoTypeInterface;

enum CargoTypeEnum: int
{
    case CARGO_CAR = 1;
    case CARGO_TENT = 2;

    /**
     * @return int Returns price amount of 1KG
     */
    public function getCargoWeightPrice(): int
    {
        return match ($this) {
            self::CARGO_CAR, self::CARGO_TENT => 50,
        };
    }

    /**
     * @return int Returns price amount of 1KM
     */
    public function getCargoDistancePrice(): int
    {
        return match ($this) {
            self::CARGO_CAR, self::CARGO_TENT => 10
        };
    }

    /**
     * @return int Returns price amount of 1KG for dangerous cargo
     */
    public function getDangerousCargoWeightPrice(): int
    {
        return match ($this) {
            self::CARGO_CAR, self::CARGO_TENT => 80
        };
    }

    /**
     * @return int Returns price amount of 1KM for dangerous cargo
     */
    public function getDangerousCargoDistancePrice(): int
    {
        return match ($this) {
            self::CARGO_CAR, self::CARGO_TENT => 20
        };
    }

    /**
     * @return CargoTypeInterface Returns CargoType class for calculation
     */
    public function getCargoTypeClass(): CargoTypeInterface
    {
        return match ($this) {
            self::CARGO_CAR => new CargoTypeCar($this),
            self::CARGO_TENT => new CargoTypeTent($this)
        };
    }
}
