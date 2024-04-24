<?php

namespace App\Http\Controllers;

use App\Models\CargoType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CargoResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $cargoTypes = CargoType::all()->toArray();

        return view('welcome', ['cargoTypes' => $cargoTypes]);
    }
}
