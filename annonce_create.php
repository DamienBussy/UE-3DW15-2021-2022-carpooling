<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->createAnnonce();
?>

<p>Création d'une Annonce</p>
<form method="post" action="annonces_create.php" name ="AnnonceCreateForm">
    <label for="titre">Titre:</label>
    <input type="text" name="titre">
    <br />
    <label for="prix">Prix :</label>
    <input type="text" name="prix">
    <br />
    <input type="submit" value="Créer une annonce">
</form>