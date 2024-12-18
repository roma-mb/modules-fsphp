<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.10 - Files upload.");

/* */
fullStackPHPClassSession("request GET", __LINE__);

include('form.php');

$storageDir = __DIR__ . '/storage';

if(!file_exists($storageDir) || !is_dir($storageDir)) {
    mkdir($storageDir, 0775);
}

echo "<p>SIZE</p>";
var_dump([
    'file_size' => ini_get('upload_max_filesize'),
    'post_size' => ini_get('post_max_size'),
]);

echo "<p>FILE TYPE</p>";

$indexDir = __DIR__ . '/index.php';

var_dump([
    'file_type' => filetype($indexDir),
    'mime_content_type' => mime_content_type($indexDir),
]);

echo "<p>SCAN DIR</p>";
var_dump(scandir($storageDir));

$isPost = filter_input(INPUT_GET, 'post', FILTER_VALIDATE_BOOLEAN);
$hasFile = $_FILES && !empty($_FILES['file']['name']);

$validate = [
    'file_is_too_large' => ($isPost && !$_FILES),
    'has_no_file' => ($isPost && !$hasFile && $_FILES),
    'refresh' => (!$isPost && !$_FILES)
];

$messages = [
    'file_is_too_large' => "<p class='trigger warning'>Whoops, it looks like the file is large.</p>",
    'has_no_file' => "<p class='trigger warning'>Please, select a file before uploading.</p>",
    'default_error' => "<p class='trigger warning'>Something went wrong.</p>",
    'success' => "<p class='trigger success'>File uploaded successfully.</p>",
    'refresh' => ''
];

$keyError = array_search(true, $validate, true);

if($keyError) {
    echo $messages[$keyError] ?? "<p class='trigger warning'>Something went wrong.</p>";
    die();
}

const ALLOWED_FILE_TYPES = [
    'txt' => 'text/plain',
    'flv' => 'video/x-flv',
    'png' => 'image/png',
    'jpe' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'gif' => 'image/gif',
    'mp3' => 'audio/mpeg',
    'pdf' => 'application/pdf'
];

$file = $_FILES['file'];

$acceptMimeType = in_array($file['type'], ALLOWED_FILE_TYPES, true);

if ($acceptMimeType === false) {
    echo "<p class='trigger warning'>File type not accepted.</p>";
    die();
}

$pathToSave = __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR;
$newFileName = time() . mb_strstr($file['name'], '.');
$movedFile = move_uploaded_file($file['tmp_name'], $pathToSave . $newFileName);

echo $movedFile
    ? $messages['success']
    : $messages['default_error'];
