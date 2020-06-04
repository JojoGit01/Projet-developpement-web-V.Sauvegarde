//===================================================
// Name        : sonBoom.js
// Author      : Jonathan
// Version     : Final
// Description : Code qui affiche une fléche sur la chanson en cours de lecture.
//===================================================
window.onload = () => {    
    activeBoom();
}
const activeBoom = () => {
    let titleSon = document.getElementById('titleAuteur').textContent;
    let sonAlbum = document.querySelector('.albumSonGetting').querySelectorAll('.aside-son li');

    sonAlbum.forEach( (elm) => {
        elm.textContent.match(titleSon) ? elm.setAttribute("class", "active") : elm.removeAttribute("class");
    } );
}