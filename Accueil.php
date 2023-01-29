<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<?php

include_once 'Config.php';

?>

    <h1>Recherche</h1>
    <form action="Filtre_recherche.php" method = "POST">
        <div class = "filtre_recherche">
            <label for="Surname">Nom :  </label>
            <input type="text" name = "Name"> <br>
            <label for="Firstname">Prénom : </label>
            <input type="text" name = "Firstname"> <br>
            <label for="Departement">Département : <br>
                <?php 
                $pdo = new PDO(Config::$url, Config::$user, Config::$password);
                $departement = $pdo -> prepare("SELECT NomDepartement FROM departement");
                $departement -> execute();
                $departement = $departement -> fetchAll();
                foreach($departement as $departement){
                    echo $departement['NomDepartement'];?>
                    <input type="checkbox" name = "Departement">
                    <?php

                }

                ?>
                </label> <br>
            <label for="Poste">Poste : <br>
                <?php
                $poste = $pdo -> prepare("SELECT NomPoste FROM poste");
                $poste -> execute();
                $poste = $poste -> fetchAll();
                foreach($poste as $poste){
                    echo $poste['NomPoste'];?>
                    <input type="checkbox" name = "Poste">
                    <?php

                }

                ?>
                </label> <br>
                <input type="submit" value ="Recherche">
            
        </div>
    </form>





</body>
</html>