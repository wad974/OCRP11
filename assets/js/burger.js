/***BURGER */

let boutonBurger = document.querySelector('.burger-bouton');
let boutonBurgerClose = document.querySelector('.burger-close');
let menuBurger = document.querySelector('#menu-header')


boutonBurger.addEventListener('click', (Event) => {

    menuBurger.style.display = "flex";
    boutonBurger.style.display = 'none';
    boutonBurgerClose.style.display = "block";

})

if (boutonBurgerClose) {
    boutonBurgerClose.addEventListener('click', () => {
        menuBurger.style.display = "none";
        boutonBurgerClose.style.display = "none";

        boutonBurger.style.display = 'flex';
    })
}
