export class DataTable {
    constructor(tableID, csrfToken) {
        this.table = document.getElementById(tableID);
        this.csrfToken = csrfToken;
        this.data = [];
        this.filteredData = [];

        this.cargoTypeFilterSelect = document.getElementById('cargo_type');
        this.cargoTypeFilterSelect.addEventListener('change', this.handleCargoTypeFilterChange.bind(this));
    }

    fetchData(url, method, data = null) {
        let args = {
            headers: {
                'X-CSRF-TOKEN': this.csrfToken,
                'Content-type': 'application/json',
                'Accept': 'application/json',
            },
            method: method,
        }

        if (data !== null) {
            args.body = JSON.stringify(data);
        }

        fetch(url, args)
            .then((response) => response.json())
            .then((data) => {
                this.setData(data);
            })
            .catch((error) => {
                console.error(`Error fetching data: ${error.stack}`);
            });
    }

    setData(data) {
        this.data = data;
        this.filteredData = data.data;
        this.render();
    }

    render() {
        this.renderTableBody();
    }

    renderTableBody() {
        const tableBody = this.table.querySelector('tbody');
        tableBody.innerHTML = '';

        if (this.filteredData.length === 0) {
            const noRowsRow = document.createElement('tr');
            const noRowsCell = document.createElement('td');
            noRowsCell.setAttribute('colspan', '7');
            noRowsCell.style.textAlign = 'center';
            noRowsCell.textContent = 'Įrašų nėra';
            noRowsRow.appendChild(noRowsCell);
            tableBody.appendChild(noRowsRow);

            return;
        }

        for (let i = 0; i < this.filteredData.length; i++) {
            const rowData = this.filteredData[i];
            const row = document.createElement('tr');
            this.buildCells(rowData, row);
            tableBody.appendChild(row);
        }
    }

    buildCells(data, row) {
        Object.keys(data).forEach((key) => {
            if (key === 'dangerous') {
                return;
            }
            let cell = document.createElement('td');
            cell.innerText = data[key];
            row.appendChild(cell);
        });
    }

    handleCargoTypeFilterChange() {
        const cargoTypeId = parseInt(this.cargoTypeFilterSelect.value);

        if (cargoTypeId === 0 || cargoTypeId === undefined || cargoTypeId === null) {
            this.fetchData(
                window.location.origin + '/api/cargos',
                'GET',
                null
            )

            return;
        }

        this.fetchData(
            window.location.origin + '/api/cargos?cargo_type_id=' + cargoTypeId ,
            'GET',
            null
        );
    }
}
