
function enregistrerStats( tag, param2='none') {
    
    // Envoyez les données au backend Laravel via une requête AJAX
    $.ajax({
        type: 'GET',
        url: '/api/enregistrer-stats/'+tag+'/'+param2,
        data: { idUser: idUser },
        success: function (response) {
            console.log(response);
            // Traitez la réponse du serveur si nécessaire
        },
        error: function (error) {
            console.error(error);
            // Traitez les erreurs si nécessaire
        }
    });
}
