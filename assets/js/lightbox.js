/***lightbox SANS FILTRE PAGE ACCUEIL */
/***lightbox */
(function ($) {
    $(document).ready(function () {
        let box = document.getElementById('diapo');

        // Chargement de l'image en Ajax
        $('.js-load-lightbox').submit(function (e) {
            // Empêcher l'envoi classique du formulaire
            e.preventDefault();

            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
            const ajaxurl = $(this).attr('action');

            // Les données de notre formulaire
            const data = {
                action: $(this).find('input[name=action]').val(),
                nonce: $(this).find('input[name=nonce]').val(),
                postid: $(this).find('input[name=postid]').val(),
                reference: $(this).find('input[name=reference]').val(),
                category: $(this).find('input[name=category]').val(),
            }

            // Pour vérifier qu'on a bien récupéré les données
            //console.log(ajaxurl);
            //console.log(data);

            // Requête Ajax pour obtenir l'URL de l'image
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Cache-Control': 'no-cache',
                },
                body: new URLSearchParams(data),
            })
                .then(response => response.json())
                .then(body => {
                    //console.log(body);

                    // En cas d'erreur
                    if (!body.success) {
                        alert(body.data); // Affiche l'erreur reçue du serveur
                        return;
                    }

                    // on stock body et image_url de php dans une variable
                    //console.log(body)
                    //console.log('IMAGE : ' + body.data.image_url.image)
                    let lightboxImage = body.data.image_url
                    console.log( 'console lightbox', lightboxImage)

                    lightbox(lightboxImage)
                    // recup diapo
                    diapo()

                })
                .catch(error => console.error('Error loading image:', error));
        });
    });
})(jQuery);


/**
 * 
 * FUNCTION DIAPORAMA
 */

function diapo() {
    //index du tableau slides lors des boules pour stock 
    //le nombre de passage hors de la boucle
    let tab = 0;
    //lien image réel pour completer celui du tableau slides
    //let src = './assets/images/slideshow/';

    // bouton fleche 
    let arrow_left = document.querySelector("#diapo .conteneur .bottom .arrow_left");
    let arrow_right = document.querySelector("#diapo .conteneur .bottom .arrow_right");
    let image = document.querySelector('#diapo .conteneur .bottom .banner-img');
    let banner = document.querySelector('#diapo');

    // div ref & cat
    let ref = document.querySelector('.sous-image .ref');
    let cat = document.querySelector('.sous-image .cat');

    /*point dots
    let dots = document.querySelector("#diapo .dots");
    //tableau pour stocker tous les dot initialisé
    let myDot = [];*/


    // boucle pour initialisé les dot sur la page HTML dans div.dots
    // avec creation createElement() d'un div dot 
    // + ajout class classList.add() dans dot
    /* a la fin on ajoute l'enfant dans la div.dots parent avec appenChild()
    for (let i = 0; i < slides.length; i++) {
    
        // je creer un div 
        let dot = document.createElement('div');
    
        //je creer une class dans cette div
        dot.classList.add('dot');
        //et j'ajoute cette class dans la div dots appeler si haut
        dots.appendChild(dot);
    
        // on affiche dot-select sur le premier slide 
        if (i === tab) dot.classList.add('dot_selected');
    
        myDot.push(dot);
        //console.log(myDot);
    
        //pour le coté finition quand on survol clic bulle
        dot.style.cursor = 'pointer';
    
    }
    
    // on mets un pointer sur les fleches
    arrow_left.style.cursor = "pointer";
    arrow_right.style.cursor = "pointer";*/


    // clic gauche
    arrow_left.addEventListener('click', fleche_gauche);
    // clic droit
    arrow_right.addEventListener('click', fleche_droite);

    /* une boucle pour recuperer l'index du tableau myDot et afficher selon l'index
    for (let index = 0; index < myDot.length; index++) {
        //console.log(index)
    
        myDot[index].addEventListener('click', function () {
            //console.log('click');
            //on recup image tagline dans tableau slides
            affiche_image(index);
            //on fais une mise a jours de la dot 
            //en supprimant tous et afficher uniquement celui selectionner
            //update_dot(index)
        });
    }*/

    // function affiche image
    function affiche_image(tab) {
        // on change l'atribut image et on modifie le titre
        image.setAttribute('src', slides[tab].image);
        ref.innerHTML = slides[tab].reference;
        cat.innerHTML = slides[tab].categorie;
        //image.setAttribute('alt', slides[tab].tagLine);
        //titre.innerHTML = slides[tab].tagLine;
        return;
    }

    /* function update_dot()
    function update_dot(tab) {
        // on afficher dot selected
    
        for (let index = 0; index < myDot.length; index++) {
            //console.log(myDot[i])
            myDot[index].classList.remove('dot_selected')
        }
        // on ajoute au numeros de tab le dot_selected
        myDot[tab].classList.add('dot_selected')
    }*/

    // function fleche droite
    function fleche_droite() {
        // on parcours le tableau slides
        for (let i = 0; i < slides.length; i++) {
            console.log(slides[i].image);
            // on incremente tab
            tab++ // tab =  + 1 a chaque passage
            // pour evitez l'erreur d'index 
            if (tab < 0 || tab >= slides.length) {
                // à la fin du tableau on remet tab a 0
                tab = 0;
                // on change l'atribut image et on modifie le titre
                affiche_image(tab);
                //update_dot
                //update_dot(tab);
                break;

            } else {
                // on change l'atribut image et on modifie le titre
                affiche_image(tab);

                //update_dot
                //update_dot(tab);
                // on bloque l'execution 
                break;
            }
        }
    }

    //function fleche gauche
    function fleche_gauche() {

        // on parcours le tableau slides
        for (let i = 0; i < slides.length; i++) {
            /*console.log(slides[i].tagLine);
            console.log(image.alt);
            console.log(i)*/
            // pour evitez l'erreur d'index 
            if (tab <= 0) {
                // a la fin du tableau on enleve 4-1 
                tab = slides.length - 1;
                affiche_image(tab);
                //update_dot
                //update_dot(tab);
                return;
            }

            if (tab != 0) {

                // on incremente tab
                tab-- // tab =  + 1 a chaque passage

                // on change l'atribut image et on modifie le titre
                affiche_image(tab);
                //update_dot
                //update_dot(tab);
                // on bloque l'execution 
                break;

            }
        }

    }
}

diapo()