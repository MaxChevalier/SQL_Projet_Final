<?php
require_once 'Config.php';
$pdo = new PDO(Config::$url, Config::$user, Config::$password);
$sql = "SELECT * FROM `employes`";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql .= " WHERE ";
    $sql .= "(Civilite = '{$_POST["civiliteM"]}' OR Civilite = '{$_POST["civiliteMme"]}' OR Civilite = '{$_POST["civiliteAutre"]}') AND ";
    $sql .= "( DateArrive BETWEEN '{$_POST["date_min"]}' AND '{$_POST["date_max"]}' )";
    if ($_POST["poste"] != 0) $sql .= " AND ID_Poste = {$_POST["poste"]}";
    if ($_POST["departement"] != 0) $sql .= " AND ID_Departement = {$_POST["departement"]}";
    if ($_POST["recherche"] != "") $sql .= " AND (Nom LIKE '%{$_POST["recherche"]}%' OR Prenom LIKE '%{$_POST["recherche"]}%')";
}
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$info = [];
if (count($result) > 0) {
    foreach ($result as $row) {
        $departement = $pdo->query("SELECT NomDepartement FROM `Departement` WHERE ID_Departement = {$row["ID_Departement"]}")->fetchAll()[0][0];
        $poste = $pdo->query("SELECT NomPoste FROM `Poste` WHERE ID_Poste = {$row["ID_Poste"]}")->fetchAll()[0][0];
        $PrintList = [$row["Nom"], $row["Prenom"], $row["DateArrive"], $row["Email"], $row["Telephone"], $row["Civilite"], $row["AdressePostale"], $poste, $departement, $row["ID_Employes"]];
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
    <script src="https://kit.fontawesome.com/c85e43ba57.js" crossorigin="anonymous"></script>
    <script src="home.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="header">
        <div class="addUser">
            <button>Ajouter un employer</button>
        </div>
    </div>
    <div class="content_">
        <div class="left">
            <form method="post">
                <input type="text" placeholder="Rechercher ..." name="recherche" class="input" <?php
                                                                                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["recherche"] != "") echo "value='{$_POST["recherche"]}'"
                                                                                                ?>>
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
                    </div>
                </div>
                <hr>
                <h3>date d'arrivée : </h3>
                <div>
                    <input type="date" name="date_min" value="0001-01-01" class="input">
                    <label for="0001-01-01">min</label>
                    <br><br>
                    <?php
                    $date = date("Y-m-d");
                    echo "<input type='date' name='date_max' value='$date' class=\"input\">";
                    echo "<label for='$date'> max</label>";
                    ?>
                </div>
                <hr>
                <h3>poste : </h3>
                <select name="poste" id="poste">
                    <option value="0">Tous</option>
                    <?php
                    $result = $pdo->query("SELECT * FROM `Poste`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='{$row["ID_Poste"]}'";
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["poste"] == $row["ID_Poste"]) echo "selected";
                        echo ">{$row["NomPoste"]}</option>";
                    }
                    ?>
                </select>
                <hr>
                <h3>département : </h3>
                <select name="departement" id="departement">
                    <option value="0">Tous</option>
                    <?php
                    $result = $pdo->query("SELECT * FROM `Departement`")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='{$row["ID_Departement"]}'";
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["departement"] == $row["ID_Departement"]) echo "selected";
                        echo ">{$row["NomDepartement"]}</option>";
                    }
                    ?>
                </select>
                <hr>
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="center">
            <div class="haut">
                <div class="image">
                    <img src="./img/chat.jpg">
                </div>
                <div class="info">
                    <h1 id="civilite">Civilite</h1>
                    <h1 id="nom">Nom</h1>
                    <h1 id="prenom">Prenom</h1>
                </div>
            </div>
            <div class="bas">
                <div>
                    <label for="date">Date d'arrivée : </label>
                    <p id="date">Date d'arrivée</p>
                </div>
                <div>
                    <label for="poste_">Poste : </label>
                    <p id="poste_">Poste</p>
                </div>
                <div>
                    <label for="departement_">Département : </label>
                    <p id="departement_">Département</p>
                </div>
                <div>
                    <label for="tel">Téléphone : </label>
                    <p id="tel">Téléphone</p>
                </div>
                <div>
                    <label for="mail">Mail : </label>
                    <p id="mail">Mail</p>
                </div>
                <div>
                    <label for="adresse">Adresse : </label>
                    <p id="adresse">Adresse</p>
                </div>
            </div>
            <div class="funcButton">
                <button id="modif">
                    <i class="fa-solid fa-pencil"></i>
                </button>
                <form action="deleteUser.php" method="post">
                    <button id="suppr" type="submit" name="id" value="">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
                <script>
                    // #suppr event before submit
                    document.getElementById("suppr").addEventListener("click", function(e) {
                        if (!confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
                            e.preventDefault();
                        }
                    });
                </script>
            </div>
        </div>
        <div class="right"> <!-- le trucvert -->
            <?php
            if (count($info) > 0) {
                for ($j = 0; $j < count($info); $j++) {
                    $row = $info[$j];
            ?>
                    <div class="profile" id="<?php $j ?>" onmouseover="showinfo(<?php echo $j ?>)">
                        <div class="photo">
                            <img src="./img/chat.jpg">
                        </div>
                        <div class="content">
                            <div class="text">
                                <p><?php
                                    echo $row[0], " ", $row[1];
                                    echo "<h6>{$row[8]}, {$row[7]}</h6>";
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div>
                            <?php
                            for ($i = 0; $i < count($row); $i++) {
                                echo "<input type='hidden' value=\"{$row[$i]}\" id='{$j}/{$i}'>";
                            }
                            ?>
                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>
    </div>
    <div class="popUpAddEmployer">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="civilite">civilité : </label>
                    </td>
                    <td>
                        <select name="civilite">
                            <option value="M">M</option>
                            <option value="Mme">Mme</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name">Nom : </label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Nom" maxlength="50">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="firstname">Prénom : </label>
                    </td>
                    <td>
                        <input type="text" name="firstname" placeholder="Prénom">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email : </label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="phone">Téléphone : </label>
                    </td>
                    <td>
                        <input type="text" name="phone" placeholder="Phone">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Adresse : </label>
                    </td>
                    <td>
                        <input type="text" name="address" placeholder="Address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="arrivalDate">Date d'arrivé : </label>
                    </td>
                    <td>
                        <input type="date" name="arrivalDate" placeholder="Date d'arrivé">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="idPost">Post : </label>
                    </td>
                    <td>
                        <select name="idPost">
                            <?php
                            $result = $pdo->query("SELECT * FROM `Poste`")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                echo "<option value='{$row["ID_Poste"]}'";
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["poste"] == $row["ID_Poste"]) echo "selected";
                                echo ">{$row["NomPoste"]}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="idDepartment">Département : </label>
                    </td>
                    <td>
                        <select name="idDepartment">
                            <?php
                            $result = $pdo->query("SELECT * FROM `Departement`")->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                echo "<option value='{$row["ID_Departement"]}'";
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["departement"] == $row["ID_Departement"]) echo "selected";
                                echo ">{$row["NomDepartement"]}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit">Ajouter</button>
        </form>
        <button class="closePopUpAddEmployer">
            <i class="fa-solid fa-times"></i>
        </button>
        <script>
            document.querySelector(".closePopUpAddEmployer").addEventListener("click", function(
                closePopUp();
            ));
            document.querySelector(".addUser button").addEventListener("click", function() {
                document.querySelector(".popUpAddEmployer").style.display = "block";
            });
        </script>
    </div>
</body>

</html>