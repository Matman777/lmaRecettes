<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script>
        var idUser = "<?php echo bin2hex(random_bytes(16)); ?>";
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Statistic LMA Recettes</title>
</head>

<body>
    <h1>Hello ---------></h1>
    
    <div id="stat"></div>
</body>