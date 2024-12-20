const lC = document.querySelector('#l-m-c');
const lp = document.querySelector('#l-m-p');
const lo = document.querySelector('#l-m-o');
const btnC = document.querySelector('#btn-l-c');
const btnO = document.querySelector('#btn-l-o');
const btnP = document.querySelector('#btn-l-p');

// Função para esconder os elementos e alterar o texto e ícone do botão
function toggleVisibility(element, button) {
    element.classList.toggle('hidden');

    // Alterar o texto e ícone do botão dependendo do estado do elemento
    const icon = button.querySelector('i'); // Seleciona o ícone dentro do botão
    if (element.classList.contains('hidden')) {
        button.innerHTML = '<i class="fa fa-plus text-primary me-3"></i>Ler mais'; // Ícone de "mais"
    } else {
        button.innerHTML = '<i class="fa fa-minus text-primary me-3"></i>Ler menos'; // Ícone de "menos"
    }
}

btnC.addEventListener('click', (event) => {
    event.preventDefault(); // Previne o comportamento padrão do evento
    toggleVisibility(lC, btnC);
});

btnO.addEventListener('click', (event) => {
    event.preventDefault(); // Previne o comportamento padrão do evento
    toggleVisibility(lo, btnO);
});

btnP.addEventListener('click', (event) => {
    event.preventDefault(); // Previne o comportamento padrão do evento
    toggleVisibility(lp, btnP);
});
