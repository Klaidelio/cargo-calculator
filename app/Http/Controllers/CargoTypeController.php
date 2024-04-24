<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCargoTypeRequest;
use App\Http\Resources\CargoTypeCollection;
use App\Http\Resources\CargoTypeResource;
use App\Models\Cargo;
use App\Models\CargoType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CargoTypeController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return CargoTypeCollection
     */
    public function getAll(): CargoTypeCollection
    {
        return new CargoTypeCollection(
            CargoType::all()
        );
    }

    /**
     * @param NewCargoTypeRequest $request
     * @return CargoTypeResource
     */
    public function store(NewCargoTypeRequest $request): CargoTypeResource
    {
        $cargoTypeData = $request->all();

        try {
            $newCargoType = CargoType::create($cargoTypeData);
        } catch (\Throwable $th) {
            Log::error(
                sprintf(
                    'Failed to create new cargo type: %s',
                    $th->getMessage()
                )
            );

            return new CargoTypeResource([]);
        }

        return new CargoTypeResource($newCargoType);
    }
}
