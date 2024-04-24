<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CargoCalculator</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="container py-3">
        <h1>{{ __('Krovinių pervežimo sąrašas') }}</h1>
        <div class="cargos_table_container">
            <div class="cargos_table_actions">
                <div class="cargos_table_cargo_type_filter input-group">
                    <span class="input-group-text">{{ __('Tipas') }}</span>
                    <select class="form-select" name="cargo_type" id="cargo_type">
                        <option selected value="0">{{ __('Pasirinkite') }}</option>
                        @foreach ($cargoTypes as $cargoType)
                            <option value="{{ $cargoType['cargo_type_id'] }}">{{ $cargoType['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="cargos_table_add_new_cargo_container">
                    <button class="btn btn-primary" id="new_cargo_modal_btn" data-bs-toggle="modal" data-bs-target="#new_cargo_form_modal">
                        <i class="fa-solid fa-plus"></i>
                        {{ __('Pridėti naują darbuotoją') }}
                    </button>
                </div>
            </div>
            <table id="cargos_datatable" class="table table-responsive table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">{{ __('Data') }}</th>
                    <th scope="col">{{ __('Tipas') }}</th>
                    <th scope="col">{{ __('Krovinio informacija') }}</th>
                    <th scope="col">{{ __('Pervežimo kaina') }}</th>
                </tr>
                </thead>
                <tbody class="cargos_table_rows"></tbody>
            </table>
            <div class="cargos_table_pagination">
                <div class="cargos_table_total_container">
                </div>
                <ul id="cargos_pagination" class="pagination doc_pagination"></ul>
            </div>
        </div>
    </div>
    @include('new-cargo-modal', ['cargoTypes' => $cargoTypes])
    </body>
</html>
