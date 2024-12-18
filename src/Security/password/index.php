<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("Password");

/*
 *
 */
fullStackPHPClassSession("RFI and DoS.", __LINE__);


$password = password_hash(123456, PASSWORD_DEFAULT);

var_dump([
    'password_hash' => $password,
    'password_get_info' => password_get_info($password),
    'password_needs_rehash' => password_needs_rehash($password, PASSWORD_DEFAULT, ['cost' => 12]),
    'password_verify' => password_verify(123456, $password),
]);
