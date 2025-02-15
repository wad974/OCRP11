/***FILTRES CATEGORIE  */


let activeFilters = {
    categorie: '',
    format: '',
    trierPar: '',
};



let selectBouton = document.querySelectorAll('.select-titre');
let selectOption = document.querySelectorAll('.select-option');
let selectOptionAll = document.querySelectorAll('.option');

selectBouton.forEach((select, index) => {

    select.addEventListener('click', function () {

        selectOption.forEach((option, i) => {
            if (i !== index) {
                option.style.display = 'none';
                selectBouton[i].classList.remove('selected');
                selectBouton[i].innerHTML = selectBouton[i].textContent;
            }
        });
        const isVisible = selectOption[index].style.display === 'block';
        selectOption[index].style.display = isVisible ? 'none' : 'block';


        if (selectOption[index].style.display === 'block') {
            select.classList.add('selected');

        } else {
            select.classList.remove('selected');
        }

    });
});


selectOptionAll.forEach((element) => {
    element.addEventListener('click', function (event) {

        let selectedButton = document.querySelectorAll('.select-titre');
        //console.log(selectedButton)

        /*selectedButton.innerHTML = element.textContent;

        let optionContainer = selectedButton.nextElementSibling;
        optionContainer.style.display = 'none';
        selectedButton.classList.remove('selected');*/

        let valeur = element.getAttribute('data-value');
        const contentDiv = document.getElementById('photo');

        // Identifier quel filtre a été modifié
        selectedButton.forEach((button) => {
            // Vérifier si le bouton cliqué correspond au bouton actuel
            if (button.classList.contains('selected')) {
                if (button.textContent.trim() === 'Catégories') {
                    activeFilters.categorie = valeur;
                } else if (button.textContent.trim() === 'FORMAT') {
                    activeFilters.format = valeur;
                } else if (button.textContent.trim() === 'Trier par') {
                    activeFilters.trierPar = valeur;
                }
            }
        });

        //console.log(valeur)
        //console.log(activeFilters)

        // Appliquer les filtres
        filterSlides();


    });
});

/**TABLEAU FILTRES SLIDES */
function filterSlides() {
    const contentDiv = document.getElementById('photo');
    //contentDiv.innerHTML = ''; // Effacer le contenu précédent

    // Filtrer les slides selon les filtres actifs
    let filteredSlides = slides.filter((slide) => {
        let categorieMatch = activeFilters.categorie ? slide.categorie === activeFilters.categorie : true;
        let formatMatch = activeFilters.format ? slide.format === activeFilters.format : true; // Supposons que le "format" soit inclus dans `reference`
        return categorieMatch && formatMatch;
    });

    // Trier les résultats si un tri est actif
    /*if (activeFilters.trierPar) {
        if (activeFilters.trierPar === '1') {
            // Trier par les plus récentes (dans cet exemple, on suppose que les images les plus récentes sont à la fin)
            //filteredSlides = filteredSlides.reverse();
            activeFilters.trierPar = 'asc';
        } else if (activeFilters.trierPar === '2') {
            // Trier par les plus anciennes (ordre par défaut)
            activeFilters.trierPar = 'desc';
        } else {
            activeFilters.trierPar = 'desc';

        }
    }*/

    // Afficher les images filtrées
    filteredSlides.forEach((slide) => {
        //console.log(slide);
        // Créer une nouvelle requête AJAX
        const xhr = new XMLHttpRequest();
        //console.log(xhr)
        // Ouvrir la requête avec le fichier cible (test-view.php)
        xhr.open('GET', `/tous-les-photos?categorie=${activeFilters.categorie}&format=${activeFilters.format}&trierPar=${activeFilters.trierPar}`, true);
        //console.log(xhr)

        // Gérer la réponse de la requête
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Ajouter la réponse (HTML généré) au conteneur
                contentDiv.innerHTML = '';
                contentDiv.innerHTML += xhr.responseText; // Ajouter sans écraser les autres

                /**LIGHTBOX APRES FILTRES PAGE ACCUEIL*/
                let box = document.querySelector('#diapo');
                let forms = document.querySelectorAll('.js-load-lightbox');

                forms.forEach(bouton => {
                    bouton.addEventListener('click', function (event) {
                        event.preventDefault();

                        //console.log('form : ', bouton)

                        const ajaxUrl = bouton.getAttribute('action');

                        const data = {
                            action: bouton.querySelector('input[name=action]').value,
                            nonce: bouton.querySelector('input[name=nonce]').value,
                            postid: bouton.querySelector('input[name=postid]').value,
                            reference: bouton.querySelector('input[name=reference]').value,
                            category: bouton.querySelector('input[name=category]').value,
                        }

                        // Pour vérifier qu'on a bien récupéré les données
                        //console.log('ajax - bouton :', +ajaxUrl);
                        //console.log('data - form: ', +data);

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
                                //console.log(body);

                                // En cas d'erreur
                                if (!body.success) {
                                    alert(body.data); // Affiche l'erreur reçue du serveur
                                    return;
                                }

                                console.log('FILTRES PLUS LIGHTBOX')


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
                console.error('Erreur lors de la requête AJAX :', xhr.statusText);
            }
        };

        xhr.onerror = function () {
            console.error('Erreur lors du chargement des données AJAX.');
        };

        // Envoyer la requête
        xhr.send();

    });

    // Si aucun résultat, afficher un message
    if (filteredSlides.length === 0) {
        contentDiv.innerHTML = '<p>Aucun résultat trouvé.</p>';
    }
}
