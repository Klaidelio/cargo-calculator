<?php

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Requests\NewCargoRequest;
use App\Http\Resources\CargoCollection;
use App\Http\Resources\CargoResource;
use App\Models\Cargo;
use Illuminate\Support\Facades\Log;

class CargoController extends Controller
{
    /**
     * @return CargoCollection
     */
    public function getAll(): CargoCollection
    {
        $cargos = Cargo::with('cargoType')->get();

        return new CargoCollection($cargos);
    }

    /**
     * @param NewCargoRequest $request
     * @return CargoResource
     */
    public function store(NewCargoRequest $request): CargoResource
    {
        $cargoData = $request->all();

        $cargoData['price'] = $this->getCargoPrice($request);

        try {
            $newCargo = Cargo::create($cargoData);
        } catch (\Throwable $th) {
            Log::error(
                sprintf(
                    'Failed to create new cargo record: %s',
                    $th->getMessage()
                )
            );

            return new CargoResource([]);
        }

        return new CargoResource($newCargo);
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
