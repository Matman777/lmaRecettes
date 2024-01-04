<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>


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
                color: black;
            }

            h2::after {
                content: "";
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 100%;
                height: 2px;
                background-color: #000;
                /* Couleur du soulignement */
            }

            .chart-container {
                width: 80%;
                margin: auto;
                margin-bottom: 40px;
            }

            #userAgentChart {
                width: 50%;
            }
        </style>

        <title>Admin</title>
    </head>

    <body>



        <div class="chart-container">
            <h2>Le nombre de clics sur chaque ingrédient</h2>
            <canvas id="ingredientChart"></canvas>
        </div>

        <p>-----------------------------------------------------------------------------------------</p>

        <div class="chart-container">
            <h2>Le nombre de clics sur la page chaque jour</h2>
            <canvas id="dailyChart"></canvas>



        </div>

        <p>-----------------------------------------------------------------------------------------</p>

        <div class="chart-container">
            <h2>Nombre de clics par heure sur la page</h2>
            <canvas id="hourlyChart"></canvas>



        </div>

        <p>-----------------------------------------------------------------------------------------</p>

        <div class="chart-container">
            <h2>Nombre de connexions selon le navigateur</h2>
            <div style="width: 80%; margin: auto;">
                <canvas id="userAgentChart"></canvas>
            </div>



        </div>


        <script>
            // Récupérer les données depuis Laravel

            var ingredientData = <?php echo json_encode(['labels' => $ingredientInfos->pluck('param2'), 'data' => $ingredientInfos->pluck('totalActions')->toArray()]); ?>;

            var dailyData = <?php echo json_encode(['labels' => $dailyInfos->pluck('date_jour'), 'values' => $dailyInfos->pluck('totalActions')->toArray()]); ?>;

            var hourlyData = <?php echo json_encode(['labels' => $hourlyInfos->pluck('date_heure_connexion'), 'data' => $hourlyInfos->pluck('totalActions')->toArray()]); ?>;

            var userAgentData = <?php echo json_encode(['labels' => $userAgentData->pluck('user_agent'), 'data' => $userAgentData->pluck('totalActions')->toArray()]); ?>;


            // Utiliser une palette de couleurs prédéfinie
            var backgroundColors = [
                'rgba(153, 102, 255, 1)', // Violet doux
                'rgba(255, 99, 132, 0.8)', // Rouge vif
                'rgba(255, 165, 0, 0.9)', // Orange
                'rgba(75, 192, 192, 0.8)', // Vert
                'rgba(128, 0, 128, 0.9)', // Violet foncé
                'rgba(255, 215, 0, 0.9)', // Or
                'rgba(54, 162, 235, 0.8)', // Bleu ciel
                'rgba(255, 0, 0, 0.9)', // Rouge
                'rgba(255, 192, 203, 0.9)', // Rose pâle
                'rgba(0, 128, 0, 0.8)', // Vert foncé
                'rgba(255, 159, 64, 0.5)', // Orange clair
                'rgba(255, 69, 0, 1)', // Rouge orangé
                'rgba(153, 102, 255, 0.6)', // Bleu acier
                'rgba(0, 255, 255, 0.9)', // Cyan
                'rgba(255, 99, 71, 0.9)', // Tomate
                'rgba(75, 0, 130, 0.9)', // Indigo
                'rgba(255, 206, 86, 0.9)', // Jaune doux
                'rgba(0, 128, 128, 0.9)', // Sarcelle
                'rgba(255, 0, 255, 0.9)', // Magenta
                'rgba(75, 192, 192, 0.9)' // Bleu-vert clair
            ];

            var borderColors = [
                'rgba(153, 102, 255, 1)', // Violet doux
                'rgba(255, 99, 132, 0.8)', // Rouge vif
                'rgba(255, 165, 0, 0.9)', // Orange
                'rgba(75, 192, 192, 0.8)', // Vert
                'rgba(128, 0, 128, 0.9)', // Violet foncé
                'rgba(255, 215, 0, 0.9)', // Or
                'rgba(54, 162, 235, 0.8)', // Bleu ciel
                'rgba(255, 0, 0, 0.9)', // Rouge
                'rgba(255, 192, 203, 0.9)', // Rose pâle
                'rgba(0, 128, 0, 0.8)', // Vert foncé
                'rgba(255, 159, 64, 0.5)', // Orange clair
                'rgba(255, 69, 0, 1)', // Rouge orangé
                'rgba(153, 102, 255, 0.6)', // Bleu acier
                'rgba(0, 255, 255, 0.9)', // Cyan
                'rgba(255, 99, 71, 0.9)', // Tomate
                'rgba(75, 0, 130, 0.9)', // Indigo
                'rgba(255, 206, 86, 0.9)', // Jaune doux
                'rgba(0, 128, 128, 0.9)', // Sarcelle
                'rgba(255, 0, 255, 0.9)', // Magenta
                'rgba(75, 192, 192, 0.9)' // Bleu-vert clair
            ];


            // Graphique pour le nombre de clics sur chaque ingrédient
            var ingredientCtx = document.getElementById('ingredientChart').getContext('2d');
            var ingredientChart = new Chart(ingredientCtx, {
                type: 'bar',
                data: {
                    labels: ingredientData.labels,
                    datasets: [{
                        label: "",
                        data: ingredientData.data,
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
                                font: {
                                    size: 25
                                },
                                color: 'blue'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de cliques',
                                font: {
                                    size: 25
                                },
                                color: 'red'
                            }
                        }
                    },

                    plugins: {
                        legend: {
                            display: false // Ajoutez cette ligne pour masquer le titre global
                        }
                    }

                }
            });


            // Graphique pour le nombre de clics sur la page chaque jour
            var dailyCtx = document.getElementById('dailyChart').getContext('2d');
            var dailyChart = new Chart(dailyCtx, {
                type: 'line',
                data: {
                    labels: dailyData.labels,
                    datasets: [{
                        label: 'Total Actions',
                        data: dailyData.values,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
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
                                    day: 'd- MMM- yy'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Date du jour de la connexion',
                                font: {
                                    size: 25
                                },
                                color: 'blue'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Nombre de cliques',
                                font: {
                                    size: 25
                                },
                                color: 'red'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Ajoutez cette ligne pour masquer le titre global
                        }
                    },

                    animation: {
                        onComplete: function(animation) {
                            var ctx = dailyChart.ctx;
                            var fontSize = 15;
                            ctx.font = fontSize + 'px Arial';

                            dailyChart.data.datasets.forEach(function(dataset, datasetIndex) {
                                for (var i = 0; i < dailyData.labels.length; i++) {
                                    var xPos = dailyChart.getDatasetMeta(datasetIndex).data[i].x;
                                    var yPos = dailyChart.getDatasetMeta(datasetIndex).data[i].y;

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


            // Graphique pour le nombre de clics par heure sur la page
            var hourlyCtx = document.getElementById('hourlyChart').getContext('2d');
            var hourlyChart = new Chart(hourlyCtx, {
                type: 'line',
                data: {
                    labels: hourlyData.labels,
                    datasets: [{
                        label: "Nombre de clics cette heure sur la page",
                        data: hourlyData.data,
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
                                text: 'Date et heure de la connexion',
                                font: {
                                    size: 25
                                },
                                color: 'blue'
                            },

                            // ticks: {
                            //     maxRotation: 90, // Rotation à 90 degrés (verticale)
                            //     minRotation: 90, // Rotation à 90 degrés (verticale)
                            // }

                        },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                stepSize: 10
                            },
                            title: {
                                display: true,
                                text: 'Nombre de cliques',
                                font: {
                                    size: 25
                                },
                                color: 'red'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });


            // Graphique pour le nombre de connexions par navigation
            var userAgentCtx = document.getElementById('userAgentChart').getContext('2d');
            var userAgentChart = new Chart(userAgentCtx, {
                type: 'pie',
                data: {
                    labels: userAgentData.labels,
                    datasets: [{
                        label: "Connexion par ce navigateur",
                        data: userAgentData.data,
                        backgroundColor: backgroundColors,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        datalabels: {
                            color: 'borderColors',
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
