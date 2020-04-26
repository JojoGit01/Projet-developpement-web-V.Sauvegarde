// Function Galerie Image //
function imageGalerie(){
    var active = $('#galerie .active');
    var next = (active.next().length > 0)? active.next():$('#galerie img:first');
    active.fadeOut(function(){
        active.removeClass('active');
        next.fadeIn().addClass('active');
    });
}
// setInterval(<function>, <temps en ms>)
setInterval('imageGalerie()', 2500);    