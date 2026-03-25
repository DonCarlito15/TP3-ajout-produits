<?php
require "connexion.php";

$ref  = $_POST["reference"];
$des  = $_POST["designation"];
$prix = $_POST["prixunitaire"];
$qte  = $_POST["quantiteStock"];

$sql  = "INSERT INTO produits VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$ref, $des, $prix, $qte])) { 
    echo "<tr id='row_$ref'>
                <td>$ref</td>
                <td>$des</td>
                <td>$prix</td>
                <td>$qte</td>
                <td>
                    <a href='modifier.php?ref=$ref' class='btn btn-warning btn-sm'>Modifier</a>
                    <button class='btn btn-danger btn-sm btnSupprimer' data-ref='$ref'>Supprimer</button>
                </td> 
          </tr>";
} else {
    echo "Erreur lors de l'insertion.";
}
?>