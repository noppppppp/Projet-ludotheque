<?php 
require_once 'includes/db.php'; 
$message = "";

if (isset($_POST['valider'])) {
    $titre      = $_POST['titre'];
    $annee      = $_POST['annee'];
    $prix       = $_POST['prix'];
    $console_id = $_POST['console_id'];
    $complet    = isset($_POST['complet']) ? 1 : 0;

    $nom_image   = $_FILES['mon_image']['name']; 
    $source_temp = $_FILES['mon_image']['tmp_name'];
    $destination = "assets/img/" . $nom_image;

    if (move_uploaded_file($source_temp, $destination)) {
        try {
            $sql = "INSERT INTO jeux (titre, annee, prix, complet, image_path, console_id) 
                    VALUES (:t, :a, :p, :c, :img, :con)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                't'   => $titre, 'a' => $annee, 'p' => $prix,
                'c'   => $complet, 'img' => $nom_image, 'con' => $console_id
            ]);
            $message = "<div class='message success'>✅ Jeu ajouté avec succès !</div>";
        } catch (PDOException $e) {
            $message = "<div class='message error'>❌ Erreur : " . $e->getMessage() . "</div>";
        }
    } else {
        $message = "<div class='message error'>⚠️ Erreur lors de l'upload de l'image.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un jeu - Ludothèque</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un nouveau jeu</h1>
        <a href="index.php" class="btn-ajouter">⬅ Retour à la collection</a>

        <?php echo $message; ?>

        <div class="form-container">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Titre du jeu</label>
                    <input type="text" name="titre" placeholder="Ex: Silent Hill 2" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Année</label>
                        <input type="number" name="annee" placeholder="2002">
                    </div>
                    <div class="form-group">
                        <label>Prix</label>
                        <input type="number" step="0.01" name="prix" placeholder="45.00">
                    </div>
                </div>

                <div class="form-group">
                    <label>Console</label>
                    <select name="console_id" required>
                        <option value="1">PlayStation 1</option>
                        <option value="2">PlayStation 2</option>
                        <option value="3">PlayStation 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Photo de la jaquette</label>
                    <input type="file" name="mon_image" accept="image/*" required>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="complet" id="complet" checked>
                    <label for="complet">Le jeu est-il complet ?</label>
                </div>

                <button type="submit" name="valider" class="btn-ajouter" style="width: 100%; border: none; cursor: pointer;">Enregistrer dans la collection</button>
            </form>
        </div>
    </div>
</body>
</html>