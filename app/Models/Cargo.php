<?php

namespace App\Models;

use Carbon\Carbon;
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
    public const DANGEROUS = 'dangerous';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = 'cargos';
    protected $primaryKey = self::CARGO_ID;

    protected $fillable = [
        self::CARGO_TYPE_ID,
        self::DISTANCE,
        self::WEIGHT,
        self::PRICE,
        self::DANGEROUS
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

    public function getCargoInformation()
    {
        $dangerous = $this->getAttribute(Cargo::DANGEROUS);
        $distance = $this->getAttribute(Cargo::DISTANCE) . 'km';
        $weight = $this->getAttribute(Cargo::CARGO_TYPE_ID) === 1
            ? $this->getAttribute(Cargo::WEIGHT) . ' aut'
            : $this->getAttribute(Cargo::WEIGHT) . 'kg';

        return $dangerous
            ? "{$weight}; {$distance}; Pavojingas"
            : "{$weight}; {$distance}";
    }

    public function getCargoPrice()
    {
        return number_format(($this->getAttribute(Cargo::PRICE) / 100), 2) . ' EUR';
    }

    public function getFormattedDate()
    {
        return Carbon::create($this->getAttribute(Cargo::CREATED_AT))->format('Y-m-d');
    }
}
