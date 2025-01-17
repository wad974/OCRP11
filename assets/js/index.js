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
    //console.log(allBouton);
    //console.log(divContact);

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
     * ARTICLES
     */


    // Sélectionner le formulaire et le div où le contenu sera affiché
    const form = document.getElementById('ajax-form');
    const select = document.querySelectorAll('#choix');

    const contentDiv = document.getElementById('photo');

    // boucle select
    select.forEach(element => {
        console.log('filtres: ', element)
        element.addEventListener('focus', () => {
            const defaultOption = element.querySelector('option[value = ""]');
            if (defaultOption) {
                defaultOption.style.display = 'none'
                //defaultOption.classList.add('hidden');
                // Appliquer la classe pour cacher le texte
            }
        });
        element.addEventListener('blur', () => {
            const defaultOption = element.querySelector('option[value = ""]');
            if (defaultOption && select.value === "") {
                defaultOption.style.display = 'block'
                //defaultOption.classList.remove('hidden');
            }
        });


        // Écouter l'événement "change" du <select>
        element.addEventListener('change', function () {

            const url = this.value; // Récupérer l'URL sélectionnée
            if(url === '#'){
                url= ''
            }
            // Vérifier si une option valide a été sélectionnée
            if (url) {
                // Créer une requête AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', url, true); // Requête GET asynchrone

                // Quand la requête est terminée
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Injecter le contenu dans le div si status 200
                        contentDiv.innerHTML = xhr.responseText;

                        /*FILTRE PAGE APRES CHARGEMENT*/
                        console.log('CHARGER ! ARCHIVE')

                        let box = document.querySelector('#diapo');
                        let forms = document.querySelectorAll('.js-load-lightbox');

                        forms.forEach(bouton => {
                            bouton.addEventListener('click', function (event) {
                                event.preventDefault();

                                console.log('form : ', bouton)

                                const ajaxUrl = bouton.getAttribute('action');

                                const data = {
                                    action: bouton.querySelector('input[name=action]').value,
                                    nonce: bouton.querySelector('input[name=nonce]').value,
                                    postid: bouton.querySelector('input[name=postid]').value,
                                }

                                // Pour vérifier qu'on a bien récupéré les données
                                console.log(ajaxUrl);
                                console.log(data);

                                // Requête Ajax pour obtenir l'URL de l'image
                                fetch(ajaxUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'Cache-Control': 'no-cache',
                                    },
                                    body: new URLSearchParams(data),
                                })
                                    .then(response => response.json())
                                    .then(body => {
                                        console.log(body);

                                        // En cas d'erreur
                                        if (!body.success) {
                                            alert(body.data); // Affiche l'erreur reçue du serveur
                                            return;
                                        }

                                        // Utilisez les données renvoyées par le serveur ici
                                        // Afficher la lightbox

                                        // Récupérer l'URL de l'image
                                        lightbox(body.data.image_url)
                                        // recup diapo
                                        diapo()
                                    })
                                    .catch(error => console.error('Error with the request:', error));

                            });
                        });



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

    /***
     * 
     * ALBUM PHOTO BOUTON CHARGER BAS PAGE ACCUEIL
     * 
     */
    // Sélectionner le bouton et le div où le contenu sera affiché

    const boutonCharger = document.querySelector('.bouton');

    // boucle select
    if (boutonCharger) {


        boutonCharger.addEventListener('click', function (event) {
            //on stop la navigation
            event.preventDefault();

            const url = this.href; // Récupérer l'URL sélectionnée
            // Vérifier si une option valide a été sélectionnée
            if (url) {
                // Créer une requête AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('GET', url, true); // Requête GET asynchrone

                // Quand la requête est terminée
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Injecter le contenu dans le div si status 200
                        contentDiv.innerHTML = xhr.responseText;

                        /**ON CONTINUES AVEC LES BOUTON */

                        console.log('CHARGER ! PAGE HOME')

                        let box = document.querySelector('#diapo');
                        let forms = document.querySelectorAll('.js-load-lightbox');

                        forms.forEach(bouton => {
                            bouton.addEventListener('click', function (event) {
                                event.preventDefault();

                                console.log('form : ', bouton)

                                const ajaxUrl = bouton.getAttribute('action');

                                const data = {
                                    action: bouton.querySelector('input[name=action]').value,
                                    nonce: bouton.querySelector('input[name=nonce]').value,
                                    postid: bouton.querySelector('input[name=postid]').value,
                                }

                                // Pour vérifier qu'on a bien récupéré les données
                                console.log(ajaxUrl);
                                console.log(data);

                                // Requête Ajax pour obtenir l'URL de l'image
                                fetch(ajaxUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'Cache-Control': 'no-cache',
                                    },
                                    body: new URLSearchParams(data),
                                })
                                    .then(response => response.json())
                                    .then(body => {
                                        console.log(body);

                                        // En cas d'erreur
                                        if (!body.success) {
                                            alert(body.data); // Affiche l'erreur reçue du serveur
                                            return;
                                        }

                                        console.log('CHARGER PLUS')


                                        // Utilisez les données renvoyées par le serveur ici
                                        // Afficher la lightbox

                                        // Récupérer l'URL de l'image
                                        lightbox(body.data.image_url)
                                        // recup diapo
                                        diapo()

                                    })
                                    .catch(error => console.error('Error with the request:', error));

                            });
                        });

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
    }
});




