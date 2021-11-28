<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->updateReservation();

?>

<p>Edition d'une réservation</p>
<form method="post" action="reservations_update.php" name ="reservationUpdateForm">
    <label for="id">ID :</label>
    <input type="text" name="id">
    <br />
    <label for="nameReservation">Titre :</label>
    <input type="text" name="nameReservation">
    <br />
    <label for="firstDate">Date de début de réservation au format dd-mm-yyyy :</label>
    <input type="text" name="firstDate">
    <br />
    <label for="endDate">Date de fin de réservation au format dd-mm-yyyy :</label>
    <input type="text" name="endDate">
    <br />
    <input type="submit" value="Editer la réservation">
</form>