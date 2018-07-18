const $ = require('jquery');
global.$ = global.jQuery = $;

require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();

    //On place le JS général ici, lancer la commande
    //yarn run encore dev : pour compiler les fichiers de ressources du dossier assets vers build
    //ou
    //yarn run encore dev --watch : pareil mais compile automatiquement à chaque modif de fichier

    $("h1").click(function(){
        alert("The paragraph was clicked.");
    });


});