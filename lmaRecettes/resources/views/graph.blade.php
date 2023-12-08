<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Document</title>
</head>

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var ingredients = @json($ingredients);

        // Extraire les noms et les ID des ingrédients
        var labels = ingredients.map(function(ingredient) {
            return ingredient.name;
        });

        var data = ingredients.map(function(ingredient) {
            return ingredient.name; // Remplacez "id" par le nom du champ contenant les données à afficher
        });

        // Configurer le graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Changez le type de graphique en fonction de vos besoins
            data: {
                labels: labels,
                datasets: [{
                    label: "Utilisation des ingrédients",
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


</body>

</html>
