<?php
function factorialRec($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorialRec($n - 1);
    }
}

function factorialIterative($n) {
    $result = 1;
    for ($i = 1; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

if(isset($_GET['number'])) {
    $number = $_GET['number'];
	
    $start_factorial = microtime(true);
    $result_factorial = factorialRec($number);
    $end_factorial = microtime(true);
    $time_factorialRec = ($end_factorial - $start_factorial) * 1000;

    $start_factorialIterative = microtime(true);
    $result_factorialIterative = factorialIterative($number);
    $end_factorialIterative = microtime(true);
    $time_factorialIterative = ($end_factorialIterative - $start_factorialIterative) * 1000;

    echo "<p>Silnia z $number wynosi $result_factorial. Czas wykonania rekurencyjnie: $time_factorialRec sekund.</p>
	<p>Czas wykonania iteracyjnie wynosi: $time_factorialIterative sekund.</p>";
	if ($time_factorialIterative < $time_factorialRec) {
		echo "<p>Funkcja iteracyjna działa o " . $time_factorialRec - $time_factorialIterative . " szybciej</p>";
	} else {
		echo "<p>Funkcja rekurencyjna działa o " . $time_factorialIterative - $time_factorialRec . " szybciej</p>";
	}
}
?>
<!DOCTYPE html>
<html>
<body>
    <form method="GET">
        <label for="number">Podaj liczbę:</label>
        <input type="number" id="number" name="number">
        <button type="submit">Wyślij</button>
    </form>
</body>
</html>
