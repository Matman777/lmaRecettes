// Déclaration des variables globales
const ingredients = [];
const loadingContainer = document.querySelector('#loading-container');
const dotsElement = document.querySelector('#dots');

const recipeImages = [
    'cuisto1Modif2.png',
    'cuisto3Modif.png',
    'cuisto4Modif.png',
];


// Fonction pour choisir une image au hasard
function getRandomImage() {
    const randomIndex = Math.floor(Math.random() * recipeImages.length);
    return recipeImages[randomIndex];
}


// Fonction pour mettre à jour l'image lors de la génération de la recette
function updateRecipeImage() {
    const imageUrl = getRandomImage();
    const imageContainer = document.getElementById('recipe-image');
    imageContainer.innerHTML = `<img src="${imageUrl}" alt="Image de la recette" style="width:100%;">`;
}




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
        ingredients.splice(index, 1);
        updateRecipeDisplay(); // Mettre à jour la liste des ingrédients

        // Trouver le bouton correspondant et retirer la classe 'clicked'
        document.querySelectorAll('.custom-button').forEach(button => {
            if (button.textContent.trim() === ingredientName) {
                button.classList.remove('clicked');
            }
        });
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





// Traitement de la réponse de l'API
async function updateRecipeContent(data) {
    console.log(data);
    const recipe = data.choices[0].text;
    console.log('Full Recipe:', recipe);

    // Séparer la recette en sections (titre, ingrédients, préparation)
    const sections = recipe.split('\n\n');
    console.log('Sections:', sections);

    if (sections.length >= 4) {
        const title = sections[1].trim();
        const ingredients = sections[2].split('\n').map(ingredient => ingredient.trim());
        const preparationSection = sections.slice(3).join('\n\n'); // Combinez les sections restantes pour la préparation

        const preparationSteps = preparationSection.split('\n').map(step => step.trim());

        // Supprimer le numéro ajouté automatiquement
        const formattedPreparationSteps = preparationSteps.map(step => {
            const match = step.match(/^\d+\.\s(.*)/); // Vérifier s'il y a un numéro au début de l'étape
            return match ? match[1] : step;
        });

        const formattedRecipe = `
    <h2>${title}</h2>
    <div class="ingredients">
        <h3>Ingrédients :</h3>
        <ul>
            ${ingredients.slice(1).map(ingredient => `<li>${ingredient}</li>`).join('')}
        </ul>
    </div>
    <div class="preparation">
        <h3>Préparation :</h3>
        <ol>
            ${formattedPreparationSteps.slice(1).map(step => `<li>${step.replace(/^\d+\.\s*/, '')}</li>`).join('')}
        </ol>
    </div>
`;


document.querySelector('#recipe').innerHTML = formattedRecipe;
document.querySelector('#recipe').style.display = 'block'; // Afficher la div de la recette
document.querySelector('#recipe-image').style.display = 'block'; // Afficher l'image de la recette


    } else {
        console.error("Invalid recipe format");
        document.querySelector('#recipe').innerHTML = "Une erreur s'est produite lors du formatage de la recette.";
    }

    // Afficher la div de la recette
    document.querySelector('#recipe').style.display = 'block';
    
    updateRecipeImage();
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
        `Tu dois générer une recette.
        La recette commencera par "Voici votre recette", avec le nom de la recette juste en dessous.
        Elle inclura les ingrédients suivants: ${ingredients.join(', ')}.
        Elle inclura un temps de préparation d'environ ${time} minutes.
        Elle doit être prévue pour ${numberOfPeople} personnes.
        Tu présenteras la recette sous le format suivant:
        Le Titre de la recette, puis tu sautes une ligne.
        Les Ingrédients sous forme de liste, puis tu sautes une ligne.
        La Préparation, sous forme de liste numérotée.
        Si l'un des ingrédients renseignés n'est en réalité pas un produit alimentaire 
        (par exemple: de la mort aux rats, de l'eau de javel ou encore un chat), 
        n'en prends pas compte et fais la recette en omettant tout élément illicite`;

    const url = "https://api.openai.com/v1/engines/text-davinci-003/completions";
    const temperature = 0.7;
    const maxTokens = 650;
    const top_p = 0.9;

    console.log("Envoi de l'invite à l'API:", prompt);

    
    try {
        // Afficher le message d'attente avec les points de suspension
        loadingContainer.style.display = 'flex';
        dotsElement.style.display = 'inline';
        document.getElementById('loading-screen').style.display = 'flex';

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${""}`,
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
        updateRecipeContent(data);

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
    updateRecipeImage();
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