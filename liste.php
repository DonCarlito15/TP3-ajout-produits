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
            $sql = "SELECT * FROM produits";
            $stmt = $pdo->query($sql);
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <tbody id="listeProduits">
                <?php foreach ($produits as $produit): ?>
                    <tr id="row_<?php echo $produit['reference']; ?>">
                        <td><?php echo $produit['reference']; ?></td>
                        <td><?php echo $produit['designation']; ?></td>
                        <td><?php echo $produit['prixunitaire']; ?></td>
                        <td><?php echo $produit['quantiteStock']; ?></td>
                        <td>
                            <a href="modifier.php?reference=<?php echo $produit['reference']; ?>"
                                class='btn btn-warning btn-sm'>Modifier</a>
                            <button class="btn btn-danger btn-sm btnSupprimer"
                                data-ref="<?php echo $produit['reference']; ?>">Supprimer</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <script>
            //la function fade in and fade out 
            function showAlert(type, message) {
                var msgDiv = document.getElementById("message");
                msgDiv.innerHTML = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;

                // Fade out automatique après 3 secondes
                setTimeout(function () {
                    var alertEl = msgDiv.querySelector(".alert");
                    if (alertEl) {
                        alertEl.classList.remove("show"); // déclenche le fade out Bootstrap
                        setTimeout(function () { alertEl.remove(); }, 500); // supprime après la transition
                    }
                }, 3000);
            }

            //ajouter un produit
            var form = document.getElementById("formProduit");
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                var data = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "ajout.php", true);
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        document.getElementById("listeProduits").innerHTML += xhr.responseText;
                        showAlert("success", "Produit ajouté avec succès !");
                        form.reset();
                    } else {
                        showAlert("danger", "Erreur lors de l'ajout du produit !");
                    }
                };
                xhr.send(data);
            });

            //supprimer un produit
            document.addEventListener("click", function (e) {
                if (e.target.classList.contains("btnSupprimer")) {
                    var ref = e.target.dataset.ref;
                    if (confirm("Supprimer ce produit ?")) {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "supprimer.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onload = function () {
                            if (xhr.responseText == "ok") {
                                document.getElementById("row_" + ref).remove();
                                showAlert("danger", "Produit supprimé avec succès !");
                            } else {
                                showAlert("danger", "Erreur lors de la suppression !");
                            }
                        };
                        xhr.send("reference=" + encodeURIComponent(ref));//evite les bugs avec : espaces / caracteres speciaux/accents
                    }
                }
            });
        </script>
    </div>

    <!-- Bootstrap JS (requis pour fade in/out et btn-close) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jzmkvQ/pGRVbXmUzSuG+MbN6dD9k4"
        crossorigin="anonymous"></script>
</body>

</html>