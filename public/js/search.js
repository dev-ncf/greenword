document.addEventListener('DOMContentLoaded', () => {
    const contentElement = document.querySelector('.content-s');
    const pacientesData = JSON.parse(contentElement.getAttribute('data-pacientes')); // Converte o JSON
    const searchInput = document.querySelector('.search .input');
    const tableBody = document.querySelector('.table-body');

    // Função para renderizar os pacientes na tabela
    const renderPacientes = (pacientes) => {
        tableBody.innerHTML = ''; // Limpa a tabela
        pacientes.forEach(paciente => {
            const row = document.createElement('tr');
            row.style.textAlign = 'center';
            row.innerHTML = `
                <td><a href="pacientes/show/${paciente.id}">${paciente.nome} ${paciente.apelido}</a></td>
                <td> <a href="pacientes/show/${paciente.id}">${paciente.genero === 'M' ? 'Masculino' : 'Feminino'}</a></td>
                <td> <a href="pacientes/show/${paciente.id}">${paciente.contacto}</a></td>
                <td> <a href="pacientes/show/${paciente.id}">${paciente.doencas.map(doenca => doenca.nome).join(', ')}</a></td>
                <td> <a href="pacientes/show/${paciente.id}">${new Date(paciente.data_nascimento).toLocaleDateString('pt-BR')}</a></td>
            `;
            tableBody.appendChild(row);
        });
    };

    // Inicializa a tabela com todos os pacientes
    renderPacientes(pacientesData);

    // Adiciona evento de busca
    searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase(); // Texto da busca
        const filteredPacientes = pacientesData.filter(paciente => {
            const nomeCompleto = `${paciente.nome} ${paciente.apelido}`.toLowerCase();
            const doencasText = paciente.doencas.map(doenca => doenca.nome.toLowerCase()).join(' ');
            return (
                nomeCompleto.includes(searchTerm) ||
                paciente.contacto.includes(searchTerm) ||
                doencasText.includes(searchTerm)
            );
        });
        renderPacientes(filteredPacientes); // Atualiza a tabela com os resultados
    });

    console.log(pacientesData)
});
