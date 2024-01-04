// Déclaration des variables globales
const ingredients = [];
const loadingContainer = document.querySelector('#loading-container');
const dotsElement = document.querySelector('#dots');
let apiKey = "";

fetch('/api-key')
    .then(response => response.json())
    .then(data => {
        apiKey = data.api_Key; // Stocker la clé API dans la variable globale
    })
    .catch(error => console.error('Erreur lors de la récupération de la clé API:', error));



// Fonction pour changer la couleur des boutons au clic et gérer les ingrédients
function changeColor(clickedButton) {
    clickedButton.classList.toggle('clicked');
    const ingredientName = clickedButton.textContent.trim();

    if (clickedButton.classList.contains('clicked')) {
        addIngredient(ingredientName);
    } else {
        removeIngredient(ingredientName);
    }
}



function addIngredient(ingredientName) {
    // Convertir le premier caractère en majuscule et le reste en minuscules
    const formattedIngredientName = ingredientName.charAt(0).toUpperCase() + ingredientName.slice(1).toLowerCase();


    enregistrerStats('AI', ingredientName);

    if (!ingredients.includes(formattedIngredientName)) {
        ingredients.push(formattedIngredientName);
        console.log(ingredients);
    }
    updateRecipeDisplay();
}



// Retirer un ingrédient de la liste
function removeIngredient(ingredientName) {
    const index = ingredients.indexOf(ingredientName);
    if (index !== -1) {
        // Trouver le bouton correspondant et retirer la classe 'clicked' avant de modifier la liste
        document.querySelectorAll('.custom-button').forEach(button => {
            if (button.textContent.trim() === ingredientName) {
                button.classList.remove('clicked');
            }
        });

        ingredients.splice(index, 1); // Mettre à jour la liste des ingrédients
        updateRecipeDisplay(); // Mettre à jour l'affichage
    }
}





function updateRecipeDisplay() {
    const selectedIngredientsElement = document.querySelector('#selected-ingredients');
    let ingredientsHtml = ingredients.map(ingredient =>
        `<span class="ingredient-item">${ingredient} <button class="delete-button" onclick="removeIngredient('${ingredient}')">X</button></span>`
    ).join(' ');
    selectedIngredientsElement.innerHTML = ingredientsHtml;

    if (ingredients.length > 0) {
        document.querySelector('#selected-ingredients').style.display = 'block';
    } else {
        document.querySelector('#selected-ingredients').style.display = 'none';
        document.querySelector('#recipe').style.display = 'none'; // Masquer la div de la recette
        document.querySelector('#recipe-image').style.display = 'none'; // Masquer l'image de la recette si nécessaire
    }
}


// Traitement de la réponse de l'Api avec gpt-3.5-turbo-instruct
function updateRecipeContent(data) {
    try {

        // Nettoyer la réponse JSON (enlever les virgules supplémentaires)
        const cleanedJSON = data.text.replace(/,(\s*[\]}])/g, "$1");
        // Convertir la réponse JSON en objet JavaScript
        const recipeData = JSON.parse(data.text);

        // Extraire les données
        const title = recipeData.titre;
        const ingredients = recipeData.ingredients;
        const preparationSteps = recipeData.preparation.map(step => step.replace(/^\d+\.\s*/, ''));
        const prepTime = recipeData.tempsPreparation;
        const servings = recipeData.nombrePersonnes;

        // Formatage de la sortie HTML
        let formattedRecipe = `<h2>${title}</h2>\n`;
        formattedRecipe += "<div class='ingredients'>\n<h3>Ingrédients :</h3>\n<ul>\n";
        ingredients.forEach(ingredient => {
            formattedRecipe += `<li>${ingredient}</li>\n`;
        });
        formattedRecipe += "</ul>\n</div>\n";
        formattedRecipe += "<div class='preparation'>\n<h3>Préparation :</h3>\n<ol>\n";
        preparationSteps.forEach(step => {
            formattedRecipe += `<li>${step}</li>\n`;
        });
        formattedRecipe += "</ol>\n</div>\n";

        // Ajouter les informations supplémentaires
        formattedRecipe += `<p>Temps de préparation : ${prepTime}</p>\n`;
        formattedRecipe += `<p>Recette pour ${servings} personnes</p>`;

        // Affichage dans l'élément HTML approprié
        document.querySelector('#recipe').innerHTML = formattedRecipe;
        document.querySelector('#recipe').style.display = 'block';
    } catch (error) {
        console.error("Error parsing JSON:", error);
        document.querySelector('#recipe').innerHTML = "Une erreur s'est produite lors du formatage de la recette.";
    }
}





