import { Modal } from "bootstrap";
import { DataTable } from "./components/table.js";
import Swal from 'sweetalert2';

window.addEventListener('DOMContentLoaded', function () {
    const modalDOM = document.getElementById('new_cargo_form_modal');
    const modalBtn = document.getElementById('new_cargo_modal_btn');

    const modalObject = new Modal(
        modalDOM,
        {
            backdrop: 'static',
            keyboard: false,
            focus: true
        }
    )

    modalBtn.addEventListener('click', function () {
        modalObject.toggle();
    });

    const cargosDataTable = new DataTable(
        'cargos_datatable',
        document.querySelector(`meta[name="csrf-token"]`).content
    );

    cargosDataTable.fetchData(
        window.location.origin + '/api/cargos',
        'GET',
        null
    );

    const cargoTypeSelect = document.getElementById('cargo_cargo_type');
    const firstCargoType = document.querySelector('.first_cargo_type');
    const secondCargoType = document.querySelector('.second_cargo_type');

    if (cargoTypeSelect) {
        cargoTypeSelect.addEventListener('change', function () {
            const cargoTypeId = parseInt(this.value);

            switch (cargoTypeId) {
                case 0:
                    firstCargoType.style.display = 'none';
                    secondCargoType.style.display = 'none';
                    break;
                case 1:
                    firstCargoType.style.display = 'block';
                    secondCargoType.style.display = 'none';
                    break;
                case 2:
                    firstCargoType.style.display = 'none';
                    secondCargoType.style.display = 'block';
                    break;
            }
        });
    }

    const cargoSubmitBtn = document.getElementById('cargo_form_submit_btn');
    if (cargoSubmitBtn) {
        cargoSubmitBtn.addEventListener('click', function () {
            const cargoTypeId = parseInt(cargoTypeSelect.value);
            let cargoData = {};

            if (cargoTypeId === 0) {
                cargoTypeSelect.classList.add('invalid');
                showErrorAlert(
                    'Pasirinkite krovinio tipą'
                );

                return;
            }

            cargoTypeSelect.classList.remove('invalid');
            const distanceField = document.getElementById('cargo_distance');
            const isDistanceValid = validateField(
                distanceField
            );

            if (!isDistanceValid) {
                showErrorAlert(
                    'Atstumo laukelyje gali būti tik skaičiai.'
                );

                return;
            }

            if (cargoTypeId === 1) {
                clearFormInputs(secondCargoType);
                cargoData = {};

                const carsCountField = document.getElementById('cargo_cars_count');
                const isCarsCountValid = validateField(
                    carsCountField
                );

                if (!isCarsCountValid) {
                    showErrorAlert(
                        'Automobilių kiekio laukelyje gali būt įvedami tik skaičiai'
                    );

                    return;
                }

                if (parseInt(carsCountField.value) > 8) {
                    showErrorAlert(
                        'Automobilių maksimalus leistinas kiekis yra 8'
                    );

                    return;
                }

                cargoData.weight = parseInt(carsCountField.value);
            }
            else if (cargoTypeId === 2) {
                clearFormInputs(firstCargoType);
                cargoData = {};

                const weightField = document.getElementById('cargo_weight');
                const isWeightFieldValid = validateField(
                    weightField
                );

                if (!isWeightFieldValid) {
                    showErrorAlert(
                        'Krovinio svorio laukelyje gali būti tik skaičiai'
                    );

                    return;
                }

                if (parseFloat(weightField.value) < 500) {
                    showErrorAlert(
                        'Minimalus leistinas krovinio svoris yra 500 KG'
                    );

                    return;
                }

                const dangerousField = document.getElementById('cargo_dangerous');

                if (dangerousField.checked) {
                    cargoData.dangerous = true;
                }

                cargoData.weight = parseFloat(weightField.value);
            }

            cargoData.distance = parseFloat(distanceField.value);
            cargoData.cargo_type_id = cargoTypeId;

            fetch(
                window.location.origin + '/api/cargos/new',
                {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(`meta[name="csrf-token"]`).content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify(cargoData)
                }
            )
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`)
                }

                return response.json();
            })
            .then((data) => {
                if (!data.data) {
                    showErrorAlert(
                        'Nepavyko sukurti naujo įrašo.'
                    );

                    return;
                }

                showSuccessAlert(
                    'Įrašas sėkmingai sukūrtas'
                );
            })
        });
    }
});

function validateField(field)
{
    const fieldType = field.type;

    if (!fieldType) {
        return false;
    }

    const fieldValue = field.value;

    if (fieldValue.length === 0) {
        field.classList.add('invalid');

        showErrorAlert(
            'Laukelio reikšmė negali būti tuščia.'
        )

        return;
    }

    field.classList.remove('invalid');

    switch (fieldType) {
        case 'number':
            return parseInt(fieldValue) && /^\d+$/.test(fieldValue);
    }
}

function clearFormInputs(form)
{
    const inputs = form.querySelectorAll('input');

    inputs.forEach((input) => {
        const inputType = input.type;

        switch (inputType) {
            case 'number':
            case 'text':
                input.value = '';
                break;
            case 'checkbox':
                input.checked = false;
                break;
        }
    });

}

function showErrorAlert(message)
{
    Swal.fire({
        icon: 'error',
        title: 'Klaida',
        text: message
    });
}

function showSuccessAlert(message)
{
    Swal.fire({
        icon: 'success',
        title: message,
        showConfirmButton: true
    })
    .then((result) => {
        if (result.isConfirmed) {
            window.location.reload();
        }
    });
}
