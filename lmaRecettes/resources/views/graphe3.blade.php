
<!-- style 1 : Graphique en Secteurs (Pie Chart) : -->

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

    <h2>Nombre de connexion selon navigateur</h2>


    <div style="width: 80%; margin: auto;">
        <canvas id="userAgentChart"></canvas>
    </div>

    <script>

        // Récupérer les données depuis Laravel
        var infos = <?php echo json_encode($infos); ?>;

        // Extraire les noms et les totaux des actions par user_agent
        var labels = infos.map(function (info) {
            return info.user_agent;
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
            'rgba(153, 102, 255, 0.8)'
        ];

        // Configurer le graphique en secteurs
        var ctx = document.getElementById('userAgentChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',  // Changer le type en 'pie' pour un graphique en secteurs
            data: {
                labels: labels,
                datasets: [{
                    label: "Connexion par ce navigateur",
                    data: data,
                    backgroundColor: backgroundColors,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => {
                            // Afficher la valeur sur le graphique
                            return value;
                        }
                    }
                }

            }
        });

    </script>

    <p>

        1- Compatibilité du Site : En comprenant quels navigateurs sont les plus utilisés par vos visiteurs, vous pouvez optimiser la compatibilité de votre site avec ces navigateurs spécifiques. Cela garantit une expérience utilisateur fluide pour la majorité de votre audience. <br><br>

        2- Détection de Problèmes Techniques : Si un navigateur spécifique connaît un nombre élevé de connexions échouées ou d'erreurs, cela pourrait indiquer des problèmes techniques liés à la compatibilité avec ce navigateur. Ces données peuvent aider à résoudre rapidement les problèmes de compatibilité. <br><br>

        3- Optimisation du Développement Web : En concentrant les efforts de développement web sur les navigateurs les plus populaires, vous maximisez l'efficacité de votre équipe de développement. Cela peut conduire à des mises à jour plus rapides et à une meilleure allocation des ressources. <br><br>

        4- Suivi des Tendances de Navigation : Les tendances dans l'utilisation des navigateurs changent au fil du temps. Votre graphe peut aider à identifier les navigateurs émergents ou en déclin, ce qui peut influencer les choix de développement futurs. <br><br>

        5- Personnalisation de l'Assistance Technique : Si votre site offre un support technique, connaître le navigateur utilisé par un utilisateur peut aider à fournir une assistance plus précise en cas de problème spécifique à ce navigateur. <br><br>

        6- Évaluation de la Performance : En analysant les données de connexion par navigateur, vous pouvez évaluer la performance du site sur différents navigateurs. Cela peut conduire à des optimisations spécifiques pour améliorer la vitesse de chargement et la réactivité du site. <br><br>

        7- Orientation des Campagnes Publicitaires : Si vous menez des campagnes publicitaires en ligne, connaître les navigateurs préférés de votre audience peut aider à optimiser la diffusion des publicités pour maximiser l'impact. <br><br>

    </p>

</body>

</html>





<!-- ----------------------------------------------------------------------------------------- -->
