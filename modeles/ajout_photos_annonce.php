<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des photos pour l'annonce</title>
</head>
<body>
    <h1>Ajouter des photos pour l'annonce</h1>
    <!-- Formulaire d'ajout de photos -->
    <form action="index.php?action=ajouter_photos" method="POST" enctype="multipart/form-data">
        <input type="file" name="photos[]" multiple accept="image/*">
        <button type="submit">Télécharger</button>
    </form>
</body>
</html>
