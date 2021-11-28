<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->getAnnonces();
?>

<a href="accueil.php" title="">Retour</a>