<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.11 - Urls.");

/* */
fullStackPHPClassSession("Arguments", __LINE__);

echo "<h1><a href='index.php'>Clear</a></h1>";
echo "<p><a href='index.php?arg1=true&arg2=false'>Arguments</a></p>";

$data = [
    'name' => 'John Doe',
    'email' => 'john@doe.com',
    'company' => 'ABC'
];

$arguments = http_build_query($data);

echo "<p><a href='index.php?{$arguments}'>Customer</a></p>";

var_dump($_GET);

/* */
fullStackPHPClassSession("Security", __LINE__);

$dataFilter = http_build_query([
    'name' => 'John Doe',
    'email' => 'john@doe.com',
    'company' => 'ABC',
    'site' => 'https://site.com',
    'script' => "<script>alert('hello');</script>"
]);

parse_str($dataFilter, $data);

var_dump([
    'http_build_query' => $dataFilter,
    'parse_str' => $data
]);

$validate = [
    'name' => FILTER_DEFAULT,
    'email' => FILTER_VALIDATE_EMAIL,
    'company' => FILTER_DEFAULT,
    'site' => FILTER_VALIDATE_DOMAIN,
    'script' => FILTER_SANITIZE_SPECIAL_CHARS,
];

$ret = filter_var_array($data, $validate);

$ret['special_chars'] = htmlspecialchars($data['script']);
$ret['strip_tags'] = strip_tags($data['script']);

var_dump($ret);
