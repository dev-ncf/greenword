
const sideMenu = document.querySelector('aside')
const menuBtn = document.querySelector('#menu_bar')
const closeBtn = document.querySelector('#close_btn')
const profileFoto = document.querySelector('#profile-foto')
 const infor = document.querySelector('#inform')

const themeToggler = document.querySelector('.theme-toggler')

menuBtn.addEventListener('click', () => {
    sideMenu.style.display='block'
})
closeBtn.addEventListener('click', () => {
    sideMenu.style.display='none'
})

themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables')
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active')
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')
})
profileFoto.addEventListener('click', () => {
   
   
    if (infor.getAttribute('status') == 'closed') {
        
        infor.style.display = 'flex'
        infor.setAttribute('status','opened')
    } else {
        infor.setAttribute('status','closed')
        infor.style.display='none'
        
    }
})
document.addEventListener('click', function (event) {
     
    const isClickInside = infor.contains(event.target);
    if (!profileFoto.contains(event.target)) {
        if (!isClickInside) {
                infor.setAttribute('status', 'closed');
                infor.style.display = 'none';
            }
    }

            // Se o clique for fora da div, fechar a div
            
        });