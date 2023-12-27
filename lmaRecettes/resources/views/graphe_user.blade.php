
<!-- style 1 : bar classique-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-rotation"></script>
    <script src="chemin/vers/node_modules/chartjs-plugin-rotation/dist/chartjs-plugin-rotation.min.js"></script>


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

    <h2>Nombre de clique par heure sur la page</h2>

    <div style="width: 80%; margin: auto;">
        <canvas id="userActionsChart"></canvas>
    </div>

    <script>



        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos->toArray()); ?>;

        // Extraire les noms et les totaux des actions par utilisateur
        var labels = infos.map(function (info) {
            return info.date_heure_connexion;
        });

        var data = infos.map(function (info) {
            return info.totalActions;
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
        var ctx = document.getElementById('userActionsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Nombre de cliques cette heure sur la page",
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
                            text: 'La date et lheure de la connexion',
                            font: { size: 25 },
                            color: 'blue'
                        },

                        ticks: {
                            maxRotation: 90, // Rotation à 90 degrés (verticale)
                            minRotation: 90, // Rotation à 90 degrés (verticale)
                        }

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
                            font: { size: 25 },
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

    </script>


<p>

1- Identification des Périodes d'Activité : Le graphe par heure permet d'identifier les périodes de la journée où l'activité sur le site est la plus élevée. Cela peut être utile pour planifier des mises à jour de contenu, des promotions spéciales ou d'autres activités promotionnelles pendant les heures de pointe. <br><br>

2- Optimisation de la Planification de Contenu : En comprenant quand les utilisateurs sont les plus actifs, vous pouvez planifier la publication de nouvelles recettes, articles ou autres contenus pour maximiser leur visibilité et leur impact. <br><br>

3- Adaptation des Ressources Serveur : Si votre site génère un trafic significatif à certaines heures de la journée, cela peut influencer la gestion des ressources serveur. Vous pourriez ajuster la capacité du serveur pour optimiser la performance pendant les périodes de trafic intense. <br><br>

4- Analyse des Tendances Temporelles : Le graphe par heure permet de détecter des tendances temporelles dans les préférences des utilisateurs. Certains ingrédients ou types de recettes pourraient être plus populaires à des moments spécifiques de la journée, offrant ainsi des insights pour des recommandations plus ciblées. <br><br>

5- Mesure de l'Efficacité des Campagnes Marketing : Si vous lancez des campagnes marketing à des moments spécifiques, le graphe peut aider à évaluer l'efficacité de ces campagnes en observant les fluctuations du trafic pendant et après les campagnes. <br><br>

6- Amélioration de l'Engagement : En comprenant quand les utilisateurs sont les plus actifs, vous pouvez optimiser les fonctionnalités interactives du site, les discussions en direct ou d'autres formes d'engagement pour maximiser l'interaction utilisateur. <br><br>

7- Gestion du Personnel : Si le site est lié à une entreprise de restauration, les données par heure peuvent aider à planifier les quarts de travail du personnel en fonction des périodes de demande maximale. <br><br>

</p>

</body>

</html>





 <!-- --------------------------------------------------------------------------------------- -->

<!-- style 2 : Pie Chart -->

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
        <canvas id="userActionsChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des actions par utilisateur
        var labels = infos.map(function (info) {
            return info.idUser;
        });

        var data = infos.map(function (info) {
            return info.totalActions;
        });

        // Utiliser une palette de couleurs prédéfinie
        var backgroundColors = [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)',
            'rgba(255, 159, 64, 0.8)'
        ];

        // Configurer le graphique en secteurs
        var ctx = document.getElementById('userActionsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',  // Changer le type en 'pie' pour un graphique en secteurs
            data: {
                labels: labels,
                datasets: [{
                    label: "Actions par Utilisateur",
                    data: data,
                    backgroundColor: backgroundColors,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html> -->





<!-- -------------------------------------------------------------------------------------- -->

<!-- style 3 : radar -->

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
        <canvas id="userActionsChart"></canvas>
    </div>

    <script>
        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des actions par utilisateur
        var labels = infos.map(function (info) {
            return info.idUser;
        });

        var data = infos.map(function (info) {
            return info.totalActions;
        });

        // Utiliser une palette de couleurs prédéfinie
        var borderColor = 'rgba(75, 192, 192, 1)';

        // Configurer le graphique en radar
        var ctx = document.getElementById('userActionsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'radar',  // Changer le type en 'radar' pour un graphique en radar
            data: {
                labels: labels,
                datasets: [{
                    label: "Actions par Utilisateur",
                    data: data,
                    borderColor: borderColor,
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html> -->
