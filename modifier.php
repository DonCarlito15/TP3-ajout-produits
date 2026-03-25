<?php
require "connexion.php";
$ref = $_GET["reference"];
$sql = "SELECT * FROM produits WHERE reference = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$ref]);
$p = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Modifier produit</h2>
    <div class="card">
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="reference" value="<?php echo $p["reference"]; ?>">
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" name="designation" value="<?php echo $p["designation"]; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="prixunitaire" class="form-label">Prix Unitaire</label>
                    <input type="number" step="1" class="form-control" name="prixunitaire"
                        value="<?php echo $p["prixunitaire"]; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantitestock" class="form-label">Quantité en stock</label>
                    <input type="number" class="form-control" name="quantitestock"
                        value="<?php echo $p["quantiteStock"]; ?>" required>
                </div>
                <button class="btn btn-primary">Enregistrer</button>

            </form>
        </div>
    </div>

</body>
</html>