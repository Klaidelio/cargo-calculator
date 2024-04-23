<?php
declare(strict_types=1);

namespace App\Http\Controllers\Interfaces;

interface CargoTypeInterface
{
    public function calculatePrice(float $distance, float $weight, bool $isDangerous = false): float;
}
