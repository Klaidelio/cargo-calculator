<?php

namespace App\Http\Requests;

use App\Enums\CargoTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CargoTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cargoType' => [
                'required',
                Rule::in(array_column(CargoTypeEnum::cases(), 'value')),
                'integer'
            ],
            'distance' => 'required',
            'weight' => 'required',
            'isDangerous' => 'boolean'
        ];
    }
}
