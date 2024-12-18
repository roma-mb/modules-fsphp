<?php

use src\config\DataBaseConnection;
use src\Database\connections\source\Providers\Connection;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('Transactions');

fullStackPHPClassSession('transaction', __LINE__);

try {
    $pdo = Connection::getInstance();
    $pdo->beginTransaction();

    $pdo->query("
        insert into users (first_name, last_name, email, document)
        values ('Albert', 'Doe', 'albert.transactiondoe@mail.com', '0000000011');
    ");

    $userId = $pdo->lastInsertId();

    $pdo->query("
        insert into users_address (user_ids, street, number, complement)
        values ({$userId}, 'Transaction Street', '1', 'Transaction');
    ");

    $pdo->commit();

    echo "<p class='trigger accept'>Successful user registration...</p>";

} catch (PDOException | ErrorException $exception){
    $pdo->rollBack();
    var_dump($exception);
}
