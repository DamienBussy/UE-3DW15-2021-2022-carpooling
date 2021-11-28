<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->getReservations();

?>
<br><br>
<a href="accueil.php" title="">Retour</a>