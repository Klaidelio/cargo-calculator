<?php

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Requests\CargoTypeRequest;
use App\Http\Requests\NewCargoRequest;
use App\Models\Cargo;
use App\Models\CargoType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CargoController extends Controller
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Cargo::with('cargoType')->get();
    }

    /**
     * @param NewCargoRequest $request
     * @return Cargo
     */
    public function store(NewCargoRequest $request)
    {
        $cargoData = $request->all();

        $cargoData['price'] = $this->getCargoPrice($request);

        return Cargo::create($cargoData);
    }

    /**
     * Returns
     *
     * @param NewCargoRequest $request
     * @return float
     */
    public function getCargoPrice(NewCargoRequest $request): float
    {
        $cargoTypeID = $request->get('cargoTypeId');

        $distance = $request->get('distance');
        $weight = $request->get('weight');
        $isDangerous = $request->get('isDangerous');

        $cargoType = CargoTypeEnum::from($cargoTypeID);

        $cargoTypeClass = $cargoType->getCargoTypeClass();

        return $cargoTypeClass->calculatePrice(
            $distance,
            $weight,
            (bool) $isDangerous
        );
    }
}
