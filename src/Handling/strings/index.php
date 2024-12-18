<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';

fullStackPHPClassName("03.02 - Funções para strings");

/*
 * [ strings e multibyte ] https://php.net/manual/en/ref.mbstring.php
 */
fullStackPHPClassSession("strings and multibyte", __LINE__);

$string = "It's, á Contrary to popular belief,";

var_dump([
    "string" => $string,
    "strlen" => strlen($string),
    "mb_strlen" => mb_strlen($string),
    "substr" => substr($string, "9"),
    "mb_substr" => mb_substr($string, "9"),
    "strtoupper" => strtoupper($string),
    "mb_strtoupper" => mb_strtoupper($string),
]);

/**
 * [ conversão de caixa ] https://php.net/manual/en/function.mb-convert-case.php
 */
fullStackPHPClassSession("box convertion", __LINE__);

$mbString = $string;

var_dump([
    "mb_strtoupper" => mb_strtoupper($mbString),
    "mb_strtolower" => mb_strtolower($mbString),
    "mb_convert_case MB_CASE_UPPER" => mb_convert_case($mbString, MB_CASE_UPPER),
    "mb_convert_case MB_CASE_LOWER" => mb_convert_case($mbString, MB_CASE_LOWER),
    "mb_convert_case MB_CASE_TITLE" => mb_convert_case($mbString, MB_CASE_TITLE),
]);

/**
 * [ substituição ] multibyte and replace
 */
fullStackPHPClassSession("substitution", __LINE__);

$mbReplace = $mbString . " Lorem Ipsum is not simply random text.";

var_dump([
    'full_text' => $mbReplace,
    "mb_strlen" => mb_strlen($mbReplace),
    "mb_strpos" => mb_strpos($mbReplace, ", "),
    "mb_strrpos" => mb_strrpos($mbReplace, ", "),
    "mb_substr" => mb_substr($mbReplace, 34 + 2, 14),
    "mb_strstr" => mb_strstr($mbReplace, ", ", true),
    "mb_strrchr" => mb_strrchr($mbReplace, ", ", true)
]);

$mbStrReplace = $string;

echo "<p>", $mbStrReplace, "</p>";
echo "<p>", str_replace("It's, á ", "# ", $mbStrReplace), "</p>";
echo "<p>", str_replace(["It's, á ", " belief"], "#", $mbStrReplace), "</p>";
echo "<p>", str_replace(["It's, á ", " belief"], ["# ", " see"], $mbStrReplace), "</p>";

$article = <<<EVENT
   <article>
      <h3>event</h3>
      <p>desc</p>
   </article>
EVENT;

$articleData = [
    "event" => "Lorem Ipsum",
    "desc" => $mbReplace
];

echo str_replace(array_keys($articleData), array_values($articleData), $article);

/**
 * [ parse string ] parse_str | mb_parse_str
 */
fullStackPHPClassSession("parse string", __LINE__);

$url = "name=Jhon&email=jhon.doe@mail.com";
mb_parse_str($url, $parseEndPoint);

var_dump([
    $url,
    $parseEndPoint,
    (object)$parseEndPoint
]);

