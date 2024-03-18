<?php


use src\config\DataBaseConnection;
use src\Database\connections\source\Providers\Connection;


require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/../../autoload.php';

fullStackPHPClassName('PDO Connections');

fullStackPHPClassSession('errors', __LINE__);

try {
//    throw new \RuntimeException('Exception');
    throw new \PDOException('PDO Exception');
} catch (PDOException | ErrorException $exception){
    var_dump($exception);
} catch (Exception $exception) {
    var_dump($exception->getMessage());
} finally {
    echo "<h1 class='trigger error'>Finally</h1>";
}

/** */
fullStackPHPClassSession('php data object', __LINE__);

try {
    $sqliteFilePath = DataBaseConnection::SQLITE_FULLSTACK_FILE_PATH->value;

    $pdo = new PDO("sqlite:file:{$sqliteFilePath}?mode=rwc",
        null,
        null,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,]
    );

    $stmt = $pdo->query("SELECT * FROM users LIMIT 2");

    while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
        var_dump($user);
    }
} catch (PDOException $exception) {
    var_dump($exception->getMessage());
}


fullStackPHPClassSession('singleton connection', __LINE__);

$pdo1 = Connection::getInstance();
$pdo2 = Connection::getInstance();

var_dump(
    $pdo1,
    $pdo2,
    Connection::getInstance()::getAvailableDrivers(),
    Connection::getInstance()->getAttribute(PDO::ATTR_DRIVER_NAME),
);

