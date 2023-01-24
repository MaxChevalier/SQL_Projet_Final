<?php
require_once 'Config.php';
$pdo = new PDO(Config::$url, Config::$user, Config::$password);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <script src="home.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="header">

    </div>
    <div class="contant">
        <?php
        // recuperer et afficher les employes
        // try {
            $sql = "SELECT * FROM `employes`";
            $result = $pdo->query($sql);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                echo "<table>";
                foreach ($result as $row) {
                    echo "hey";
                    $departement = $pdo->query("SELECT NomDepartement FROM `Departement` WHERE ID_Departement = {$row["ID_Departement"]}")->fetchAll()[0][0];
                    echo "hey";
                    $poste = $pdo->query("SELECT NomPoste FROM `Poste` WHERE ID_Poste = {$row["ID_Poste"]}")->fetchAll()[0][0];
                    echo "hey";
                    $PrintList = [$row["Nom"],$row["Prenom"],$row["DateArrive"],$row["Email"],$row["Telephone"],$row["Civilite"],$row["AdressePostale"],$poste,$departement];
                    echo "<tr>";
                    foreach ($PrintList as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
        // } catch (PDOException $e) {
        //     echo "Error: " . $e->getMessage();
        // }
        ?>
    </div>
</body>

</html>