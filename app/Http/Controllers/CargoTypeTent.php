<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Controllers\Interfaces\CargoTypeInterface;

class CargoTypeTent implements CargoTypeInterface
{
    public function __construct(
        private readonly CargoTypeEnum $cargoTypeEnum
    ) {

    }

    /**
     * @inheritDoc
     */
    public function calculatePrice(float $distance, float|int $weight, bool $isDangerous = false): float
    {
        $pricePerDistance = $isDangerous
            ? $this->cargoTypeEnum->getDangerousCargoDistancePrice()
            : $this->cargoTypeEnum->getCargoDistancePrice();

        $pricePerWeight = $isDangerous
            ? $this->cargoTypeEnum->getDangerousCargoWeightPrice()
            : $this->cargoTypeEnum->getCargoWeightPrice();

        return round((($pricePerDistance * $distance) + ($pricePerWeight * $weight)) / 100, 2);
    }
}
