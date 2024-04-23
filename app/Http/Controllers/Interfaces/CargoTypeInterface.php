<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interfaces;

interface CargoTypeInterface
{
    /**
     * Function for each cargo type to implement.
     *
     * @param float $distance Distance in kilometers
     * @param float|int $weight Weight in kilograms or number of cars (MAX - 8)
     * @param bool $isDangerous Boolean to set cargo as dangerous
     *
     * @return float Total price
     */
    public function calculatePrice(float $distance, float|int $weight, bool $isDangerous = false): float;
}
