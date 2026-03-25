<?php
require "connexion.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mise a jour des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <h1>Padrino Store</h1>

    <div class="container">
        <h2 class="mb-4 text-center">Ajouter un produit !</h2>
        <div id="message"></div>

        <form id="formProduit">

            <div class="mb-3">
                <label for="reference" class="form-label">Reference</label>
                <input type="text" class="form-control" name="reference" maxlength="20">

            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" name="designation" maxlength="100">

            </div>
            <div class="mb-3">
                <label for="prixunitaire" class="form-label">Prix Unitaire</label>
                <input type="number" class="form-control" name="prixunitaire">
            </div>
            <div class="mb-3">
                <label for="quantitestock" class="form-label">Quantité en stock</label>
                <input type="number" class="form-control" name="quantitestock">
            </div>

            <button class="btn btn-success w-100">Ajouter</button>
        </form>
        <h2 class="mb-2 mt-4 text-center">Liste des produits</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Reference</th>
                <th>Designation</th>
                <th>Prix</th>
                <th>Quantite</th>
                <th>Actions</th>
            </tr>
            </thead>
            <?php 
            //requete pour recuperer les produits
            $sql = "SELECT * FROM produits";
            $stmt = $pdo -> query($sql);
            $produits = $stmt -> fetchAll(PDO::FETCH_ASSOC);

            ?>
            <tbody id="listeProduits">
                <?php foreach ($produits as $produit): ?>
                    <tr id="row_<?php echo $produit['reference']; ?>">
                        <td><?php echo $produit['reference']; ?></td>
                        <td><?php echo $produit['designation']; ?></td>
                        <td><?php echo $produit['prixunitaire']; ?></td>
                        <td><?php echo $produit['quantiteStock']; ?></td>
                        <td>
                            <a href="modifier.php?reference=<?php echo $produit['reference']; ?>" class = 'btn btn-warning btn-sm'>Modifier</a>
                            <button class="btn btn-danger btn-sm btnSupprimer" data-ref="<?php echo $produit['reference']; ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
            var form=document.getElementById("formProduit");
            form.addEventListener("submit",function(e) 
                {
                e.preventDefault();
                var data = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open("POST","ajout.php",true);
                xhr.onload=function()
                {
                    if(xhr.status==200){
                        document.getElementById("listeProduits").innerHTML+=xhr.responseText;
                        document.getElementById("message").innerHTML='<div class= "alert alert-success">Produit Ajoute !</div>';
                        form.reset();

                    }

                };
                xhr.send(data);
            });

        </script>
    </div>

</body>

</html>