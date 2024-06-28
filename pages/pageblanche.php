<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Une page blanche</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <?php
    // appelle de la page menu avec tous les codes
    include ("menu.php");
    ?>
    <div class="container">
        <div class="panel panel-primary   marginTop">
            <div class="panel-heading">
                Recherche de Filieres
            </div>
            <div class="panel-body">
                Corps de notre panel
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                Liste des Filieres
            </div>
            <div class="panel-body">
                Tableau de Filieres
            </div>
        </div>
    </div>

</body>

</html>