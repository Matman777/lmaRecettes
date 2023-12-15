
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
                        color: '#fff', // Couleur du texte
                        formatter: (value, context) => {
                            // Afficher la valeur sur le graphique
                            return value;
                        }
                    }
                }

            }
        });

    </script>

</body>

</html>





<!-- ----------------------------------------------------------------------------------------- -->
