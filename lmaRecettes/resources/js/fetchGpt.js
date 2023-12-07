

const ingredients = [];
const dotsElement = document.querySelector('#dots');
const loadingContainer = document.querySelector('#loading-container');


// function updateRecipeContent(content) {
//     const recipeElement = document.querySelector('#recipe');
//     recipeElement.textContent = content;
// }



function updateRecipeContent(data) {
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




    } else {
        console.error("Invalid recipe format");
        document.querySelector('#recipe').innerHTML = "Une erreur s'est produite lors du formatage de la recette.";
    }
}



function clearIngredients() {
    // Décoche toutes les cases à cocher
    const checkboxes = document.querySelectorAll('input[name="ingredients"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // Vide la liste d'ingrédients et met à jour l'affichage
    ingredients.length = 0;
    document.querySelector('#recipe').innerHTML = "";
    document.querySelector('#dots').style.display = 'none'; // Cacher les points de suspension
}

function addIngredient(ingredient) {
    const checkbox = ingredient.querySelector('input[name="ingredients"]');
    const ingredientName = checkbox.value;

    if (checkbox.checked) {
        if (!ingredients.includes(ingredientName)) {
            ingredients.push(ingredientName);
        }
    } else {
        const index = ingredients.indexOf(ingredientName);
        if (index !== -1) {
            ingredients.splice(index, 1);
        }
    }

    document.querySelector('#recipe').innerHTML = `${ingredients.join(', ')}`;
}

async function getRecipe() {
    // Afficher le message d'attente sans les points de suspension
    document.querySelector('#recipe').innerHTML = "";
    document.querySelector('#loading-message').textContent = "Vos ingrédients se coupent en quatre pour vous satisfaire";

    const checkedIngredients = document.querySelectorAll('input[name="ingredients"]:checked');
    if (checkedIngredients.length === 0) {
        // Afficher un message demandant de sélectionner des ingrédients
        document.querySelector('#recipe').innerHTML = "Veuillez sélectionner des ingrédients.";
        return;
    }

    for (const ingredient of checkedIngredients) {
        const ingredientName = ingredient.value;
        if (ingredientName) {
            ingredients.push(ingredientName);
        }
    }

    const time = document.querySelector("select[name='time']").value;
    const numberOfPeople = document.querySelector("input[name='numberOfPeople']").value;

    const prompt =
        `Tu dois générer une recette saine et écologique.
        La recette commencera par "Voici une recette saine et écologique".
        Elle inclura les ingrédients suivants: ${ingredients.join(', ')}.
        Elle inclura un temps de préparation d'environ ${time} minutes.
        Elle doit être prévue pour ${numberOfPeople} personnes.
        Tu présenteras la recette sous le format suivant:
        Le Titre de la recette, puis tu sautes une ligne.
        Les Ingrédients sous forme de liste à puces, puis tu sautes une ligne.
        La Préparation, sous forme de liste numérotée.`;

    const url = "https://api.openai.com/v1/engines/text-davinci-003/completions";
    const temperature = 0.7;
    const maxTokens = 650;
    const top_p = 0.9;

    try {
        // Afficher le message d'attente avec les points de suspension
        loadingContainer.style.display = 'flex';
        dotsElement.style.display = 'inline';

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${"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"}`,
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
    }
}