/**
 * RECUPERE IMAGE URL
 * SLIDE AVEC DEPUIS TABLEAU  
 */
function lightbox(image_url) {
    // Récupérer l'URL de l'image
    let box = document.getElementById('diapo');
    //affiche lightbox
    box.style.display = 'flex';

    let img = box.querySelector('.lightbox__container img'); // Assurez-vous que cet élément existe dans votre HTML
    img.setAttribute('src', image_url); // Utiliser l'URL de l'image obtenue


    let boutonClose = document.querySelector('.lightbox__close')
    console.log(boutonClose);
    boutonClose.addEventListener('click', (event) => {
        box.style.display = 'none';
    });
}

//console.log('Contenu FUNTION')
