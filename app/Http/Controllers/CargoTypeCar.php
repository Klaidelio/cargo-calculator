<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Controllers\Interfaces\CargoTypeInterface;

class CargoTypeCar implements CargoTypeInterface
{
    /** Price in cents */
    private const FIRST_CAR_PRICE_PER_KM = 100;
    private const NEXT_CAR_PRICE_DEDUCTION = 5;

    public function __construct(
        private CargoTypeEnum $cargoTypeEnum
    ) {

    }

    /**
     * @inheritDoc
     */
    public function calculatePrice(float $distance, float|int $weight, bool $isDangerous = false): float
    {
        $totalCarsPrices = $this->calculateTotalCarsPrices(
            $weight,
            $distance
        );

        $pricePerDistance = $this->cargoTypeEnum->getCargoDistancePrice();

        $totalDistancePrice = $pricePerDistance * $distance;

        return ($totalDistancePrice + $totalCarsPrices) / 100;
    }

    /**
     * Calculates each car total price
     *
     * @param int $totalCarsCount Number of cars in the cargo
     * @param float $distance Distance in kilometers
     * @return float Total cars price
     */
    private function calculateTotalCarsPrices(int $totalCarsCount, float $distance): float
    {
        $totalCarsCountPrice = 0;

        $carPrice = self::FIRST_CAR_PRICE_PER_KM;
        for ($i = 0; $i < $totalCarsCount; ++$i) {
            $totalCarsCountPrice += ($distance * $carPrice);
            $carPrice -= self::NEXT_CAR_PRICE_DEDUCTION;
        }

        return $totalCarsCountPrice;
    }
}
