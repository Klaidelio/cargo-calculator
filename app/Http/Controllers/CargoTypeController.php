<?php

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Requests\CargoTypeRequest;
use Illuminate\Http\JsonResponse;

class CargoTypeController extends Controller
{
    /**
     * Returns
     *
     * @param CargoTypeRequest $request
     * @return JsonResponse
     */
    public function getCargoPrice(CargoTypeRequest $request): JsonResponse
    {
        $cargoTypeID = $request->get('cargoType');

        $distance = $request->get('distance');
        $weight = $request->get('weight');
        $isDangerous = $request->get('isDangerous');

        $cargoType = CargoTypeEnum::from($cargoTypeID);

        $cargoTypeClass = $cargoType->getCargoTypeClass();

        $price = $cargoTypeClass->calculatePrice(
            $distance,
            $weight,
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
