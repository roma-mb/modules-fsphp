<?php

use src\members\Config;
use src\members\Trigger;

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/src/autoload.php';

fullStackPHPClassName('Class Members');

/** */
fullStackPHPClassSession('constants', __LINE__);

$config = new Config();
$reflection = new ReflectionClass($config);

var_dump([
    $config,
    $reflection,
//    get_class_methods($reflection),
    $reflection->getConstants()
]);

var_dump(
    Config::COMPANY,
    Config::DOMAIN,
    Config::SECTOR,
);

/** */
fullStackPHPClassSession('properties', __LINE__);

Config::$company = 'AC Company';
Config::$domain = 'accompany.com';
Config::$sector = 'Commerce';

//$reflection->setStaticPropertyValue('sector', 'AC Sector');

var_dump([
    $config,
    $reflection->getProperties(),
    $reflection->getDefaultProperties(),
    $reflection->getStaticProperties(),
    Config::$sector
]);

$config::$sector = 'Technology';

/** */
fullStackPHPClassSession('methods', __LINE__);

var_dump(
    $config::$company,
    Config::$domain,
    Config::$sector
);

echo '<hr>';

$config::setConfig('', '', '');
Config::setConfig('Example Company', 'excompany.com', 'Example');

var_dump(
    Config::$company,
    Config::$domain,
    Config::$sector,
);

echo '<hr>';

var_dump(
    $config::$company,
    Config::$domain,
    Config::$sector
);

fullStackPHPClassSession('examples', __LINE__);

echo Trigger::show('trigger');
echo Trigger::show('User message accept', Trigger::ACCEPT);
echo Trigger::show('User message warning', Trigger::WARNING);
echo Trigger::show('User message error', Trigger::ERROR);
