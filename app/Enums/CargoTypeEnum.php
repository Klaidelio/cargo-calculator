<?php

namespace App\Enums;

use App\Http\Controllers\CargoTypeCar;
use App\Http\Controllers\CargoTypeTent;
use App\Http\Controllers\Interfaces\CargoTypeInterface;

enum CargoTypeEnum: string
{
    case CARGO_CAR = '1';
    case CARGO_TENT = '2';

    /**
     * @return float Returns price amount of 1KG
     */
    public function getCargoWeightPrice()
    {
        return match ($this) {
            self::CARGO_CAR => 0.1,
            self::CARGO_TENT => 0.2
        };
    }

    /**
     * @return float Returns price amount of 1KM
     */
    public function getCargoDistancePrice()
    {
        return match ($this) {
            self::CARGO_CAR => 0.5,
            self::CARGO_TENT => 0.4
        };
    }

    /**
     * @return float Returns price amount of 1KG for dangerous cargo
     */
    public function getDangerousCargoWeightPrice()
    {
        return match ($this) {
            self::CARGO_CAR => 0.5,
            self::CARGO_TENT => 0.7
        };
    }

    /**
     * @return float Returns price amount of 1KM for dangerous cargo
     */
    public function getDangerousCargoDistancePrice()
    {
        return match ($this) {
            self::CARGO_CAR => 0.12,
            self::CARGO_TENT => 1.0
        };
    }

    /**
     * @return CargoTypeInterface Returns correct class for calculation
     */
    public function getCargoTypeClass(): CargoTypeInterface
    {
        return match ($this) {
            self::CARGO_CAR => new CargoTypeCar($this),
            self::CARGO_TENT => new CargoTypeTent($this)
        };
    }
}
