var photo = document.getElementById('photo');
var affichephoto = document.getElementById('affichephoto');

photo.onchange = function()
{
    var file = document.querySelector('input[type=file]').files[0].name;
    affichephoto.src = 'assets/img/photo/' + file;
}

