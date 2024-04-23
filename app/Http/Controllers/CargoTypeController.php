<?php

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CargoTypeController extends Controller
{
    public function getCargoPrice(Request $request): JsonResponse
    {
        $cargoTypeID = $request->get('cargoType');

        if (!$cargoTypeID || !CargoTypeEnum::tryFrom($cargoTypeID)) {
            return new JsonResponse(
                [
                    'error' => 'cargoType parameter value is empty or invalid'
                ],
                400
            );
        }

        $distance = $request->get('distance');
        $weight = $request->get('weight');
        $isDangerous = $request->get('isDangerous');

        $cargoType = CargoTypeEnum::from($cargoTypeID);

        $cargoTypeClass = $cargoType->getCargoTypeClass();

        $price = $cargoTypeClass->calculatePrice(
            (float) $distance,
            (float) $weight,
            (bool) $isDangerous
        );

        return new JsonResponse(
            [
                'data' => [
                    'price' => $price
                ]
            ]
        );
    }
}
