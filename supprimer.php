<?php
require "connexion.php";
$ref = $_POST["reference"];
$sql = "DELETE FROM produits WHERE reference = ?";
$stmt = $pdo->prepare($sql);
if ($stmt->execute([$ref])) {
    echo "ok";
}
?>