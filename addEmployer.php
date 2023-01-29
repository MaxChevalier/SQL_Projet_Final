<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'Config.php';
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    if ($_POST["popIdEmployer"] === "Null") {
        $pdo->query("INSERT INTO employes (Nom,Prenom,DateArrive,Email,Telephone,Civilite,AdressePostale,ID_Poste,ID_Departement) VALUES ('" . $_POST["popName"] . "','" . $_POST["popFirstName"] . "','" . $_POST["popArrivalDate"] . "','" . $_POST["popEmail"] . "','" . $_POST["popPhone"] . "','" . $_POST["popCivilite"] . "','" . $_POST["popAddress"] . "','" . $_POST["popIdPost"] . "','" . $_POST["popIdDepartment"] . "')");
    } else {
        $pdo->query("UPDATE employes SET Nom = '" . $_POST["popName"] . "', Prenom = '" . $_POST["popFirstName"] . "', DateArrive = '" . $_POST["popArrivalDate"] . "', Email = '" . $_POST["popEmail"] . "', Telephone = '" . $_POST["popPhone"] . "', Civilite = '" . $_POST["popCivilite"] . "', AdressePostale = '" . $_POST["popAddress"] . "', ID_Poste = '" . $_POST["popIdPost"] . "', ID_Departement = '" . $_POST["popIdDepartment"] . "' WHERE ID_Employes = '" . $_POST["popIdEmployer"] . "'");
    }
}
header('Location: home.php');
