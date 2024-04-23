<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cargo extends Model
{
    use HasFactory;

    public const CARGO_ID = 'cargo_id';
    public const CARGO_TYPE_ID = 'cargo_type_id';
    public const DISTANCE = 'distance';
    public const WEIGHT = 'weight';
    public const PRICE = 'price';

    protected $table = 'cargos';
    protected $primaryKey = self::CARGO_ID;

    protected $fillable = [
        self::CARGO_TYPE_ID,
        self::DISTANCE,
        self::WEIGHT,
        self::PRICE
    ];

    protected $casts = [

    ];

    /**
     * @return HasOne
     */
    public function cargoType(): HasOne
    {
        return $this->hasOne(
            CargoType::class,
            self::CARGO_TYPE_ID,
            CargoType::CARGO_TYPE_ID
        );
    }
}
