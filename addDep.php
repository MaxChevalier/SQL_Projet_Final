<?php
if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    require_once 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    switch ($_POST["addDep_Poste"]) {
        case "Departement":
            $pdo->query("INSERT INTO departement (NomDepartement) VALUES ('" . $_POST["addDep_PosteName"] . "')");
            break;
        case "Poste":
            $pdo->query("INSERT INTO poste (NomPoste) VALUES ('" . $_POST["addDep_PosteName"] . "')");
            break;
    }
}
header('Location: home.php');