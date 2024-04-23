<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Controllers\Interfaces\CargoTypeInterface;

class CargoTypeCar implements CargoTypeInterface
{
    public function __construct(
        private CargoTypeEnum $cargoTypeEnum
    ) {

    }

    public function calculatePrice(float $distance, float $weight, bool $isDangerous = false): float
    {
        $pricePerDistance = $isDangerous
            ? $this->cargoTypeEnum->getDangerousCargoDistancePrice()
            : $this->cargoTypeEnum->getCargoDistancePrice();

        $pricePerWeight = $isDangerous
            ? $this->cargoTypeEnum->getDangerousCargoWeightPrice()
            : $this->cargoTypeEnum->getCargoWeightPrice();

        return (($pricePerDistance * $distance) * 2) + (($pricePerWeight * $weight) * 5);
    }
}
