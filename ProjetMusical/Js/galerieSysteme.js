//===================================================
// Name        : galerieSysteme.js
// Author      : Jonathan
// Version     : Final
// Description : Galerie d'image qui permet de visualiser une image d'un artiste toutes les 10 secondes sur la page principal du client.
//===================================================
function imageGalerie(){
    var active = $('#galerie .active');
    var next = (active.next().length > 0)? active.next():$('#galerie img:first');
    active.fadeOut(function(){
        active.removeClass('active');
        next.fadeIn().addClass('active');
    });
}
// setInterval(<function>, <temps en ms>)
setInterval('imageGalerie()', 10000);    