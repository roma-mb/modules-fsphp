<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';
require __DIR__ . '/src/autoload.php';

fullStackPHPClassName("04.05 - Obj Relationship");

/** */
fullStackPHPClassSession('Association', __LINE__);

$address = new \App\related\Address('Street A', 254, 'C1');
$company = new \App\related\Company('Company A', $address, ['USER_A'], []);

var_dump($company);

/** */
fullStackPHPClassSession('Aggregation', __LINE__);

$address = new \App\related\Address('Street B', 254, 'C2');
$company = new \App\related\Company('Company B', $address, ['USER_B'], []);

$productA = new \App\related\Product('Product A', 154.50);
$productB = new \App\related\Product('Product B', 600.50);

$company->addProduct($productA);
$company->addProduct($productB);

var_dump($company);

/** */
fullStackPHPClassSession('Composition', __LINE__);

$company = new \App\related\Company('Company C', $address, [], []);
$company->addTeam('developer', 'John', 'Doe');
$company->addTeam('developer', 'Mary', 'Doe');

var_dump($company);
