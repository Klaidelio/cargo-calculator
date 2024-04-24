<?php

namespace App\Http\Resources;

use App\Models\CargoType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CargoTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var CargoType $cargoType */
        $cargoType = $this->resource;

        if (!$cargoType) {
            return [];
        }

        return [
            'cargo_type_id' => $cargoType->getAttribute(CargoType::CARGO_TYPE_ID),
            'name' => $cargoType->getAttribute(CargoType::NAME)
        ];
    }
}
