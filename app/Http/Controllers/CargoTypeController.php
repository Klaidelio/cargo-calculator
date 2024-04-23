<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCargoTypeRequest;
use App\Models\Cargo;
use App\Models\CargoType;
use Illuminate\Database\Eloquent\Collection;

class CargoTypeController extends Controller
{
    public function __construct()
    {

    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return CargoType::all();
    }

    /**
     * @param NewCargoTypeRequest $request
     * @return CargoType
     */
    public function store(NewCargoTypeRequest $request): CargoType
    {
        $cargoTypeData = $request->all();

        return CargoType::create($cargoTypeData);
    }
}
