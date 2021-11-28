<?php

use App\Controllers\UsersController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->createAnnonce();

$annonceService = new AnnoncesService();
$annonces = $AnnoncesService->getAnnonce();
?>

<p>Création d'une Annonce</p>
<form method="post" action="annonces_create.php" name ="AnnonceCreateForm">
    <label for="titre">Titre:</label>
    <input type="text" name="titre">
    <br />
    <label for="prix">Prix :</label>
    <input type="text" name="prix">
    <br />
    <label for="users">Utilsateurs :</label>
    <?php foreach ($users as $user): ?>
        <?php $userName = $user->getFirstname() . ' ' . $user->getLastname() . ' ' . $user->getEmail() .' '.$user->getBirthday(); ?>
        <input type="checkbox" name="users[]" value="<?php echo $user->getId(); ?>"><?php echo $userName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer une annonce">
</form>