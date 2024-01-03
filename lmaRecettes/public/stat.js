
// Déclarer la variable pour stocker le temps de départ
var startTime; 
    
var leaveTime;

window.addEventListener('load', function() {
    // Logique supplémentaire à exécuter lors du chargement de la page, si nécessaire
    startTime = new Date();

    console.log(startTime);
});

// Écouter l'événement beforeunload
window.addEventListener('beforeunload', function() {
    // Enregistrer le temps actuel dans la variable
    leaveTime = new Date();

    console.log(leaveTime);
});


function logElapsedTime() {
    
    if(leaveTime) {
        var elapsedTime = (leaveTime - startTime) / 1000; // en secondes

        console.log("Temps passé sur la page : " + elapsedTime + " secondes");
    } else {
        console.log("La page est toujours ouverte.");
    }
    
}

// Afficher le temps chaque seconde
setInterval(logElapsedTime, 1000);

//---------------------------------------------------------------------------/////////

// calculer le temps de loading


/*
var startTime;

// Enregistrez le moment du chargement de la page
window.addEventListener("load", function() {
    startTime = new Date();
});

// Enregistrez le moment où l'utilisateur quitte la page (par exemple, en cliquant sur un lien)
window.addEventListener("beforeunload", function() {
    var endTime = new Date();
    var timeSpentOnPage = endTime - startTime;

    // Convertissez le temps en secondes et imprimez-le dans la console
    console.log("Temps passé sur la page : " + (timeSpentOnPage / 1000) + " secondes");
});
*/


// Afficher le temps chaque seconde
//setInterval(logElapsedTime, 1000);


/*
// Ajouter le temps 
function addTimeOnPage() {

    document.querySelector('#stat').innerHTML = `${tempsPasseSurPage.join(', ')}`;
}
*/

//var startTime = new Date();

/*
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
*/


/*
function logElapsedTime() {
    var currentTime = new Date();
    var elapsedTime = (currentTime - startTime) / 1000; // en secondes

    // Envoi du temps passé au serveur par le biais d'une requête AJAX
    $.ajax({
        type: 'GET',
        url: '/tests', // Utilisez l'URL appropriée de votre route Laravel
        data: {
            elapsedTime: elapsedTime
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error) {
            console.error(error);
        }
    });

}

// Appeler logElapsedTime au moment approprié, par exemple, avant de quitter la page
window.addEventListener('beforeunload', logElapsedTime);
*/




//var  apiUrl = 'http://192.168.1.36:8000/api/events/';
//php artisan serve --host=192.168.1.36 --port=8000


/*
var  apiUrl = 'http://127.0.0.1:8000/';

            
function recordEvent( tag )
{
    // Make a GET request using fetch
    fetch(apiUrl + tag )
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }                    
        return response.json();
    })
    .then(data => {
        console.log("OK >", data);
    })
    .catch(error => {
        console.log("KO >", error);
    });
}
*/


/*
var leaveTime; // Déclarer la variable pour stocker le temps de départ

// Écouter l'événement beforeunload
window.addEventListener('beforeunload', function() {
    // Enregistrer le temps actuel dans la variable
    leaveTime = Date.now();

    // Vous pouvez également stocker leaveTime dans un cookie, localStorage, sessionStorage ou l'envoyer au serveur
});
*/