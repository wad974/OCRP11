document.addEventListener('DOMContentLoaded', function () {

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


    /***
     * formulaire
     */


    // Sélectionner le formulaire et le div où le contenu sera affiché
    const form = document.getElementById('ajax-form');
    console.log('form : ' + form);
    const select = document.querySelectorAll('#choix');
    console.log(select);

    const contentDiv = document.getElementById('photo');
    console.log('ID PHOTO : ' + contentDiv);

    // boucle select
    select.forEach(element => {
        
        // Écouter l'événement "change" du <select>
        element.addEventListener('change', function () {
            const url = this.value; // Récupérer l'URL sélectionnée
            console.log('url : ' + url);
            // Vérifier si une option valide a été sélectionnée
            if (url) {
                // Créer une requête AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', url, true); // Requête GET asynchrone
                console.log('xhr : ' + xhr.status);

                // Quand la requête est terminée
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Injecter le contenu dans le div si status 200
                        contentDiv.innerHTML = xhr.responseText;
                    } else {
                        // En cas d'erreur
                        contentDiv.innerHTML = '<p>Erreur lors du chargement : ' + xhr.status + '</p>';
                    }
                };

                // Gérer les erreurs de réseau
                xhr.onerror = function () {
                    contentDiv.innerHTML = '<p>Une erreur de réseau est survenue.</p>';
                };

                // Envoyer la requête
                xhr.send();
            }
        });
    });

});


/***
 * 
 * CARD-PHOTO
 * 
 */


