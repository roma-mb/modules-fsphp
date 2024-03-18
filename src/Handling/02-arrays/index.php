<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName('03.03 - Array functions');

/*
 * [ create ] https://php.net/manual/pt_BR/ref.array.php
 */
fullStackPHPClassSession('handling', __LINE__);

$index = [
    "id",
    "name",
    "user",
];

$assoc = [
    "id" => '123',
    "name" => "John Doe",
    "user" => "johndoe",
];

array_unshift($index, 'array_unshift', 'id_role');

$merge = ['mail' => 'mail@mail.com', 'phone' => '+5511999999999'];
$assoc += $merge;
//$assoc = [...$assoc, ...$merge];

array_push($index, 'array_push');
$assoc += ['address' => 'St. 123'];

array_shift($index);
array_shift($assoc);

array_pop($index);
array_pop($assoc);

array_unshift($index, null);

$index = array_filter($index);
$assoc = array_filter($assoc);

var_dump(
    $index,
    $assoc
);

/*
 * [ ordering ] reverse | asort | ksort | sort
 */
fullStackPHPClassSession('ordering', __LINE__);

$index = array_reverse($index);
$assoc = array_reverse($assoc);

asort($index);
asort($assoc);

echo "<p>[asort]</p>";
var_dump(
    $index,
    $assoc
);

ksort($index);

echo "<p>[ksort]</p>";
var_dump($index);

krsort($index);

echo "<p>[krsort]</p>";
var_dump($index);

sort($index);

echo "<p>[sort]</p>";
var_dump($index);

rsort($index);

echo "<p>[rsort]</p>";
var_dump($index);

/*
 * [ verification ]  keys | values | in | explode
 */
fullStackPHPClassSession('verification', __LINE__);

var_dump(
    [
        array_keys($assoc),
        array_values($assoc)
    ]
);

if (in_array('johndoe', $assoc)) {
    echo "<p>| User | johndoe |</p>";
}

$arrToString = implode(', ', $assoc);
echo "<p>| Customer | {$arrToString} |</p>";

echo "<p>[explode]</p>";
var_dump(explode(', ', $arrToString));

/**
 * [ practical example ] template view | implode
 */
fullStackPHPClassSession('practical example', __LINE__);

$profile = [
    'name' => 'Jane doe',
    'company' => 'Abc Company',
    'mail' => 'jane.doe@maiil.com'
];

$template = <<<TPL
   <article>
      <h1>{{name}}</h1>
      <p>{{company}}<br>
      <a href="mailto:{{mail}}" title="send to {{name}}">Send e-mail</a></p>
   </article>
TPL;

echo $template;

echo str_replace(
    array_keys($profile), array_values($profile), $template
);

$replaces = '{{' . implode('}}&{{', array_keys($profile)) . '}}';

echo str_replace(
    explode("&", $replaces),
    array_values($profile),
    $template
);
