document.addEventListener('DOMContentLoaded', () => {
    const contentElement = document.querySelector('.content-s');
    const consultaData = JSON.parse(contentElement.getAttribute('data-consultas')); // Converte o JSON
    const searchInput = document.querySelector('#search-input-c');
    const tableBody = document.querySelector('#tbody'); // Corrigido para '.tbody'


    // Função para renderizar as consultas na tabela
    const renderConsultas = (dados) => {

        tableBody.innerHTML = ''; // Limpa a tabela

        dados.forEach(dado => {
            const row = document.createElement('tr');
            row.style.textAlign = 'center';
            row.innerHTML = `
                <td><a href="pacientes/show/${dado.paciente.id}">${dado.paciente.nome+' '+dado.paciente.apelido}</a></td>
                <td>${dado.paciente.genero === 'M' ? 'Masculino' : 'Feminino'}</td>
                <td>${new Date(dado.paciente.data_nascimento).toLocaleDateString('pt-BR')}</td>
                <td>${dado.doencas.map(doenca => doenca.nome).join(', ')}</td>
                <td>${dado.estado || 'Não informado'}</td>
            `;
            tableBody.appendChild(row);
        });
    };

    // Inicializa a tabela com todas as consultas
    renderConsultas(consultaData);

    // Adiciona evento de busca
     searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase(); // Texto da busca
        const filteredConsultas = consultaData.filter(consulta => {
            const nomeCompleto = `${consulta.paciente.nome} ${consulta.paciente.apelido}`.toLowerCase();
            const doencasText = consulta.doencas ? consulta.doencas.map(doenca => doenca.nome.toLowerCase()).join(' ') : '';
            const nascimento = consulta.paciente.data_nascimento ? new Date(consulta.paciente.data_nascimento).toLocaleDateString('pt-BR') : '';

            return (
                nomeCompleto.includes(searchTerm) ||
                doencasText.includes(searchTerm) ||
                nascimento.includes(searchTerm)
            );
        });
        renderConsultas(filteredConsultas); // Atualiza a tabela com os resultados filtrados
    });

    renderConsultas(consultaData); // Inicializa a tabela com todas as consultas

    console.log(consultaData); // Apenas para depuração
});
