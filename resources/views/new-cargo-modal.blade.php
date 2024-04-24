<div class="modal fade" id="new_cargo_form_modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="new_cargo_form_modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="new_cargo_form_modal_title">{{ __('Naujo krovinio pervežimo forma') }}</h3>
                <button id="close_cargo_modal" type="button" class="btn-close new_cargo_form_close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="new_cargo_form">
                    @csrf
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-6 cargo_cargo_type">
                                <label for="cargo_cargo_type" class="form-label">{{ __('Krovinio tipas') }}</label>
                                <select id="cargo_cargo_type" name="cargo_cargo_type" class="form-select">
                                    <option value="0" selected>{{ __('Pasirinkite') }}</option>
                                    @foreach ($cargoTypes as $cargoType)
                                        <option value="{{ $cargoType['cargo_type_id'] }}">{{ $cargoType['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 cargo_distance">
                                <label for="cargo_distance" class="form-label">{{ __('Atstumas (km)') }}</label>
                                <input type="number" class="form-control" id="cargo_distance" min="0">
                            </div>
                        </div>
                        <div class="first_cargo_type">
                            <div class="row mb-4">
                                <div class="col-6 cargo_cars_count">
                                    <label for="cargo_cars_count" class="form-label">{{ __('Automobilių kiekis') }}</label>
                                    <input type="number" class="form-control" id="cargo_cars_count" name="weight" min="1" max="8">
                                    <small class="info text-danger">{{ __('Maksimalus leistinas automobilių kiekis yra 8') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="second_cargo_type">
                            <div class="row mb-4">
                                <div class="col-6 cargo_weight">
                                    <label for="cargo_weight" class="form-label">{{ __('Krovinio svoris (kg)') }}</label>
                                    <input type="number" class="form-control" id="cargo_weight" name="weight" min="500">
                                    <small class="info text-danger">{{ __('Minimalus leistinas svoris 500kg') }}</small>
                                </div>
                                <div class="col-6 cargo_dangerous">
                                    <div class="form-check">
                                        <label for="cargo_dangerous" class="form-check-label">{{ __('Pavojingas krovinys?') }}</label>
                                        <input type="checkbox" class="form-check-input" id="cargo_dangerous" name="dangerous">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="cargo_form_submit_btn" data-bs-toggle="#new_cargo_form_response" data-bs-target="modal">Sukurti</button>
            </div>
        </div>
    </div>
</div>
