document.addEventListener('DOMContentLoaded', () => {
    const contentElement = document.querySelector('#content-s-user');
    const usuariosData = JSON.parse(contentElement.getAttribute('data-usuarios')); // Converte o JSON
    const searchInput = document.querySelector('#input-user');
    const tableBody = document.querySelector('#table-body-user');

    // Função para renderizar os usuarios na tabela
    const renderusuarios = (usuarios) => {
        tableBody.innerHTML = ''; // Limpa a tabela
        usuarios.forEach(usuario => {
            const row = document.createElement('tr');
            row.style.textAlign = 'center';
            row.innerHTML = `
                <td><a href="usuarios/show/${usuario.id}">${usuario.name} </a></td>
                <td> <a href="usuarios/show/${usuario.id}">${usuario.email}</a></td>
                <td> <a href="usuarios/show/${usuario.id}">${usuario.nivel}</a></td>

            `;
            tableBody.appendChild(row);
        });
    };

    // Inicializa a tabela com todos os usuarios
    renderusuarios(usuariosData);

    // Adiciona evento de busca
    searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase(); // Texto da busca
        const filteredusuarios = usuariosData.filter(usuario => {
            const nomeCompleto = `${usuario.name}`.toLowerCase();

            return (
                nomeCompleto.includes(searchTerm) ||
                usuario.email.includes(searchTerm)
            );
        });
        renderusuarios(filteredusuarios); // Atualiza a tabela com os resultados
    });

    console.log(usuariosData)
});
