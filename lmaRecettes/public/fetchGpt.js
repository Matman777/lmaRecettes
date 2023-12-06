require('dotenv').config();
const apiKey = process.env.API_KEY;


// const ingredients = [];
// const dotsElement = document.querySelector('#dots');
// const loadingContainer = document.querySelector('#loading-container');

// function updateRecipeContent(content) {
//     console.log("Raw Content:", content);

//     const recipeElement = document.querySelector('#recipe');

//     const titleMatches = content.match(/Voici une recette saine et écologique : ([\s\S]*?)Ingrédients:/);
//     const recipeTitle = titleMatches ? titleMatches[1] : "Titre non trouvé";

//     const ingredientsList = content.match(/Ingrédients:([\s\S]*?)Préparation:/);
//     const ingredients = ingredientsList ? ingredientsList[1].split('\n').map(ingredient => ingredient.trim()) : [];

//     const preparationList = content.match(/Préparation:([\s\S]*)/);
//     const preparationSteps = preparationList ? preparationList[1].split(/\d+\./).map(step => step.trim()).filter(Boolean) : [];


//     console.log("Title:", titleMatches);
//     console.log("Ingredients:", ingredientsList);
//     console.log("Preparation:", preparationList);
    
//     const htmlSections = `
//         <p>${recipeTitle}</p>
//         ${ingredients.length > 0 ? `<p>Ingrédients :</p><ul>${ingredients.map((ingredient, index) => `<li key=${index}>${ingredient}</li>`).join('')}</ul>` : ''}
//         <p>Préparation :</p>
//         ${preparationSteps.length > 0 ? `<ol>${preparationSteps.map((step, index) => `<li key=${index}>${step}</li>`).join('')}</ol>` : ''}
//     `;

//     recipeElement.innerHTML = htmlSections;
// }

// function clearIngredients() {
//     // Décoche toutes les cases à cocher
//     const checkboxes = document.querySelectorAll('input[name="ingredients"]');
//     checkboxes.forEach(checkbox => {
//         checkbox.checked = false;
//     });

//     // Vide la liste d'ingrédients et met à jour l'affichage
//     ingredients.length = 0;
//     document.querySelector('#recipe').innerHTML = "";
//     document.querySelector('#dots').style.display = 'none'; // Cacher les points de suspension
// }

// function addIngredient(ingredient) {
//     const checkbox = ingredient.querySelector('input[name="ingredients"]');
//     const ingredientName = checkbox.value;

//     if (checkbox.checked) {
//         if (!ingredients.includes(ingredientName)) {
//             ingredients.push(ingredientName);
//         }
//     } else {
//         const index = ingredients.indexOf(ingredientName);
//         if (index !== -1) {
//             ingredients.splice(index, 1);
//         }
//     }

//     document.querySelector('#recipe').innerHTML = `${ingredients.join(', ')}`;
// }

// async function getRecipe() {
//     // Afficher le message d'attente sans les points de suspension
//     document.querySelector('#recipe').innerHTML = "";
//     document.querySelector('#loading-message').textContent = "Vos ingrédients se coupent en quatre pour vous satisfaire";

//     const checkedIngredients = document.querySelectorAll('input[name="ingredients"]:checked');
//     if (checkedIngredients.length === 0) {
//         // Afficher un message demandant de sélectionner des ingrédients
//         document.querySelector('#recipe').innerHTML = "Veuillez sélectionner des ingrédients.";
//         return;
//     }

//     for (const ingredient of checkedIngredients) {
//         const ingredientName = ingredient.value;
//         if (ingredientName) {
//             ingredients.push(ingredientName);
//         }
//     }

//     const time = document.querySelector("select[name='time']").value;
//     const numberOfPeople = document.querySelector("input[name='numberOfPeople']").value;

//     const prompt =
//         `Tu dois générer une recette saine et écologique.
//         La recette commencera par "Voici une recette saine et écologique".
//         Elle inclura les ingrédients suivants: ${ingredients.join(', ')}.
//         Elle inclura un temps de préparation d'environ ${time} minutes.
//         Elle doit être prévue pour ${numberOfPeople} personnes.`;

