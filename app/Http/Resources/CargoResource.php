<?php

namespace App\Http\Resources;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CargoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Cargo $cargo */
        $cargo = $this->resource;

        if (!$cargo) {
            return [];
        }

        return [
            'date' => $cargo->getFormattedDate(),
            'type' => $cargo->cargoType()->first(),
            'cargoInformation' => $cargo->getCargoInformation(),
            'price' => $cargo->getCargoPrice()
        ];
    }
}
