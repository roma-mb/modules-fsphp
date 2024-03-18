<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.01 - Autoload");

/** */
fullStackPHPClassSession("autoload spl psr-4", __LINE__);

require __DIR__ . '/src/loading/autoload.php';

$user = new \src\loading\models\User();
$address = new \src\loading\models\Address();
$pointOfSale = new \src\loading\models\PointOfSale();

var_dump([
    $user,
    $address,
    $pointOfSale
]);

/** */
fullStackPHPClassSession("autoload composer psr-4", __LINE__);

require __DIR__ . '/vendor/autoload.php';

$mailer = new \PHPMailer\PHPMailer\PHPMailer();
var_dump(get_class_methods($mailer));