//     const url = "https://api.openai.com/v1/engines/text-davinci-003/completions";
//     const temperature = 0.7;
//     const maxTokens = 650;
//     const top_p = 0.9;

//     try {
//         // Afficher le message d'attente avec les points de suspension
//         loadingContainer.style.display = 'flex';
//         dotsElement.style.display = 'inline';

//         const response = await fetch(url, {
//             method: "POST",
//             headers: {
//                 "Authorization": `Bearer ${"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"}`,
//                 "Content-Type": "application/json"
//             },
//             body: JSON.stringify({
//                 prompt: prompt,
//                 temperature: temperature,
//                 max_tokens: maxTokens,
//                 top_p: top_p
//             })
//         });

//         if (!response.ok) {
//             throw new Error(`HTTP error! Status: ${response.status}`);
//         }

//         const data = await response.json();

//         if (!data.choices || !data.choices[0]) {
//             console.error("Invalid response from OpenAI API");
//             return;
//         }

//         // Formater et mettre à jour la div avec la recette
//         updateRecipeContent(data.choices[0].text);

//     } catch (error) {
//         console.error("Error:", error);
//         // En cas d'erreur, afficher un message d'erreur
//         document.querySelector('#recipe').innerHTML = "Une erreur s'est produite. Veuillez réessayer plus tard.";
//     } finally {
//         // Cacher les points de suspension après la réponse
//         loadingContainer.style.display = 'none';
//         dotsElement.style.display = 'none';
//     }
// }
























const ingredients = [];
const dotsElement = document.querySelector('#dots');
const loadingContainer = document.querySelector('#loading-container');


function updateRecipeContent(content) {
    const recipeElement = document.querySelector('#recipe');
    recipeElement.textContent = content;
}


// function updateRecipeContent(content) {
//   const recipeElement = document.querySelector('#recipe');

//   // Split the content into lines
//   const lines = content.split('\n');

//   // Initialize variables to store title, ingredients, and preparation steps
//   let title = '';
//   let ingredients = [];
//   let preparationSteps = [];

//   // Process each line to extract title, ingredients, and preparation steps
//   for (const line of lines) {
//     if (line.startsWith('Voici une recette saine et écologique :')) {
//       title = line.substring(36).trim(); // Extract the title after the prefix
//     } else if (line.startsWith('Ingrédients:')) {
//       ingredients = lines.slice(lines.indexOf(line) + 1, lines.indexOf('Préparation:')).map(ingredient => ingredient.trim()); // Extract ingredients
//     } else if (line.startsWith('Préparation:')) {
//       preparationSteps = lines.slice(lines.indexOf(line) + 1).map(step => step.trim()); // Extract preparation steps
//     }
//   }

//   // Format the title, ingredients, and preparation steps as HTML elements
//   const formattedTitle = `<h2>${title}</h2>`;
//   const formattedIngredients = ingredients.length > 0 ? `<h3>Ingrédients</h3><ul>${ingredients.map(ingredient => `<li>${ingredient}</li>`).join('')}</ul>` : '';
//   const formattedPreparationSteps = preparationSteps.length > 0 ? `<h3>Préparation</h3><ol>${preparationSteps.map(step => `<li>${step}</li>`).join('')}</ol>` : '';

//   // Append the title, ingredients, and preparation steps to the recipeElement's innerHTML
//   recipeElement.innerHTML += formattedTitle;
//   recipeElement.innerHTML += formattedIngredients;
//   recipeElement.innerHTML += formattedPreparationSteps;
// }

  
  

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
        Elle doit être prévue pour ${numberOfPeople} personnes.`;

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
                "Authorization": `Bearer ${process.env.API_KEY}`,
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
        console.log(prompt);

        if (!data.choices || !data.choices[0]) {
            console.error("Invalid response from OpenAI API");
            return;
        }

      

        // Formater et mettre à jour la div avec la recette
        updateRecipeContent(data.choices[0].text);

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