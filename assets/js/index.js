/*PAGE MODALE CONTACT*/
/**on recupere id contact */
let divContact = document.getElementById('contact');
//display none
divContact.style.display = "none";

// on recupere aussi le bouton qui est le même que divContact
let boutonClose = document.querySelector('#contact');

// on recupere le lien ou bouton contact pour appeler divContact
let allBouton = document.querySelectorAll('.sous-menu-link');

// petite boucle for pour recupérer uniquement contact
console.log(allBouton);
console.log(divContact);

function pageContact(event) {
    //stop la propagation
    event.stopPropagation();
    //stop la page de recharger
    event.preventDefault();

    // event target provient du parent uniquement

    // conditions si display == none
    if (divContact.style.display === "none") {

        //alors on affiche block
        divContact.style.display = "block";
    }
}

//bouton contact dans nav
for (let index = 0; index < allBouton.length; index++) {

    //on parcours la boucle pour trouver #contact dans menu
    let contact = allBouton[index].attributes['href'].value;

    if (contact === '#contact') {
        // si #contact trouver on addeventlisterner le bouton

        allBouton[index].addEventListener('click', pageContact);
    }
}
//bouton contact dans single.php
let boutonContactPageSingle = document.querySelector('.boutonContactPageSingle');

if (boutonContactPageSingle) {
    //on verife que le bouton est vrai
    boutonContactPageSingle.addEventListener('click', pageContact);

}

//bouton pour fermer le modale
divContact.addEventListener('click', function (event) {
    //stop la propagation
    //event.stopPropagation();
    //event.preventDefault();

    // on intéragit uniquement sur le parent avec event.target
    if (event.target === divContact) {
        if (divContact.style.display === "block") {
            divContact.style.display = "none";
        }
    }
});
