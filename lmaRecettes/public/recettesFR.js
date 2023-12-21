
function changeColor(clickedButton) {
    clickedButton.classList.toggle('clicked');
}
document.addEventListener('DOMContentLoaded', function () {
    const counterElement = document.querySelector('.counter');
    const btnMinus = document.querySelector('.btn-minus');
    const btnPlus = document.querySelector('.btn-plus');
  
    let counterValue = 0;
  
    btnMinus.addEventListener('click', function () {
      counterValue = Math.max(0, counterValue - 1);
      counterElement.textContent = counterValue;
    });
  
    btnPlus.addEventListener('click', function () {
      counterValue += 1;
      counterElement.textContent = counterValue;
    });
  });
  
  // Exemple avec Google Analytics
document.querySelectorAll('.social-icons a').forEach(link => {
  link.addEventListener('click', () => {
    gtag('event', 'click', {
      'event_category': 'social',
      'event_label': link.href
    });
  });
});

// Récupérer tous les éléments de type radio avec le nom "choix"
var radioButtons = document.querySelectorAll('input[name="choix"]');

// Ajouter un écouteur d'événements à chaque bouton radio
radioButtons.forEach(function(button) {
    button.addEventListener('change', function() {
        // Désélectionner tous les autres boutons radio lorsque l'utilisateur en sélectionne un
        genere-button .forEach(function(otherButton) {
            if (otherButton !== button) {
                otherButton.checked = false;
            }
        });
    });
});
