<?php
// appelle de la page de gestion de securité des différentes pages
require_once('identifierSession.php');
// **************************************************************************************************
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier le mot de passe</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
  <script src="../js/monJS.jss"></script>
</head>

<body id="bodyupdatepassword">
  <div class="container col-md-6 col-md-offset-3 editPwd-page">
    <form action="updatePwd.php" method="post" class="form-horizontal">
      <h1 class="text-center">Changement de mot de passe</h1>
      <h2 class="text-center">Compte: <?php echo $_SESSION['user']['login']  ?></h2>
      <div class="form-group">
        <input type="text" minlength="4" name="oldpwd" id="nom" placeholder="Last Password" class="form-control" autocomplete="false" required>
      </div>
      <i class="fa fa-eye fa-2x "></i>

      <div class="form-group">
        <input type="password" minlength="4" name="newpwd" id="nom" placeholder="New Password" class="form-control" autocomplete="false" required>
      </div>
      <i class="fa fa-eye fa-2x "></i>
      <button type="submit" class="btn btn-success">
        <span class="glyphicon glyphicon-save"></span>Enregistrer</button>
    </form>
  </div>
</body>