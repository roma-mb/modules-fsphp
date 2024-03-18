<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.06 - Files manipulation");

/* */
fullStackPHPClassSession("Validation.", __LINE__);

$file = __DIR__ . '/example-1.txt';

$exists = (file_exists($file) && is_file($file)) ? 'file exists' : 'file not exists';
echo "<p> {$exists} <p>";

/* */
fullStackPHPClassSession("Read and write", __LINE__);

$file2 = __DIR__ . '/example-2.txt';
$exists = (file_exists($file2) && is_file($file2));

if ($exists) {
    var_dump([
        'file' => file($file2),
        'pathinfo' => pathinfo($file2)
    ]);
}

if (!$exists) {
    $fileOpen = fopen($file2, 'w');
    fwrite($fileOpen, 'Line 01' . PHP_EOL);
    fwrite($fileOpen, 'Line 02' . PHP_EOL);
    fwrite($fileOpen, 'Line 03' . PHP_EOL);
    fwrite($fileOpen, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.' . PHP_EOL);
    fclose($fileOpen);
}

echo "<p>", 'file($file2)[3] => ', file($file2)[3], "<p>";

$open = fopen($file2, 'r');

while (!feof($open)) {
    echo "<p>", fgets($open), "</p>";
}

/* */
fullStackPHPClassSession("get, put, content", __LINE__);

$getContent = __DIR__ . '/example-3.txt';
$exists = (file_exists($getContent) && is_file($getContent));

if (!$exists) {
    $data = "<article><h1>Contact</h1><p>Name: John Doe.</p><p>Mail: mail@mail.com</p><p>Phone: +55</p></article>";
    file_put_contents($getContent, $data);
}

echo file_get_contents($getContent);

if ($exists) {
    unlink($getContent);
}

/* */
fullStackPHPClassSession("include", __LINE__);

$config = __DIR__ . '/config.php';
$arrayConfig = include($config);

var_dump([
    'arrayConfig' => $arrayConfig,
    'config_environment' => $arrayConfig['environment'],
    get_included_files(),
]);
