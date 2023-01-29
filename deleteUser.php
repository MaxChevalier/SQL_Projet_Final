<?php
require_once 'Config.php';
$pdo = new PDO(Config::$url, Config::$user, Config::$password);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
        $pdo->beginTransaction();
        $sql = "DELETE FROM `employes` WHERE ID_Employes = {$_POST["id"]}";
        $pdo->query($sql);
        $pdo->commit();
    }catch(Exception $e){
        $pdo->rollBack();
        echo $e->getMessage();
    }
}
header("Location: home.php");