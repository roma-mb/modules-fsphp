<?php

use src\config\DataBaseConnection;
use src\Database\connections\source\Providers\Connection;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('Statement');

fullStackPHPClassSession('prepared', __LINE__);

$stmt = Connection::getInstance()->prepare('select * from `users` where id = 5');
$stmt->execute();

var_dump(
    $stmt,
    $stmt->rowCount(),
    $stmt->columnCount(),
    $stmt->fetch(),
);

fullStackPHPClassSession('statement bind value', __LINE__);

$insert = "
    insert into users (first_name, last_name, email, document)
    values (?, ?, ?, ?);
";

$stmt = Connection::getInstance()->prepare($insert);
$stmt->bindValue(1, 'Statement', PDO::PARAM_STR);
$stmt->bindValue(2, 'Bind Value', PDO::PARAM_STR);
$stmt->bindValue(3, 'test.doe@mail.com', PDO::PARAM_STR);
$stmt->bindValue(4, '000', PDO::PARAM_STR);

$stmt->execute();
var_dump($stmt->rowCount());

echo "<hr>";

$insert = "
    insert into users (first_name, last_name, email, document)
    values (:first_name, :last_name, :email, :document);
";

$stmt = Connection::getInstance()->prepare($insert);
$stmt->bindValue(':first_name', 'Statement', PDO::PARAM_STR);
$stmt->bindValue(':last_name', 'Bind Value link names', PDO::PARAM_STR);
$stmt->bindValue(':email', 'test.doe@mail.com', PDO::PARAM_STR);
$stmt->bindValue(':document', '001', PDO::PARAM_STR);

$stmt->execute();
var_dump($stmt->rowCount());

fullStackPHPClassSession('stmt bind param', __LINE__);

$insert = "
    insert into users (first_name, last_name, email, document)
    values (:first_name, :last_name, :email, :document);
";

$firstName = 'Statement';
$lastName = 'Bind Param';
$email = 'test.doe@mail.com';
$document = '002';

$stmt = Connection::getInstance()->prepare($insert);
$stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
$stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':document', $document, PDO::PARAM_STR);

$stmt->execute();
var_dump($stmt->rowCount());


fullStackPHPClassSession('stm execute array', __LINE__);

$insert = "
    insert into users (first_name, last_name, email, document)
    values (:first_name, :last_name, :email, :document);
";

$user = [
  'first_name' => 'Statement',
  'last_name' => 'Exec array',
  'email' => 'test.doe@mail.com',
  'document' => '003',
];

$stmt = Connection::getInstance()->prepare($insert);
$stmt->execute($user);
var_dump($stmt->rowCount());

fullStackPHPClassSession('bind column', __LINE__);

$stmt = Connection::getInstance()->prepare('select * from `users` limit 3');
$stmt->execute();

$stmt->bindColumn('first_name', $firstName, PDO::PARAM_STR);
$stmt->bindColumn('last_name', $lastName, PDO::PARAM_STR);

while ($user = $stmt->fetch()) {
    var_dump(
        "Full name: {$firstName} {$lastName}",
        $user
    );
}

