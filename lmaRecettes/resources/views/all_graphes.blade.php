<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

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

        #userAgentChart {
            width: 50%;
        }

    </style>

    <title>Admin</title>

</head>

<body>

    <h2>Le nombre de clique sur chaque ingredient</h2>

    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <h2>Nombre de connexion selon navigateur</h2>

    <div style="width: 80%; margin: auto;">
        <canvas id="userAgentChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infosIngredient = <?php echo json_encode($infosIngredient); ?>;
        var infosUserAgent = <?php echo json_encode($infosUserAgent); ?>;

        // Extraire les noms et les totaux des ingrédients agrégés
        var labelsIngredient = [];
        var dataIngredient = [];
        infosIngredient.forEach(function (info) {
            labelsIngredient.push(info.param2);
            dataIngredient.push(info.totalActions);
        });

        // Utiliser une palette de couleurs prédéfinie
        var backgroundColorsIngredient = [
            'rgba(153, 102, 255, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 165, 0, 1)', 'rgba(255, 0, 255, 1)',
            'rgba(0, 255, 0, 1)', 'rgba(128, 0, 128, 1)', 'rgba(255, 215, 0, 1)', 'rgba(54, 162, 235, 1)',
            'rgba(255, 0, 0, 1)', 'rgba(255, 192, 203, 1)', 'rgba(0, 128, 0, 1)', 'rgba(255, 159, 64, 1)',
            'rgba(255, 69, 0, 1)', 'rgba(70, 130, 180, 1)', 'rgba(0, 255, 255, 1)', 'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 71, 1)', 'rgba(75, 0, 130, 1)', 'rgba(255, 206, 86, 1)', 'rgba(0, 128, 128, 1)'
        ];

        var borderColorsIngredient = backgroundColorsIngredient;

        // Configurer le graphique pour les ingrédients
        var ctxIngredient = document.getElementById('myChart').getContext('2d');
        var myChartIngredient = new Chart(ctxIngredient, {
            type: 'bar',
            data: {
                labels: labelsIngredient,
                datasets: [{
                    label: "",
                    data: dataIngredient,
                    backgroundColor: backgroundColorsIngredient,
                    borderColor: borderColorsIngredient,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Ingrédients',
                            font: { size: 25 },
                            color: 'blue'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de cliques',
                            font: { size: 25 },
                            color: 'red'
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    }
                },

                animation: {
                    onComplete: function (animation) {
                        var ctx = myChartIngredient.ctx;
                        ctx.font = Chart.defaults.global.defaultFontSize + 'px ' + Chart.defaults.global.defaultFontFamily;

                        myChartIngredient.data.datasets.forEach(function (dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var xPos = myChartIngredient.getDatasetMeta(0).data[i].x;
                                var yPos = myChartIngredient.getDatasetMeta(0).data[i].y;
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

        // Extraire les noms et les totaux des actions par user_agent
        var labelsUserAgent = infosUserAgent.map(function (info) {
            return info.user_agent;
        });

        var dataUserAgent = infosUserAgent.map(function (info) {
            return info.totalActions;
        });

        // Utiliser une palette de couleurs prédéfinie
        var backgroundColorsUserAgent = [
            'rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)'
        ];

        // Configurer le graphique en secteurs pour user_agent
        var ctxUserAgent = document.getElementById('userAgentChart').getContext('2d');
        var myChartUserAgent = new Chart(ctxUserAgent, {
            type: 'pie',
            data: {
                labels: labelsUserAgent,
                datasets: [{
                    label: "Connexion par ce navigateur",
                    data: dataUserAgent,
                    backgroundColor: backgroundColorsUserAgent,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => {
                            return value;
                        }
                    }
                }

            }
        });

    </script>

</body>

</html>