document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-input-c");
    const tableBody = document.querySelector(".content-s .results tbody");

    // Obtenha os dados de médicos do atributo data-medicos
    const medicosData = JSON.parse(document.querySelector(".content-s").dataset.medicos);

    // Função para renderizar médicos na tabela
    function renderTable(data) {
        tableBody.innerHTML = ""; // Limpa a tabela antes de adicionar novos dados
        if (data.length === 0) {
            tableBody.innerHTML = `
                <tr style="text-align: center; background-color: #f8d7da; color: #721c24;">
                    <td colspan="2">Nenhum médico encontrado.</td>
                </tr>`;
            return;
        }

        data.forEach((medico) => {
            const row = document.createElement("tr");
            row.style.textAlign = "center";
            row.style.backgroundColor = "white";
            row.innerHTML = `
                <td><a href="#">${medico.nome}</a></td>
                <td>${medico.contacto}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Filtrar médicos com base no input
    function filterMedicos(searchTerm) {
        return medicosData.filter((medico) =>
            medico.nome.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }

    // Evento de pesquisa
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.trim();
        const filteredMedicos = filterMedicos(searchTerm);
        renderTable(filteredMedicos);
    });

    // Renderizar tabela com todos os médicos ao carregar a página
    renderTable(medicosData);
});
