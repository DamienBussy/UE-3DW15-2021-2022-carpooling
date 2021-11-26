<?php

use App\Controllers\ReservationsController;
use App\Services\UsersService;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();

$usersService = new UsersService();
$users = $usersService->getUsers();

?>

<p>Création d'une reservation</p>
<form method="post" action="reservations_create.php" name ="reservationCreateForm">
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
    <label for="users">Utilisateurs :</label><br>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une réservation">
</form>