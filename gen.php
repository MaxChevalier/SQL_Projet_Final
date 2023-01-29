<?php
require_once 'Config.php';
try {
    $pdo = new PDO(Config::$url, Config::$user, Config::$password);
    $AllName = [
        "EMMA", "OLIVIA", "ALICE", "FLORENCE", "CHARLIE", "LIVIA", "CHARLOTTE", "LEA", "ROMY", "ZOE",
        "CLARA", "JULIETTE", "ROSALIE", "BEATRICE", "ROSE", "CHLOE", "EVA", "SOFIA", "MIA", "MILA", "VICTORIA", "JADE",
        "JULIA", "LEONIE", "MAEVA", "RAPHAELLE", "JEANNE", "CAMILLE", "AMELIA", "FLAVIE", "OPHELIE", "ELIZABETH",
        "ELENA", "ADELE", "ELEONORE", "SOPHIA", "JASMINE", "LAURENCE", "LEXIE", "ALICIA", "LILY", "OCEANE", "ELLIE",
        "SARAH", "ANNA", "FLORA", "SIMONE", "NOELIE", "SOPHIE", "MAELIE", "NOAH", "WILLIAM", "THOMAS", "LEO", "LIAM",
        "JACOB", "NATHAN", "ARTHUR", "EDOUARD", "FELIX", "LOGAN", "EMILE", "LOUIS", "CHARLES", "RAPHAEL", "JAMES",
        "ARNAUD", "THEO", "VICTOR", "ADAM", "ELLIOT", "ALEXIS", "HENRI", "JULES", "BENJAMIN", "SAMUEL", "GABRIEL",
        "MILAN", "OLIVIER", "LAURENT", "THEODORE", "NOLAN", "JACKSON", "JAYDEN", "LUCAS", "ANTOINE", "ZACK", "ELOI",
        "ETHAN", "MATHEO", "AXEL", "JAKE", "ELI", "MATHIS", "HUBERT", "XAVIER", "ZACHARY", "LEONARD", "LOIC", "MAYSON"
    ];
    for ($i = 0; $i < 100; $i++) {
        $name = $AllName[rand(0, count($AllName) - 1)];
        $prenom = $AllName[rand(0, count($AllName) - 1)];
        $date = rand(2010, 2022) . "-" . rand(1, 12) . "-" . rand(1, 28);
        $email = $name . "." . $prenom . "@gmail.com";
        $tel = rand(100000000, 999999999);
        $civilite = rand(0, 1) ? "M" : "Mme";
        $address = rand(1, 100) . " rue de la paix";
        $post = rand(1, 6);
        $departement = rand(1, 7);
        $pdo->exec("INSERT INTO `employes` (`Nom`, `Prenom`, `DateArrive`, `Email`, `Telephone`, `Civilite`, `AdressePostale`, `ID_Poste`, `ID_Departement`) VALUES ('$name', '$prenom', '$date', '$email', '$tel', '$civilite', '$address', '$post', '$departement')");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
