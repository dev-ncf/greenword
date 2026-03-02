const btnSearch = document.getElementById('pesquisar')
const btnPesquisar = document.getElementById('btn-pesquisar')
const btnFiltrar = document.getElementById('btn-filtrar')
const cardFiltrar = document.querySelector('.content-f')
const cardPesquisar = document.querySelector('.content-s')
const modalSearch = document.querySelector('.search-modal')
const modalSearchMain = document.querySelector('.modal-main')
const modalSearchCloseBtn = document.querySelector('#close')

btnSearch.addEventListener('click', () => {
    modalSearch.classList.remove('close')

})
modalSearchCloseBtn.addEventListener('click', () => {
    modalSearch.classList.add('close')

})
btnPesquisar.addEventListener('click', () => {
    btnPesquisar.classList.add('active')
    btnFiltrar.classList.remove('active')
    cardFiltrar.style.display='none'
    cardPesquisar.style.display='flex'
})
btnFiltrar.addEventListener('click', () => {
    btnFiltrar.classList.add('active')
    btnPesquisar.classList.remove('active')
    cardFiltrar.style.display='flex'
    cardPesquisar.style.display='none'
})
 modalSearch.addEventListener('click', (event) => {

     if (!modalSearchMain.contains(event.target)) {

        modalSearch.classList.add('close')
    }
  });
