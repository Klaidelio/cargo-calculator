<?php

namespace App\Http\Controllers;

use App\Enums\CargoTypeEnum;
use App\Http\Requests\NewCargoRequest;
use App\Http\Resources\CargoCollection;
use App\Http\Resources\CargoResource;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CargoController extends Controller
{
    /**
     * @param Request $request
     * @return CargoCollection
     */
    public function getAll(Request $request): CargoCollection
    {
        $cargos = Cargo::with('cargoType');

        if ($request->has('cargo_type_id')) {
            $cargos->where(
                'cargo_type_id',
                $request->get('cargo_type_id')
            );
        }

        return new CargoCollection($cargos->get());
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
        $cargoTypeID = $request->get('cargo_type_id');

        $distance = $request->get('distance');
        $weight = $request->get('weight');
        $isDangerous = $request->get('dangerous');

        $cargoType = CargoTypeEnum::from($cargoTypeID);

        $cargoTypeClass = $cargoType->getCargoTypeClass();

        return $cargoTypeClass->calculatePrice(
            $distance,
            $weight,
            (bool) $isDangerous
        );
    }
}
