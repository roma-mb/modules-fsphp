<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.08 - Directories");

/* */
fullStackPHPClassSession("Check, create, open.", __LINE__);

$folder = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';
$createdDir = false;

if (!file_exists($folder) || !is_dir($folder)) {
    $createdDir = mkdir($folder, 0775, true);
}

if ($createdDir === false && !is_dir($folder)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $folder));
}

var_dump([
    'scandir' => scandir($folder),
]);

/* */
fullStackPHPClassSession("Copy, rename.", __LINE__);

$file = __DIR__ . DIRECTORY_SEPARATOR . 'file.txt';

var_dump([
    'pathinfo' => pathinfo($file),
    'scandir_file' => scandir($folder),
    'scandir_current' => scandir(__DIR__)
]);

if (!file_exists($file) || !is_dir($folder)) {
    fopen($file, "w");
}

$uploadFile = $folder . DIRECTORY_SEPARATOR . basename($file);

copy($file, $uploadFile);

var_dump(filemtime($file), filemtime($folder . DIRECTORY_SEPARATOR . 'file.txt'));

$newUploadFile = $folder . DIRECTORY_SEPARATOR . time() . '.' . pathinfo($uploadFile)['extension'];
rename($uploadFile, $newUploadFile);

// move file
//rename($file, $newUploadFile);

/* */
fullStackPHPClassSession("Remove, delete", __LINE__);

$dirRemove = __DIR__ . DIRECTORY_SEPARATOR . 'remove';
$files = array_diff(scandir($dirRemove), ['.', '..']);

foreach ($files as $file) {
    $filePath = $dirRemove . DIRECTORY_SEPARATOR . $file;

    if (is_file($filePath)) {
        unlink($filePath);
    }
}

// remove dir
//rmdir($dirRemove);
