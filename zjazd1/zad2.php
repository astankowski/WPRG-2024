<?php
function czyLiczbaPierwsza($liczba) {
    if ($liczba < 2) return false;
    for ($i = 2; $i * $i <= $liczba; $i++) {
        if ($liczba % $i == 0) return false;
    }
    return true;
}

$zakresOd = 1;
$zakresDo = 100;

for ($i = $zakresOd; $i <= $zakresDo; $i++) {
    if (czyLiczbaPierwsza($i)) {
        echo "$i ";
    }
}
?>