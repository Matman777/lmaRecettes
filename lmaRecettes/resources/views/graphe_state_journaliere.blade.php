

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>

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

    <h2>Le nombre de clique sur la page chaque jour</h2>

    <div style="width: 80%; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        
        // Récupérer les données depuis le contrôleur
        var data = <?php echo json_encode($infos); ?>;

        // Préparer les données pour le graphique
        var labels = data.map(function(item) {
            return item.date_jour;
        });

        var values = data.map(function(item) {
            return item.totalActions;
        });

        // Dessiner le graphique
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Actions',
                    data: values,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'd MMM'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Date du jour',
                            font: {size: 25},
                            color: 'blue'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total cliques',
                            font: {size: 25},
                            color: 'red'
                        }
                    }
                },

                plugins: {
                    legend: {
                        display: false  // Ajoutez cette ligne pour masquer le titre global
                    },

                    annotation: {
                        annotations: [{
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y',
                            value: 0,
                            borderColor: 'transparent',
                            borderWidth: 0,
                            label: {
                                enabled: true,
                                content: '0',
                                position: 'right'
                            }
                        }]
                    }
                },

                animation: {
                    onComplete: function(animation) {
                        var ctx = myChart.ctx;
                        var fontSize = 15; // ajustez la taille de police selon vos préférences
                        ctx.font = fontSize + 'px Arial';

                        myChart.data.datasets.forEach(function(dataset, datasetIndex) {
                            for (var i = 0; i < labels.length; i++) {
                                var xPos = myChart.getDatasetMeta(datasetIndex).data[i].x;
                                var yPos = myChart.getDatasetMeta(datasetIndex).data[i].y;

                                // Utilisez dataset.data[i] s'il est défini, sinon affichez 0
                                var label = dataset.data[i] !== undefined ? dataset.data[i] : 0;

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

    <p>

        1- Analyse des Tendances Hebdomadaires : Le graphe par jour permet d'analyser les tendances hebdomadaires en termes de fréquentation du site. Cela peut être utile pour planifier des promotions, des mises à jour de contenu ou d'autres événements en fonction des jours de la semaine où l'activité est la plus élevée. <br><br>

        2- Planification de Contenu : En comprenant quels jours de la semaine voient le plus d'activité, vous pouvez planifier la publication de contenu important pour maximiser son impact. Par exemple, réservez les nouvelles recettes ou les articles phares pour les jours où la fréquentation est historiquement élevée. <br><br>

        3- Optimisation des Campagnes Marketing : Si vous exécutez des campagnes marketing spécifiques à certains jours de la semaine, le graphe peut aider à évaluer l'efficacité de ces campagnes en observant les variations du trafic pendant et après les campagnes. <br><br>

        4- Gestion des Stocks et Approvisionnements : Si votre site est lié à une entreprise de restauration ou de commerce électronique, les données par jour peuvent aider à optimiser la gestion des stocks en fonction de la demande quotidienne. <br><br>

        5- Adaptation des Ressources Serveur : Si vous observez des pics d'activité à certains moments de la semaine, vous pouvez ajuster la capacité du serveur pour répondre à ces pics et garantir une performance optimale. <br><br>

        6- Identification des Événements ou Tendances Particulières : Des variations inhabituelles dans le nombre de clics peuvent indiquer des événements spéciaux, des campagnes virales, ou des tendances particulières qui méritent une attention particulière. <br><br>

        7- Planification des Opérations et du Personnel : Les données par jour peuvent aider à planifier les opérations et le personnel en fonction des fluctuations de la demande tout au long de la semaine. <br><br>

    </p>

</body>

</html>