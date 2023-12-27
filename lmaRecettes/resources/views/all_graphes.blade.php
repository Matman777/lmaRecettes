<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
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
    </style>

    <title>Admin</title>
</head>

<body>

    <div class="chart-container">
        <h2>Le nombre de clics sur chaque ingrédient</h2>
        <canvas id="ingredientChart"></canvas>


        <p>

            1- Compréhension des Préférences des Utilisateurs : Le graphe de clics sur les ingrédients permet de visualiser les préférences des utilisateurs en temps réel. Cela offre des informations précieuses sur les ingrédients les plus populaires et les combinaisons appréciées, ce qui peut orienter le développement de nouvelles recettes ou la mise en avant de certaines options. <br><br>

            2- Personnalisation de l'Expérience Utilisateur : En comprenant quels ingrédients suscitent le plus d'intérêt, votre site peut être optimisé pour offrir une expérience utilisateur plus personnalisée. Vous pourriez suggérer des recettes en fonction des ingrédients populaires, améliorant ainsi la pertinence pour chaque visiteur. <br><br>

            3- Optimisation du Contenu : Les données du graphe peuvent aider à optimiser le contenu du site en mettant en avant les ingrédients les plus recherchés. Cela peut conduire à une meilleure rétention des utilisateurs et à une augmentation du temps passé sur le site. <br><br>

            4- Prise de Décision Informée : Pour les professionnels de la cuisine ou de la restauration, le graphe peut fournir des informations précieuses sur les tendances du marché. Cela peut aider les chefs à ajuster leurs menus en fonction des préférences actuelles des consommateurs. <br><br>

            5- Suivi de la Popularité au Fil du Temps : Le graphe peut également être utilisé pour suivre la popularité des ingrédients au fil du temps. Cela permet de repérer les tendances émergentes et d'anticiper les changements de comportement des utilisateurs. <br><br>

            6- Optimisation du Stock et des Approvisionnements : Si le site est lié à une entreprise de restauration ou à une épicerie, les données de clics peuvent être utilisées pour optimiser les niveaux de stock et les approvisionnements en fonction de la demande réelle des utilisateurs. <br><br>

            7- Engagement Utilisateur : En mettant en avant le graphe de clics, vous montrez que le site est axé sur l'expérience utilisateur en offrant des fonctionnalités interactives et en montrant que les choix des utilisateurs sont valorisés. <br><br>

        </p>
    </div>

    <div class="chart-container">
        <h2>Le nombre de clics sur la page chaque jour</h2>
        <canvas id="dailyChart"></canvas>


        <p>
            1- Analyse des Tendances Hebdomadaires : Le graphe par jour permet d'analyser les tendances hebdomadaires en termes de fréquentation du site. Cela peut être utile pour planifier des promotions, des mises à jour de contenu ou d'autres événements en fonction des jours de la semaine où l'activité est la plus élevée. <br><br>

            2- Planification de Contenu : En comprenant quels jours de la semaine voient le plus d'activité, vous pouvez planifier la publication de contenu important pour maximiser son impact. Par exemple, réservez les nouvelles recettes ou les articles phares pour les jours où la fréquentation est historiquement élevée. <br><br>

            3- Optimisation des Campagnes Marketing : Si vous exécutez des campagnes marketing spécifiques à certains jours de la semaine, le graphe peut aider à évaluer l'efficacité de ces campagnes en observant les variations du trafic pendant et après les campagnes. <br><br>

            4- Gestion des Stocks et Approvisionnements : Si votre site est lié à une entreprise de restauration ou de commerce électronique, les données par jour peuvent aider à optimiser la gestion des stocks en fonction de la demande quotidienne. <br><br>

            5- Adaptation des Ressources Serveur : Si vous observez des pics d'activité à certains moments de la semaine, vous pouvez ajuster la capacité du serveur pour répondre à ces pics et garantir une performance optimale. <br><br>

            6- Identification des Événements ou Tendances Particulières : Des variations inhabituelles dans le nombre de clics peuvent indiquer des événements spéciaux, des campagnes virales, ou des tendances particulières qui méritent une attention particulière. <br><br>

            7- Planification des Opérations et du Personnel : Les données par jour peuvent aider à planifier les opérations et le personnel en fonction des fluctuations de la demande tout au long de la semaine. <br><br>
        </p>
    </div>

    <div class="chart-container">
        <h2>Nombre de clics par heure sur la page</h2>
        <canvas id="hourlyChart"></canvas>


        <p>

            1- Identification des Périodes d'Activité : Le graphe par heure permet d'identifier les périodes de la journée où l'activité sur le site est la plus élevée. Cela peut être utile pour planifier des mises à jour de contenu, des promotions spéciales ou d'autres activités promotionnelles pendant les heures de pointe. <br><br>

            2- Optimisation de la Planification de Contenu : En comprenant quand les utilisateurs sont les plus actifs, vous pouvez planifier la publication de nouvelles recettes, articles ou autres contenus pour maximiser leur visibilité et leur impact. <br><br>

            3- Adaptation des Ressources Serveur : Si votre site génère un trafic significatif à certaines heures de la journée, cela peut influencer la gestion des ressources serveur. Vous pourriez ajuster la capacité du serveur pour optimiser la performance pendant les périodes de trafic intense. <br><br>

            4- Analyse des Tendances Temporelles : Le graphe par heure permet de détecter des tendances temporelles dans les préférences des utilisateurs. Certains ingrédients ou types de recettes pourraient être plus populaires à des moments spécifiques de la journée, offrant ainsi des insights pour des recommandations plus ciblées. <br><br>

            5- Mesure de l'Efficacité des Campagnes Marketing : Si vous lancez des campagnes marketing à des moments spécifiques, le graphe peut aider à évaluer l'efficacité de ces campagnes en observant les fluctuations du trafic pendant et après les campagnes. <br><br>

            6- Amélioration de l'Engagement : En comprenant quand les utilisateurs sont les plus actifs, vous pouvez optimiser les fonctionnalités interactives du site, les discussions en direct ou d'autres formes d'engagement pour maximiser l'interaction utilisateur. <br><br>

            7- Gestion du Personnel : Si le site est lié à une entreprise de restauration, les données par heure peuvent aider à planifier les quarts de travail du personnel en fonction des périodes de demande maximale. <br><br>

        </p>
    </div>

    <div class="chart-container">
        <h2>Nombre de connexions selon le navigateur</h2>
        <div style="width: 90%; margin: auto;">
            <canvas id="userAgentChart"></canvas>
        </div>


        <p>

            1- Compatibilité du Site : En comprenant quels navigateurs sont les plus utilisés par vos visiteurs, vous pouvez optimiser la compatibilité de votre site avec ces navigateurs spécifiques. Cela garantit une expérience utilisateur fluide pour la majorité de votre audience. <br><br>

            2- Détection de Problèmes Techniques : Si un navigateur spécifique connaît un nombre élevé de connexions échouées ou d'erreurs, cela pourrait indiquer des problèmes techniques liés à la compatibilité avec ce navigateur. Ces données peuvent aider à résoudre rapidement les problèmes de compatibilité. <br><br>

            3- Optimisation du Développement Web : En concentrant les efforts de développement web sur les navigateurs les plus populaires, vous maximisez l'efficacité de votre équipe de développement. Cela peut conduire à des mises à jour plus rapides et à une meilleure allocation des ressources. <br><br>

            4- Suivi des Tendances de Navigation : Les tendances dans l'utilisation des navigateurs changent au fil du temps. Votre graphe peut aider à identifier les navigateurs émergents ou en déclin, ce qui peut influencer les choix de développement futurs. <br><br>

            5- Personnalisation de l'Assistance Technique : Si votre site offre un support technique, connaître le navigateur utilisé par un utilisateur peut aider à fournir une assistance plus précise en cas de problème spécifique à ce navigateur. <br><br>

            6- Évaluation de la Performance : En analysant les données de connexion par navigateur, vous pouvez évaluer la performance du site sur différents navigateurs. Cela peut conduire à des optimisations spécifiques pour améliorer la vitesse de chargement et la réactivité du site. <br><br>

            7- Orientation des Campagnes Publicitaires : Si vous menez des campagnes publicitaires en ligne, connaître les navigateurs préférés de votre audience peut aider à optimiser la diffusion des publicités pour maximiser l'impact. <br><br>

        </p>
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
            'rgba(255, 99, 132, 1)', // Rouge vif
            'rgba(255, 165, 0, 1)', // Orange
            'rgba(0, 255, 0, 1)', // Vert
            'rgba(128, 0, 128, 1)', // Violet foncé
            'rgba(255, 215, 0, 1)', // Or
            'rgba(54, 162, 235, 1)', // Bleu ciel
            'rgba(255, 0, 0, 1)', // Rouge
            'rgba(255, 192, 203, 1)', // Rose pâle
            'rgba(0, 128, 0, 1)', // Vert foncé
            'rgba(255, 159, 64, 1)', // Orange clair
            'rgba(255, 69, 0, 1)', // Rouge orangé
            'rgba(70, 130, 180, 1)', // Bleu acier
            'rgba(0, 255, 255, 1)', // Cyan
            'rgba(75, 192, 192, 1)', // Bleu-vert clair
            'rgba(255, 99, 71, 1)', // Tomate
            'rgba(75, 0, 130, 1)', // Indigo
            'rgba(255, 206, 86, 1)', // Jaune doux
            'rgba(0, 128, 128, 1)', // Sarcelle
            'rgba(255, 0, 255, 1)', // Magenta
        ];

        var borderColors = [
            'rgba(153, 102, 255, 1)', // Violet doux
            'rgba(255, 99, 132, 1)', // Rouge vif
            'rgba(255, 165, 0, 1)', // Orange
            'rgba(0, 255, 0, 1)', // Vert
            'rgba(128, 0, 128, 1)', // Violet foncé
            'rgba(255, 215, 0, 1)', // Or
            'rgba(54, 162, 235, 1)', // Bleu ciel
            'rgba(255, 0, 0, 1)', // Rouge
            'rgba(255, 192, 203, 1)', // Rose pâle
            'rgba(0, 128, 0, 1)', // Vert foncé
            'rgba(255, 159, 64, 1)', // Orange clair
            'rgba(255, 69, 0, 1)', // Rouge orangé
            'rgba(70, 130, 180, 1)', // Bleu acier
            'rgba(0, 255, 255, 1)', // Cyan
            'rgba(75, 192, 192, 1)', // Bleu-vert clair
            'rgba(255, 99, 71, 1)', // Tomate
            'rgba(75, 0, 130, 1)', // Indigo
            'rgba(255, 206, 86, 1)', // Jaune doux
            'rgba(0, 128, 128, 1)', // Sarcelle
            'rgba(255, 0, 255, 1)', // Magenta
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
                },

                // animation: {
                //     onComplete: function(animation) {
                //         var ctx = myChart.ctx;
                //         ctx.font = Chart.defaults.global.defaultFontSize + 'px ' + Chart.defaults.global.defaultFontFamily;

                //         myChart.data.datasets.forEach(function(dataset) {
                //             for (var i = 0; i < dataset.data.length; i++) {
                //                 var xPos = myChart.getDatasetMeta(0).data[i].x;
                //                 var yPos = myChart.getDatasetMeta(0).data[i].y;
                //                 var label = dataset.data[i];
                //                 ctx.fillStyle = 'red';
                //                 ctx.textAlign = 'center';
                //                 ctx.fillText(label, xPos, yPos - 5);
                //             }
                //         });
                //     }
                // }
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
                // Configurations spécifiques au graphique quotidien
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
                // Configurations spécifiques au graphique horaire
            }
        });

        // Configurer le graphique en secteurs
        var userAgentCtx = document.getElementById('userAgentChart').getContext('2d');
        var userAgentChart = new Chart(userAgentCtx, {
            type: 'pie',
            data: {
                labels: userAgentData.labels,
                datasets: [{
                    label: "Connexion par ce navigateur",
                    data: userAgentData.data,
                    backgroundColor: backgroundColors, // Utilisez une fonction pour générer des couleurs aléatoires
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

        // Fonction pour générer des couleurs aléatoires
        function getRandomColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        // Fonction pour générer une couleur aléatoire
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>


</body>

</html>