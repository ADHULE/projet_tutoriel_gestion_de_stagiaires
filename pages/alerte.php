<?php
// verifier et recuperer le message d'erreur de suppression d'une filiere
$message = isset($_GET['message']) ? $_GET['message'] : "Erreur";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>

<body>
    <?php
    // appelle de la page menu avec tous les codes
    include ("menu.php");
    ?>
    <div class="container">
        <div class="panel panel-danger   marginTop">
            <div class="panel-heading">
                <h3>
                    Erreur:
                </h3>
            </div>
            <div class="panel-body">
                <!-- afficher le message recuperé -->
                <h2><?php echo $message; ?></h2>
                <!-- retourner a la page d'acteille -->
                <h3>
                    <a href="filiere.php">Retourner >>>>>>></a>
                </h3>
            </div>
        </div>

    </div>

</body>

</html>