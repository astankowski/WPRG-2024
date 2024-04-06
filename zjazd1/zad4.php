<?php
$text = explode(" ", "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");

foreach ($text as $index => $value) {
    $ostatniZnak = substr($value, -1);
    if (in_array($ostatniZnak, [',', '.', "'"])) {
        unset($text[$index]);
    }
}

$tablicaAsocjacyjna = [];
foreach ($text as $index => $value) {
    if ($index % 2 == 0) {
        $tablicaAsocjacyjna[$value] = isset($text[$index + 1]) ? $text[$index + 1] : "";
    }
}

foreach ($tablicaAsocjacyjna as $index => $value) {
    echo "$index => $value\n";
}
?>