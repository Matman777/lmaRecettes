const ingredients = [];

        function addIngredient(ingredient) {

            const ingredientName = ingredient.querySelector('input[name="ingredients"]').value;


            if (ingredientName) {
                ingredients.push(ingredientName);
            }


            document.querySelector('#recipe').innerHTML = `${ingredients.join(', ')}`;
        }

        function getRecipe() {

            const checkedIngredients = document.querySelectorAll('input[name="ingredients"]:checked');

            for (const ingredient of checkedIngredients) {
                const ingredientName = ingredient.value;

                if (ingredientName) {
                    ingredients.push(ingredientName);
                }
            }


            const time = document.querySelector("select[name='time']").value;


            const numberOfPeople = document.querySelector("input[name='numberOfPeople']").value;

            const prompt =
                `Tu dois générer 5 recettes saine et écologique.
                La recette commencera par "Voici une recette saine et écologique".
                Elle inclueras les ingrédients suivants: ${ingredients.join(', ')}.
                Elle inclueras un temps de préparation d'environ ${time} minutes.
                Elle doit être prévue pour ${numberOfPeople} personnes.`;


            const url = "https://api.openai.com/v1/engines/text-davinci-003/completions";

            const temperature = 0.7;
            const maxTokens = 650;
            const top_p = 0.9;


            fetch(url, {
                    method: "POST",
                    headers: {
                        "Authorization": `Bearer ${"YOUR_API_KEY"}`,
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        prompt: prompt,
                        temperature: temperature,
                        max_tokens: maxTokens,
                        top_p: top_p
                    })
                })
                .then((response) => response.json())
                .then((data) => {

                    if (!data.choices || !data.choices[0]) {
                        console.error("Invalid response from OpenAI API");
                        return;
                    }


                    document.querySelector('#recipe').innerHTML = data.choices[0].text;
                })
                .catch((error) => {
                    console.error(error);
                });
        }