<?php
require_once 'includes/db.php';

// 1. On prépare la requête pour TOUT récupérer
// On fait une "JOINTURE" pour avoir le nom de la console au lieu de juste son ID
$sql = "SELECT jeux.*, consoles.nom AS console_nom 
        FROM jeux 
        JOIN consoles ON jeux.console_id = consoles.id";

$stmt = $pdo->query($sql); // Ici on utilise query() car il n'y a pas de variables à sécuriser
$jeux = $stmt->fetchAll(PDO::FETCH_ASSOC); // On transforme le résultat en un tableau PHP

// Calcul du nombre de jeux
$totalJeux = count($jeux);

// Calcul du prix total
$valeurTotale = 0;
$nbComplets = 0;

foreach ($jeux as $j) {
    $valeurTotale += $j['prix'];
    if ($j['complet']) {
        $nbComplets++;
    }
}

// Calcul du pourcentage (si tu as au moins 1 jeu)
$pourcentageComplet = ($totalJeux > 0) ? round(($nbComplets / $totalJeux) * 100) : 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Ludothèque</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Ludothèque</h1>

    <div class="stats-container">
    <div class="stat-card">
        <span class="stat-label">Total Jeux</span>
        <span class="stat-number"><?php echo $totalJeux; ?></span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Valeur Collection</span>
        <span class="stat-number"><?php echo $valeurTotale; ?> €</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Jeux Complets</span>
        <span class="stat-number"><?php echo $pourcentageComplet; ?>%</span>
    </div>
</div>

    <a href="ajouter.php" class="btn-ajouter"> + Ajouter un nouveau jeu</a>

    <table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Titre</th>
            <th>Console</th>
            <th>Année</th>
            <th>Prix</th>
            <th>État</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jeux as $jeu): ?>
        <tr>
            <td>
                <img src="assets/img/<?php echo $jeu['image_path']; ?>" class="img-jeu">
            </td>
            <td><strong><?php echo $jeu['titre']; ?></strong></td>
            <td><?php echo $jeu['console_nom']; ?></td>
            <td><?php echo $jeu['annee']; ?></td>
            <td><?php echo $jeu['prix']; ?> €</td>
            <td>
                <?php if($jeu['complet']): ?>
                    <span class="badge badge-complet">✅ Complet</span>
                <?php else: ?>
                    <span class="badge badge-loose">❌ Non complet</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>