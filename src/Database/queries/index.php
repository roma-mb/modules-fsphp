<?php

use src\config\DataBaseConnection;
use src\Database\connections\source\Providers\Connection;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('Queries');

fullStackPHPClassSession('insert', __LINE__);

$insert = "
    insert into users (first_name, last_name, email, document)
    values ('Albert', 'Doe', 'albert.doe.insert@mail.com', '0000000011');
";

try {
//    Connection::getInstance()->exec($insert);
    $query = Connection::getInstance()->query('$insert');

    var_dump(
        Connection::getInstance()->lastInsertId(),
        $query->errorInfo()
    );

} catch (PDOException | ErrorException $exception){
    var_dump($exception);
}

/** */
fullStackPHPClassSession('select', __LINE__);

try {
    $query = Connection::getInstance()->query("select * from users order by id desc limit 2");
    var_dump([
       $query->columnCount(),
       $query->rowCount(),
       $query->fetchAll(),
       $query->fetch(),
    ]);
} catch (PDOException | ErrorException $exception){
    var_dump($exception);
}

fullStackPHPClassSession('update', __LINE__);

try {
    $exec = Connection::getInstance()->exec(
        "update users set first_name = 'UPDATE', last_name = 'UPDATE' where id = '11'"
    );

    var_dump($exec);
} catch (PDOException | ErrorException $exception){
    var_dump($exception);
}

fullStackPHPClassSession('delete', __LINE__);

try {
    $exec = Connection::getInstance()->exec(
        "delete from users where id > '11'"
    );

    var_dump($exec);
} catch (PDOException | ErrorException $exception){
    var_dump($exception);
}
