
<!-- style : bar classique -->

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <title>Admin</title>
</head>

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des ingrédients agrégés
        var labels = [];
        var data = [];
        infos.forEach(function (info) {
            labels.push(info.param2);
            data.push(info.totalActions);
        });

        // Utiliser une palette de couleurs prédéfinie
        var backgroundColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(0, 123, 255, 1)',
            'rgba(255, 0, 0, 1)',
            'rgba(0, 255, 0, 1)',
            'rgba(255, 0, 255, 1)'
        ];

        var borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(0, 123, 255, 1)',
            'rgba(255, 0, 0, 1)',
            'rgba(0, 255, 0, 1)',
            'rgba(255, 0, 255, 1)'
        ];

        // Configurer le graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Utilisation des ingrédients",
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
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

</html> -->




<!-- -------------------------------------------------------------------------------------- -->

<!-- style 2 : chart Line -->

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin</title>
</head>

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des ingrédients agrégés
        var labels = [];
        var data = [];
        infos.forEach(function (info) {
            labels.push(info.param2);
            data.push(info.totalActions);
        });

        // Utiliser une palette de couleurs prédéfinie
        var borderColor = 'rgba(255, 99, 132, 1)';

        // Configurer le graphique en ligne
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',  // Changer le type en 'line' pour un graphique en ligne
            data: {
                labels: labels,
                datasets: [{
                    label: "Utilisation des ingrédients",
                    data: data,
                    borderColor: borderColor,
                    borderWidth: 1,
                    fill: false  // Permet de ne pas remplir la zone sous la ligne
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

</html> -->





<!-- ---------------------------------------------------------------------------------------------- -->

<!-- style : area chart -->

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin</title>
</head>

<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des ingrédients agrégés
        var labels = [];
        var data = [];

        infos.forEach(function (info) {
            labels.push(info.param2);
            data.push(info.totalActions);
        });

        // Utiliser une palette de couleurs prédéfinie
        var backgroundColor = 'rgba(255, 99, 132, 0.2)';
        var borderColor = 'rgba(255, 99, 132, 1)';

        // Configurer le graphique en aire
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',  // Changer le type en 'line' pour un graphique en ligne
            data: {
                labels: labels,
                datasets: [{
                    label: "Utilisation des ingrédients",
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1,
                    fill: true  // Remplir l'aire sous la ligne
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

</html> -->




<!-- ---------------------------------------------------------------------------------------------- -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        h2 {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
            color: blue;
        }

        h2::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #000; /* Couleur du soulignement */
        }

    </style>

    <title>Admin</title>

</head>

<body>

    <h2>Le nombre de clique sur chaque ingredient</h2>

    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

<script>
    // Récupérer les données depuis Laravel
    var infos = <?php echo json_encode($infos); ?>;

    // Extraire les noms et les totaux des ingrédients agrégés
    var labels = [];
    var data = [];
    infos.forEach(function (info) {
        labels.push(info.param2);
        data.push(info.totalActions);
    });

    // Utiliser une palette de couleurs prédéfinie
    var backgroundColors = [
        'rgba(153, 102, 255, 1)',    // Violet doux
        'rgba(255, 99, 132, 1)',     // Rouge vif
        'rgba(255, 165, 0, 1)',      // Orange
        'rgba(255, 0, 255, 1)',      // Magenta 
        'rgba(0, 255, 0, 1)',        // Vert
        'rgba(128, 0, 128, 1)',       // Violet foncé
        'rgba(255, 215, 0, 1)',      // Or
        'rgba(54, 162, 235, 1)',     // Bleu ciel
        'rgba(255, 0, 0, 1)',        // Rouge
        'rgba(255, 192, 203, 1)',    // Rose pâle
        'rgba(0, 128, 0, 1)',        // Vert foncé
        'rgba(255, 159, 64, 1)',     // Orange clair
        'rgba(255, 69, 0, 1)',       // Rouge orangé
        'rgba(70, 130, 180, 1)',     // Bleu acier
        'rgba(0, 255, 255, 1)',      // Cyan
        'rgba(75, 192, 192, 1)',     // Bleu-vert clair
        'rgba(255, 99, 71, 1)',      // Tomate
        'rgba(75, 0, 130, 1)',       // Indigo
        'rgba(255, 206, 86, 1)',     // Jaune doux
        'rgba(0, 128, 128, 1)',      // Sarcelle
    ];

    var borderColors = [
        'rgba(153, 102, 255, 1)',    // Violet doux
        'rgba(255, 99, 132, 1)',     // Rouge vif
        'rgba(255, 165, 0, 1)',      // Orange
        'rgba(255, 0, 255, 1)',      // Magenta 
        'rgba(0, 255, 0, 1)',        // Vert
        'rgba(128, 0, 128, 1)',       // Violet foncé
        'rgba(255, 215, 0, 1)',      // Or
        'rgba(54, 162, 235, 1)',     // Bleu ciel
        'rgba(255, 0, 0, 1)',        // Rouge
        'rgba(255, 192, 203, 1)',    // Rose pâle
        'rgba(0, 128, 0, 1)',        // Vert foncé
        'rgba(255, 159, 64, 1)',     // Orange clair
        'rgba(255, 69, 0, 1)',       // Rouge orangé
        'rgba(70, 130, 180, 1)',     // Bleu acier
        'rgba(0, 255, 255, 1)',      // Cyan
        'rgba(75, 192, 192, 1)',     // Bleu-vert clair
        'rgba(255, 99, 71, 1)',      // Tomate
        'rgba(75, 0, 130, 1)',       // Indigo
        'rgba(255, 206, 86, 1)',     // Jaune doux
        'rgba(0, 128, 128, 1)',      // Sarcelle
    ];

    // Configurer le graphique
    var ctx = document.getElementById('myChart').getContext('2d');
    Chart.defaults.global = {
        defaultFontFamily: 'Arial',
        defaultFontSize: 12,
        defaultFontStyle: 'normal',
        defaultFontColor: 'red'
    };

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: "",
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Ingrédients',
                        font : {size: 25},
                        color: 'blue'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de cliques',
                        font : {size: 25},
                        color: 'red'
                    }
                }
            },

            plugins: {
                legend: {
                    display: false  // Ajoutez cette ligne pour masquer le titre global
                }
            },

            animation: {
                onComplete: function (animation) {
                    var ctx = myChart.ctx;
                    ctx.font = Chart.defaults.global.defaultFontSize + 'px ' + Chart.defaults.global.defaultFontFamily;

                    myChart.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var xPos = myChart.getDatasetMeta(0).data[i].x;
                            var yPos = myChart.getDatasetMeta(0).data[i].y;
                            var label = dataset.data[i];
                            ctx.fillStyle = 'red';
                            ctx.textAlign = 'center';
                            ctx.fillText(label, xPos, yPos - 5);
                        }
                    });
                }
            }
        }
    });
</script>

</body>
</html>
