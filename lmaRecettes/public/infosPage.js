
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


///COOKIES

document.addEventListener('DOMContentLoaded', function() {

    var cookieMessage = document.getElementById('cookie-message');

    var acceptCookiesButton = document.getElementById('accept-cookies');
    
    //var refuseCookiesButton = document.getElementById('refuse-cookies');

    document.body.style.overflow = 'hidden';

    localStorage.setItem('cookies_accepted', 'false');

    var cookiesAccepted = localStorage.getItem('cookies_accepted');

    // Afficher le message uniquement si les cookies n'ont pas été acceptés
    if (!cookiesAccepted) {
        
        document.body.style.display = 'none';

        cookieMessage.style.display = 'flex';
    }

    acceptCookiesButton.addEventListener('click', function() {

        localStorage.setItem('cookies_accepted', 'true');
        cookieMessage.style.display = 'none';

        document.body.style.overflow = 'block';

        // Vous pouvez également rediriger l'utilisateur vers la page principale ici
    });
});
