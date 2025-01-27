/**
 * RECUPERE IMAGE URL
 * SLIDE AVEC DEPUIS TABLEAU  
 */
function lightbox(lightboxImage) {
    // Récupérer l'URL de l'image
    let box = document.getElementById('diapo');
    //affiche lightbox
    box.style.display = 'flex';

    let img = box.querySelector('.lightbox__container img'); // Assurez-vous que cet élément existe dans votre HTML
    img.setAttribute('src', lightboxImage.image); // Utiliser l'URL de l'image obtenue

    // div ref & cat
    let ref = box.querySelector('.sous-image .ref');
    let cat = box.querySelector('.sous-image .cat');

    ref.innerHTML= lightboxImage.reference;
    cat.innerHTML= lightboxImage.categorie;

    let boutonClose = document.querySelector('.lightbox__close')
    //console.log(boutonClose);
    boutonClose.addEventListener('click', (event) => {
        box.style.display = 'none';
    });
}

//console.log('Contenu FUNTION')
