<?php
require_once 'Config.php';
$pdo = new PDO(Config::$url, Config::$user, Config::$password);
$sql = "SELECT * FROM `employes`";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $sql .= " WHERE ";
    $sql .= "Civilite = '{$_POST["civiliteM"]}' OR '{$_POST["civiliteMme"]}' OR '{$_POST["civiliteAutre"]}' AND ";
    // TODO : filtrer par date
    $sql .= "DateArrive BETWEEN '{$_POST["date_min"]}' AND '{$_POST["date_max"]}'";
    if ($_POST["poste"] != 0) $sql .= " AND ID_Poste = {$_POST["poste"]}";
    if ($_POST["departement"] != 0) $sql .= " AND ID_Departement = {$_POST["departement"]}";
}
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$info = [];
if (count($result) > 0) {
    foreach ($result as $row) {
        $departement = $pdo->query("SELECT NomDepartement FROM `Departement` WHERE ID_Departement = {$row["ID_Departement"]}")->fetchAll()[0][0];
        $poste = $pdo->query("SELECT NomPoste FROM `Poste` WHERE ID_Poste = {$row["ID_Poste"]}")->fetchAll()[0][0];
        $PrintList = [$row["Nom"], $row["Prenom"], $row["DateArrive"], $row["Email"], $row["Telephone"], $row["Civilite"], $row["AdressePostale"], $poste, $departement];
        array_push($info, $PrintList);
    }
}
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
    <div class="content">
        <div class="left">
            <form method="post">
                <input type="text" placeholder="Rechercher ...">
                <hr>
                <h3>civilité : </h3>
                <div class="civ">
                <div><input type="checkbox" name="civiliteM" value="M" <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_POST["civiliteM"]) echo "checked"
                ?>>
                    <label for="M">M</label>
                </div>
                <div>
                    <input type="checkbox" name="civiliteMme" value="Mme" <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_POST["civiliteMme"]) echo "checked"
                ?>>
                    <label for="Mme">Mme</label>
                </div>
                <div>
                    <input type="checkbox" name="civiliteAutre" value="Autre" <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_POST["civiliteAutre"]) echo "checked"
                ?>>
                    <label for="Autre">Autre</label>
                </div></div>
                <hr>
                <h3>date d'arrivée : </h3>
                <div>
                    <input type="date" name="date_min" value="0001-01-01">
                    <label for="0001-01-01">min</label>
                    <br>
                    <?php
                    $date = date("Y-m-d");
                    echo "<input type='date' name='date_max' value='$date'>";
                    echo "<label for='$date'> max</label>";
                    ?>
                </div>
                <p style="color: white; background-color:red;padding:2px;">! Hors Service !</p>
                <!-- TODO : filtrer par date -->
                <hr>
                <h3>poste : </h3>
                <div>
                    <select name="poste" id="poste">
                        <option value="0">Tous</option>
                        <?php
                        $result = $pdo->query("SELECT * FROM `Poste`")->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo "<option value='{$row["ID_Poste"]}'>{$row["NomPoste"]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <h3>département : </h3>
                <div>
                    <select name="departement" id="departement">
                    <option value="0">Tous</option>
                        <?php
                        $result = $pdo->query("SELECT * FROM `Departement`")->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo "<option value='{$row["ID_Departement"]}'>{$row["NomDepartement"]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="center">
            <table>
            <?php
            foreach ($info as $row) {
                echo "<tr>";
                foreach ($row as $col) {
                    echo "<td>$col</td>";
                }
                echo "</tr>";
            }
            ?>
            </table>
        </div>
        <div class="right">
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
</body>

</html>