document.addEventListener('DOMContentLoaded', () => {
    const contentElement = document.querySelector('.content-s');
    const agendaData = JSON.parse(contentElement.getAttribute('data-agendas')); // Converte o JSON
    const searchInput = document.querySelector('#search-input-c');
    const tableBody = document.querySelector('#tbody'); // Corrigido para '#tbody'

    // Função para renderizar as agendas na tabela
    const renderAgendas = (dados) => {
        tableBody.innerHTML = ''; // Limpa a tabela

        dados.forEach(dado => {
            const row = document.createElement('tr');
            row.style.textAlign = 'center';
            row.innerHTML = `
                <td><a href="pacientes/show/${dado.paciente.id}">${dado.paciente}</a></td>
                <td>${dado.paciente.email || 'Não informado'}</td>
                <td>${dado.paciente.contacto || 'Não informado'}</td>
                <td>${dado.medico ? dado.medico.nome : 'Não informado'}</td>
                <td>${dado.data ? new Date(dado.data).toLocaleDateString('pt-BR') : 'Não informado'}</td>
                <td>${dado.estado || 'Não informado'}</td>
            `;
            tableBody.appendChild(row);
        });
    };

    // Inicializa a tabela com todas as agendas
    renderAgendas(agendaData);

    // Adiciona evento de busca
    searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase(); // Texto da busca
        const filteredAgendas = agendaData.filter(agenda => {
            const nomeCompleto = `${agenda.paciente} ${agenda.paciente}`.toLowerCase();
            const email = agenda.paciente.email ? agenda.paciente.email.toLowerCase() : '';
            const contacto = agenda.paciente.contacto ? agenda.paciente.contacto.toLowerCase() : '';
            const medico = agenda.medico ? agenda.medico.nome.toLowerCase() : '';

            return (
                nomeCompleto.includes(searchTerm) ||
                email.includes(searchTerm) ||
                contacto.includes(searchTerm) ||
                medico.includes(searchTerm)
            );
        });

        renderAgendas(filteredAgendas); // Atualiza a tabela com os resultados filtrados
    });

    console.log(agendaData); // Apenas para depuração
});
