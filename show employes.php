<?php require 'Configue.php'; ?>
<?php 
// recuperer et afficher les employes
    $sql = "SELECT * FROM `employes`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $departement = $conn->query("SELECT NomDepartement FROM `Departement` WHERE ID_Departement = {$row["ID_Departement"]}")->fetch_all()[0][0];
            $poste = $conn->query("SELECT NomPoste FROM `Poste` WHERE ID_Poste = {$row["ID_Poste"]}")->fetch_all()[0][0];
            echo "" . $row["Nom"]. " " . $row["Prenom"]." " . $row["DateArrive"]." " . $row["Email"]." " . $row["Telephone"]." " . $row["Civilite"]." " . $row["AdressePostale"]." " . $poste." " . $departement."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
?>