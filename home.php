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
        $PrintList = [$row["Nom"], $row["Prenom"], $row["DateArrive"], $row["Email"], $row["Telephone"], $row["Civilite"], $row["AdressePostale"], $poste, $departement, $row["ID_Employes"], $row["ID_Departement"], $row["ID_Poste"]];
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
        <div class="headerName">
            <h1>Employes Manager</h1>
        </div>
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
                <h3>Date d'arrivée : </h3>
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
                <h3>Poste : </h3>
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
                <h3>Département : </h3>
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
            <input type="hidden" id="id_poste" value="">
            <input type="hidden" id="id_dep" value="">
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
        <div class="right">
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
        <div class="crossPopUp">
            <button class="closePopUpAddEmployer">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <form method="post" action="addEmployer.php">
            <table>
                <tr>
                    <td>
                        <label for="popCivilite">civilité : </label>
                    </td>
                    <td>
                        <select name="popCivilite" id="popCivilite">
                            <option value="M">M</option>
                            <option value="Mme">Mme</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popName">Nom : </label>
                    </td>
                    <td>
                        <input type="text" name="popName" id="popName" placeholder="Nom" maxlength="50">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popFirstName">Prénom : </label>
                    </td>
                    <td>
                        <input type="text" name="popFirstName" id="popFirstName" placeholder="Prénom">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popEmail">Email : </label>
                    </td>
                    <td>
                        <input type="text" name="popEmail" id="popEmail" placeholder="Email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popPhone">Téléphone : </label>
                    </td>
                    <td>
                        <input type="text" name="popPhone" id="popPhone" placeholder="Phone">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popAddress">Adresse : </label>
                    </td>
                    <td>
                        <input type="text" name="popAddress" id="popAddress" placeholder="Address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popArrivalDate">Date d'arrivé : </label>
                    </td>
                    <td>
                        <input type="date" name="popArrivalDate" id="popArrivalDate" placeholder="Date d'arrivé">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="popIdPost">Post : </label>
                    </td>
                    <td>
                        <select name="popIdPost" id="popIdPost">
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
                        <label for="popIdDepartment">Département : </label>
                    </td>
                    <td>
                        <select name="popIdDepartment" id="popIdDepartment">
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
                    <td>
                        <button class="plusButton">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="popIdEmployer" value="Null" id="popIdEmployer">
            <button type="submit" id="sumbmitEmployer" class="AddButtonPopUp">Ajouter</button>
        </form>
        <script>
            document.querySelector(".closePopUpAddEmployer").addEventListener("click", function() {
                document.querySelector(".popUpAddEmployer").style.display = "none";
            });
            document.querySelector(".addUser button").addEventListener("click", function() {
                document.querySelector(".popUpAddEmployer").style.display = "block";
                document.getElementById("popIdEmployer").value = "Null";
                resetPopUp();
            });
            // #show popup to update user
            document.getElementById("modif").addEventListener("click", function() {
                document.querySelector(".popUpAddEmployer").style.display = "block";
                document.getElementById("popIdEmployer").value = document.getElementById("suppr").value;
                setPopUp();
            });
            document.getElementById("sumbmitEmployer").addEventListener("click", function(e) {
                if (!(document.getElementById("popName").value && document.getElementById("popFirstName").value && document.getElementById("popEmail").value && document.getElementById("popPhone").value && document.getElementById("popAddress").value && document.getElementById("popArrivalDate").value)) {
                    e.preventDefault();
                    alert("Veuillez remplir tout les champs");
                }
            });
        </script>
    </div>
</body>

</html>