<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.09 - Filters and forms.");

/* */
fullStackPHPClassSession("request GET", __LINE__);

class Form
{
    public string $method = '';
    public string $name = '';
    public string $email = '';
}

$form = new Form();
$form->method = "GET";
$form->name = 'Jhon Doe';
$form->email = 'mail';

include('form.php');

echo '<p>$_GET</p>';
var_dump($_GET);

echo '<p>$_REQUEST</p>';
var_dump($_REQUEST);

/* */
fullStackPHPClassSession("POST", __LINE__);

$form->method = "POST";
include('form.php');

echo '<p>$_POST</p>';
var_dump($_POST);

$filterInput = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
$filterInputArray = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!$filterInputArray) {
    echo "<p class='trigger warning'>No data sent.</p>";
    die();
}

var_dump([
   'filter_input' => $filterInput,
   'filter_input_array' => $filterInputArray
]);

$messages = [
    'name' => "<p class='trigger warning'>Name is required.</p>",
    'email' => "<p class='trigger warning'>Email provided is not valid.</p>",
    'success' => "<p class='trigger accept'>Your registration has been successfully.</p>"
];

$validate = [
  'email' => FILTER_VALIDATE_EMAIL,
];

// validate 1
//foreach($filterInputArray as $key => $value) {
//    $filter = $validate[$key] ?? FILTER_DEFAULT;
//    $fail = !filter_var($value, $filter);
//
//    if($fail) {
//        echo $messages[$key] ?? "<p class='trigger warning'>Please, check the field :$key and try again.</p>";
//        die();
//    }
//}

$validate['name'] = FILTER_DEFAULT;
$inputPostArray = filter_input_array(INPUT_POST, $validate);

// validate 2
foreach($inputPostArray as $key => $value) {
    if(empty($value)) {
        echo $messages[$key] ?? "<p class='trigger warning'>Please, check the field :$key and try again.</p>";
        die();
    }
}

echo "<hr>";

$striped = array_map('strip_tags', $filterInputArray);
$dataToSave = array_map('trim', $striped);
var_dump($dataToSave);

echo $messages['success'];

fullStackPHPClassSession("filters", __LINE__);

var_dump([
    filter_list(),
    [
        FILTER_VALIDATE_EMAIL,
        filter_id('validate_email')
    ]
]);

$string = 'Will convert both "double" and single quotes.';
var_dump(htmlspecialchars($string, ENT_QUOTES, 'UTF-8'));

var_dump([
    'filter_input_array' => $inputPostArray,
]);

$inputPostArray['email'] = 'mail_error';

var_dump([
    'filter_var _array' => filter_var_array($inputPostArray, $validate),
]);
