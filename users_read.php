<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->getUsers();
?>
<BR></BR>
<a href="accueil.php" title="">Retour</a>