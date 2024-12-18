<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.12 - Session, Cookies.");

const SEVEN_DAYS = 604800;


/* */
fullStackPHPClassSession("Cookies", __LINE__);

// create
//setcookie('fsphp', 'my cookie', time() + 3600);

//remove
//setcookie("fsphp", '', time() - 3660);

$cookie = filter_input_array(INPUT_COOKIE, FILTER_DEFAULT);
var_dump($_COOKIE, $cookie);

$timeExpire = time() + SEVEN_DAYS;

$login = [
    'user' => 'user_a',
    'pass' => '123',
    'expire' => $timeExpire,
];

setcookie(
    'fslogin',
    http_build_query($login),
    $timeExpire,
    '/',
    'www.localhost',
    true
);

$login = filter_input(INPUT_COOKIE, 'fslogin', FILTER_DEFAULT);
parse_str($login, $data);

var_dump(
    $login,
    $data
);

/* */
fullStackPHPClassSession("Session", __LINE__);

session_save_path(__DIR__ . "/session");
session_start([
   'cookie_lifetime' => SEVEN_DAYS,
]);

var_dump([
   'id' => session_id(),
   'name' => session_name(),
   'status' => session_status(),
   'save_path' => session_save_path(),
   'cookie' => session_get_cookie_params(),
]);

class User
{
    public string $name = '';
    public string $email = '';
    public string  $expire = '';
    public function __construct(readonly array $array)
    {
        $this->name = $array['user'] ?? '';
        $this->email = $array['email'] ?? '';
        $this->expire = $array['expire'] ?? '';
    }
}

$user = new User([
    'user' => 'user_a',
    'email' => 'mail@mail.com',
    'expire' => time() + SEVEN_DAYS,
]);

//$_SESSION['login'] = $user;
//$_SESSION['user_name'] = $user->name;

var_dump($_SESSION);

session_destroy();
