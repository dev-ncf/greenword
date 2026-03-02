document.addEventListener('DOMContentLoaded', () => {
    const contentElement = document.querySelector('#filtro-pacientes');
    let pacientesData;

    // Verifica se os dados estão disponíveis no atributo data-pacientes
    try {
        pacientesData = JSON.parse(contentElement.getAttribute('data-pacientes'));
        console.log("Dados carregados:", pacientesData); // Verifica se os dados foram carregados
    } catch (error) {
        console.error("Erro ao carregar os dados:", error);
        return;
    }

    const filterDoenca = document.querySelector('#filter-doenca');
    const filterGenero = document.querySelector('#filter-genero');
    const tableBody = document.querySelector('.table-body');

    // Renderiza pacientes na tabela
    const renderPacientes = (pacientes) => {
        console.log("Renderizando pacientes:", pacientes); // Log para verificar os pacientes renderizados
        tableBody.innerHTML = ''; // Limpa os dados anteriores
        if (pacientes.length === 0) {
            tableBody.innerHTML = '<tr><td colspan="5">Nenhum paciente encontrado.</td></tr>';
            return;
        }
        pacientes.forEach(paciente => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${paciente.nome} ${paciente.apelido || ''}</td>
                <td>${paciente.genero === 'M' ? 'Masculino' : 'Feminino'}</td>
                <td>${paciente.contacto || 'Não informado'}</td>
                <td>${paciente.doencas.map(doenca => doenca.nome).join(', ')}</td>
                <td>${new Date(paciente.data_nascimento).toLocaleDateString('pt-BR')}</td>
            `;
            tableBody.appendChild(row);
        });
    };

    // Inicializa com todos os pacientes
    renderPacientes(pacientesData);

    // Filtros
    const filterPacientes = () => {
        const selectedDoenca = filterDoenca.value;
        const selectedGenero = filterGenero.value;

        console.log("Filtro selecionado - Doença:", selectedDoenca, "Gênero:", selectedGenero);

        const filteredPacientes = pacientesData.filter(paciente => {
            const matchDoenca = !selectedDoenca || paciente.doencas.some(doenca => doenca.nome === selectedDoenca);
            const matchGenero = !selectedGenero || paciente.genero === selectedGenero;

            return matchDoenca && matchGenero;
        });

        renderPacientes(filteredPacientes);
    };

    // Eventos de filtro
    filterDoenca.addEventListener('change', filterPacientes);
    filterGenero.addEventListener('change', filterPacientes);
});