// Obtenir une recette de l'API OpenAI
async function getRecipe() {

    // Afficher le message d'attente sans les points de suspension
    document.querySelector('#recipe').innerHTML = "";
    document.querySelector('#loading-message').textContent = "Vos ingrédients se coupent en quatre pour vous satisfaire";

    // Vérifier si des ingrédients ont été sélectionnés
    if (ingredients.length === 0) {
        // Afficher un message demandant de sélectionner des ingrédients
        document.querySelector('#recipe').innerHTML = "Veuillez sélectionner des ingrédients.";
        return;
    }


    // Ajouter l'ingrédient de l'input si présent
    const newIngredientInput = document.querySelector('#newIngredient');
    const newIngredient = newIngredientInput.value.trim();
    if (newIngredient !== '' && !ingredients.includes(newIngredient)) {
        ingredients.push(newIngredient);
    }

    const time = document.querySelector("select[name='time']").value;
    const numberOfPeople = document.querySelector("input[name='numberOfPeople']").value;

    const prompt =
        `Tu dois générer une recette en format JSON.
        La recette inclura les informations suivantes dans un format structuré : 
        - Le titre de la recette.
        - La liste des ingrédient. Pour chaque ingrédient, indique la quantité nécessaire pour réaliser la recette.
        - N'accepte pas d'ingrédients non alimentaire.
        - Les étapes de préparation.
        - Le temps de préparation approximatif.
        - Le nombre de personnes pour lesquelles la recette est prévue.
        Inclure les ingrédients suivants: ${ingredients.join(', ')}.
        Temps de préparation estimé: ${time} minutes.
        Prévue pour ${numberOfPeople} personnes.
        Format JSON attendu:
        {
        "titre": "Nom de la recette",
        "ingredients": ["X Ingrédient 1", "X Ingrédient 2", ...],
        "preparation": ["Étape 1", "Étape 2", ...],
        "tempsPreparation": "XX minutes",
        "nombrePersonnes": X
        }`;


    const url = "https://api.openai.com/v1/engines/gpt-3.5-turbo-instruct/completions";
    const temperature = 0.7;
    const maxTokens = 650;
    const top_p = 0.9;

    // console.log("Envoi de l'invite à l'API:", prompt);

    
    try {
        // Afficher le message d'attente avec les points de suspension
        loadingContainer.style.display = 'flex';
        dotsElement.style.display = 'inline';
        document.getElementById('loading-screen').style.display = 'flex';


        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${apiKey}`,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                prompt: prompt,
                temperature: temperature,
                max_tokens: maxTokens,
                top_p: top_p
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Réponse du serveur:', data);
        

        if (!data.choices || !data.choices[0]) {
            console.error("Invalid response from OpenAI API");
            return;
        }

      
        // Formater et mettre à jour la div avec la recette
        updateRecipeContent(data.choices[0]);

    } catch (error) {
        console.error("Error:", error);
        // En cas d'erreur, afficher un message d'erreur
        document.querySelector('#recipe').innerHTML = "Une erreur s'est produite. Veuillez réessayer plus tard.";
    } finally {
        // Cacher les points de suspension après la réponse
        loadingContainer.style.display = 'none';
        dotsElement.style.display = 'none';
        document.getElementById('loading-screen').style.display = 'none';
    }
    
}



// Initialisation au chargement du document
document.addEventListener('DOMContentLoaded', function () {
    // Ajout des écouteurs d'événements aux boutons d'ingrédients
    document.querySelectorAll('.custom-button').forEach(button => {
        button.addEventListener('click', () => changeColor(button));
    });

    const recipeButton = document.querySelector('.genere-button');
    if (recipeButton) {
        recipeButton.addEventListener('click', getRecipe);
    }

    // Ajouter un écouteur d'événements au bouton "Ajouter"
    const addButton = document.querySelector('.ajouter-button');
    if (addButton) {
        addButton.addEventListener('click', function() {
            const newIngredientInput = document.querySelector('.text-box');
            const newIngredient = newIngredientInput.value.trim();
            if (newIngredient !== '') {
                addIngredient(newIngredient); // Utilisez votre fonction existante pour ajouter un ingrédient
                newIngredientInput.value = ''; // Réinitialisez l'input
            }
        });
    }
});