document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-input-c");
    const tableBody = document.querySelector(".content-s .results tbody");

    // Obtenha os dados de doenças do atributo data-doencas
    const doencasData = JSON.parse(document.querySelector(".content-s").dataset.doencas);

    // Função para renderizar doenças na tabela
    function renderTable(data) {
        tableBody.innerHTML = ""; // Limpa a tabela antes de adicionar novos dados
        if (data.length === 0) {
            tableBody.innerHTML = `
                <tr style="text-align: center; background-color: #f8d7da; color: #721c24;">
                    <td colspan="2">Nenhuma doença encontrada.</td>
                </tr>`;
            return;
        }

        data.forEach((doenca) => {
            const row = document.createElement("tr");
            row.style.textAlign = "center";
            row.innerHTML = `
                <td><a href="doencas/show/${doenca.id}">${doenca.nome}</a></td>
                <td>${doenca.descricao}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Filtrar doenças com base no input
    function filterDoencas(searchTerm) {
        return doencasData.filter((doenca) =>
            doenca.nome.toLowerCase().includes(searchTerm.toLowerCase()) ||
            doenca.descricao.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }

    // Evento de pesquisa
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.trim();
        const filteredDoencas = filterDoencas(searchTerm);
        renderTable(filteredDoencas);
    });

    // Renderizar tabela com todas as doenças ao carregar a página
    renderTable(doencasData);
});
