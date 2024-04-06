<?php
$N = 10;
$fibonacci = [0, 1];

for ($i = 2; $i <= $N; $i++) {
    $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
}

foreach ($fibonacci as $index => $value) {
    if ($value % 2 != 0) {
        echo "$index: $value\n";
    }
}
?>