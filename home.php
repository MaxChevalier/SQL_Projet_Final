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

        <!-- <div class="mid">
            <?php
            //recuperer et afficher les employes
            // try {
            $sql = "SELECT * FROM `employes`";
            $result = $pdo->query($sql);
            $result = $result->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                // echo "<table>";
                foreach ($result as $row) {
                    // echo "<tr>";
                    $departement = $pdo->query("SELECT NomDepartement FROM `departement` WHERE ID_Departement = {$row["ID_Departement"]}")->fetchAll()[0][0];
                    $poste = $pdo->query("SELECT NomPoste FROM `poste` WHERE ID_Poste = {$row["ID_Poste"]}")->fetchAll()[0][0];
                    $PrintList = [$row["Nom"],  $row["Prenom"],  $row["DateArrive"],  $row["Email"],  $row["Telephone"],  $row["Civilite"], $row["AdressePostale"],  $poste, $departement];
                    foreach ($PrintList as $value) {
                         echo "<td>{$value}</td>";
                    }
                }
            } else {
                echo "0 results";
            }
            // } catch (PDOException $e) {
            //     echo "Error: " . $e->getMessage();
            // }*/
            ?>
        </div> -->
        <div class="left" id="1">
            <div id="hover-element">
                <?php
                if (count($result) > 0) {
                    foreach ($result as $row) {
                ?>
                        <div class="profile" id="2">
                            <div class="photo" id="3">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/764024/profile/profile-512.jpg">
                            </div>
                            <div class="content" id="4">
                                <div class="text" id="5">
                                    <p><?php
                                        echo $row["Nom"], $row["Prenom"];
                                        echo "<h6>{$poste}, {$departement}</h6>";
                                        ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
    <div class="right"></div>
    <div id="hover-element"></div>
    <div id="hidden-div" style="display:none;"><?php foreach ($PrintList as $value) {
                         echo "<td>{$value}</td>";
            }?></div>
    <script>
        let hoverElement = document.getElementById("hover-element");
        let hiddenDiv = document.getElementById("hidden-div");

        hoverElement.onmouseover = function() {
            hiddenDiv.style.display = "block";
        }

        hoverElement.onmouseout = function() {
            hiddenDiv.style.display = "none";
        }
    </script>
</body>

</html>