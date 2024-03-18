<?php

use src\Database\connections\source\Providers\Connection;
use src\Database\search\Entity\UserEntity;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('Search');

/** */
fullStackPHPClassSession('fetch', __LINE__);

$pdo = Connection::getInstance();
$read = $pdo->query("select * from `users` limit 3");

if(!$read->fetchColumn()) {
  echo "<p class='trigger warning'>No results...</p>";
}

var_dump($read->fetch());

while($user = $read->fetch()) {
    var_dump($user);
}

var_dump($read->fetch());

/** */
fullStackPHPClassSession('fetch all', __LINE__);

$read = $pdo->query("select * from `users` limit 3,2");

foreach($read->fetchAll() as $user) {
    var_dump($user);
}

var_dump($read->fetchAll());

/** */
fullStackPHPClassSession('fetch save', __LINE__);

$read = $pdo->query("select * from `users` limit 5,1");
$users = $read->fetchAll();

var_dump($users, $read->fetchAll());

/** */
fullStackPHPClassSession('fetch types', __LINE__);

$read = $pdo->query("select * from `users` limit 1");
foreach($read->fetchAll() as $user) {
    var_dump($user);
}

$read = $pdo->query("select * from `users` limit 1");
foreach($read->fetchAll(PDO::FETCH_NUM) as $user) {
    var_dump($user);
}

$read = $pdo->query("select * from `users` limit 1");
foreach($read->fetchAll(PDO::FETCH_ASSOC) as $user) {
    var_dump($user);
}

$read = $pdo->query("select * from `users` limit 1");
foreach($read->fetchAll(PDO::FETCH_CLASS, UserEntity::class) as $user) {
    /** @var src\Database\search\Entity\UserEntity $user */
    var_dump($user, $user->getFirstName());
}
