<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->updateAnnonce();
?>

<p>Mise à jour de l'annonce</p>
<form method="post" action="annonce_update.php" name ="annonceUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="titre">Titre :</label>
    <input type="text" name="brand">
    <br />
    <label for="prix">Prix:</label>
    <input type="text" name="model">
    <br />
    <input type="submit" value="Mettre à jour l'annonce">
</form>

<a href="accueil.php" title="">Retour</a>