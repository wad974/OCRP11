(function ($) {
    $(document).ready(function () {
        let box = document.querySelector('#photo');

        // Chargement des commentaires en Ajax
        $('.js-load-comments').submit(function (e) {
            // Empêcher l'envoi classique du formulaire
            e.preventDefault();

            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
            const ajaxurl = $(this).attr('action');

            // Les données de notre formulaire
            const data = {
                action: $(this).find('input[name=action]').val(),
                nonce: $(this).find('input[name=nonce]').val(),
                postid: $(this).find('input[name=postid]').val(),
            }

            // Pour vérifier qu'on a bien récupéré les données
            //console.log(ajaxurl);
            //console.log(data);

            // Requête Ajax en JS natif via Fetch
            fetch(ajaxurl, {
                method: 'post',
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

                    // Requête AJAX pour charger la page d'archive
                    fetch(body.data.archiveUrl) // Utilisez l'URL de la page d'archive
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.text();
                        })
                        .then(html => {

                            console.log('NO WAY')
                            box.innerHTML = html; // Injecter le contenu dans le div
                            // Si vous avez des scripts spécifiques à recharger après l'injection, faites-le ici
                        })
                        .catch(error => console.error('Error loading archive:', error));
                });
        });
    });
})(jQuery);

/******* */

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


