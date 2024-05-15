<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'annonce</title>
</head>
<body>
    <!-- Affichage des détails de l'annonce -->
    <h1>Détails de l'annonce</h1>
    <?php foreach($detailsAnnonce as $annonce): ?>
        <h2><?= $annonce['Titre']; ?></h2>
        <p>Description: <?= $annonce['Description']; ?></p>
        <!-- Affichage des photos de l'annonce -->
        <h3>Photos</h3>
        <ul>
            <?php foreach($photosAnnonce as $photo): ?>
                <li><img src="<?= $photo['photo']; ?>" alt="Photo"></li>
            <?php endforeach; ?>
        </ul>
        <!-- Affichage des périodes de réservation disponibles -->
        <h3>Périodes de réservation disponibles</h3>
        <ul>
            <?php foreach($periodesReservation as $periode): ?>
                <li>Date de début: <?= $periode['dateDebut']; ?> - Date de fin: <?= $periode['dateFin']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <!-- Lien pour ajouter des photos -->
    <a href="index.php?action=ajouter_photos&id=<?= $annonce['ID']; ?>">Ajouter des photos</a>
    <!-- Lien pour ajouter une période de réservation -->
    <a href="index.php?action=ajouter_periode&id=<?= $annonce['ID']; ?>">Ajouter une période de réservation</a>
    <!-- Lien pour annuler la réservation -->
    <a href="index.php?action=annuler_reservation&id=<?= $annonce['ID']; ?>">Annuler la réservation</a>
</body>
</html>
