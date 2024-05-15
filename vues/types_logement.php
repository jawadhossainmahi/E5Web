<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types de logement</title>
</head>
<body>
    <h1>Types de logement</h1>
    <!-- Affichage des types de logement -->
    <ul>
        <?php foreach($typesLogement as $type): ?>
            <li><?= $type['nom']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
