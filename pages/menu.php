<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">Les stagiaires</a>
            <!-- le menu pour afficher les liens des differentes pages -->
            <ul class="nav navbar-nav">
                <li><a href="stagiaire.php"> stagiaires</a></li>
                <li><a href="filiere.php">filières</a></li>
                <li><a href="utilisateur.php">utilisateurs</a></li>
            </ul>
            <!-- le menu pour afficher les liens à droit de la page -->
            <ul class="nav navbar-nav navb-right ">
                <?php if ($_SESSION['user']['role'] === 'ADMIN') { ?>
                <?php } ?>
                <li>
                    <!-- afficher le nom de la personne connectée -->
                    <a href="editerUtilisateur.php?idU=<?php echo $_SESSION['user']['idUser'] ?>">
                        <i class="glyphicon glyphicon-user ">
                            <?php echo $_SESSION['user']['login'] ?>
                        </i>
                    </a>
                </li>
                <li><a href="seDeconnecterPage.php">
                        <i class="glyphicon glyphicon-log-out">&nbsp; Se deconnecter</i>
                    </a></li>
            </ul>
        </div>
    </div>
</nav>