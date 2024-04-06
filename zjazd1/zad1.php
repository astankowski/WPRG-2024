<?php
$owoce = ["jablko", "banan", "pomarancza", "pomidor"];

foreach ($owoce as $owoc) {
    for ($i = strlen($owoc) - 1; $i >= 0; $i--) {
        echo $owoc[$i];
    }
    echo " ".(($owoc[0] == 'p' || $owoc[0] == 'P') ? "Tak" : "Nie")."\n";
}
?>