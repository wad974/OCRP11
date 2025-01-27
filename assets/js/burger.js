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

/** PAGINATION HOVER PHOTO */
let img_prev = document.querySelector('.img_prev');
let img_next = document.querySelector('.img_next');
let prev = document.querySelector('.prev');
let next = document.querySelector('.next');

img_next.style.display = 'none';

prev.addEventListener('mouseover', function () {
    img_next.style.display = 'none';
    img_prev.style.display = 'block';
    img_prev.style.opacity = '1';
    // on réinitialise la couleur après quelques instants
    setTimeout(function () {
        img_prev.style.opacity = '0';
    }, 2000);
})

next.addEventListener('mouseover', function () {
    img_prev.style.display = 'none';
    img_next.style.display = 'block';
    img_next.style.opacity = '1';

    // on réinitialise la couleur après quelques instants
    setTimeout(function () {
        img_next.style.opacity = '0';
    }, 2000);


})