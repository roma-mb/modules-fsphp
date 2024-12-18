<?php

use src\Database\models\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('Models');

fullStackPHPClassSession('layer', __LINE__);

$reflection = new ReflectionClass(User::class);

var_dump([
    $reflection->getFileName(),
    $reflection->getDefaultProperties(),
    $reflection->getMethods(),
]);

fullStackPHPClassSession('load', __LINE__);

$user = new User();
$result = $user->load(1);

var_dump($result->first_name);

fullStackPHPClassSession('find', __LINE__);

$user = new User();
$result = $user->find(email: 'matt.doe@mail.com');

var_dump($result->first_name);

fullStackPHPClassSession('all', __LINE__);

$user = new User();
$results = $user->all();

var_dump($results);

fullStackPHPClassSession('bootstrap', __LINE__);

$user = new User();

$results = $user->bootstrap([
    'first_name' => 'Robert',
    'last_name' => 'Doe',
    'email' => 'robert.doe.bootstrap13@mail.com',
    'document' => '12345678974'
]);

var_dump($results);

fullStackPHPClassSession('create', __LINE__);

$hasUser = $results->find($results->email);

if(!$hasUser) {
    echo "<p class='trigger warning'>Create</p>";
    $results->save();
}

if($hasUser) {
    echo "<p class='trigger accept'>Read</p>";
}

var_dump($hasUser);

fullStackPHPClassSession('save, update', __LINE__);

$model = new User();
$user = $model->load(3);
$user->first_name = 'First name update';
$user->last_name = 'Last name update';
$user->email = 'email.test.update@email.com';
$user->save();

var_dump($user->email);

fullStackPHPClassSession('destroy', __LINE__);

$model = new User();
$user = $model->load(2);

if($user) {
    $user = $user->destroy();
}

var_dump($user);
