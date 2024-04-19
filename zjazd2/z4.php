<!DOCTYPE html>
<html>
<body>
    <form method="post" action="">
        <input type="number" name="number" placeholder="Wprowadź liczbę" required>
        <button type="submit">Sprawdź</button>
    </form>
    <?php
    function isPrime($num) {
        if ($num <= 1) {
            return false;
        }
        for ($i = 2; $i <= sqrt($num); $i++) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }
    if (isset($_POST['number'])) {
        $number = intval($_POST['number']);
        if (is_numeric($number) && $number > 0 && is_int($number) ) {
            if (isPrime($number)) {
                echo "$number jest liczbą pierwszą";
            } else {
                echo "$number nie jest liczbą pierwszą";
            }
        } else {
            echo "Wprowadź poprawną liczbę całkowitą dodatnią";
        }
    }
    ?>
</body>
</html>
