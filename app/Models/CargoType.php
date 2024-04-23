<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoType extends Model
{
    use HasFactory;

    public const CARGO_TYPE_ID = 'cargo_type_id';
    public const NAME = 'name';

    protected $primaryKey = self::CARGO_TYPE_ID;
    protected $table = 'cargo_types';

    protected $fillable = [
        self::NAME
    ];

    protected $casts = [

    ];
}
