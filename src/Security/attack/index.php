<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("Attack");

session_start();

/*
 *
 */
fullStackPHPClassSession("XXS", __LINE__);

var_dump([
    'filter' => filter_var('<script>alert();</script>', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
]);

/*
 *
 */
fullStackPHPClassSession("CSRF", __LINE__);

//$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = base64_encode(random_bytes(32));

var_dump($_SESSION);

echo "<input type='hidden' name='csrf_token' value='" . ($_SESSION['csrf_token'] ?? '') . "'/>";
