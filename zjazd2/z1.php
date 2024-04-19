<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form method="post" action="">
        <input type="number" name="num1" placeholder="Wprowadź liczbę 1" required>
        <select name="operator">
            <option value="add">Dodawanie</option>
            <option value="subtract">Odejmowanie</option>
            <option value="multiply">Mnożenie</option>
            <option value="divide">Dzielenie</option>
        </select>
        <input type="number" name="num2" placeholder="Wprowadź liczbę 2" required>
        <button type="submit" name="calculate">Oblicz</button>
    </form>

    <?php
    if (isset($_POST['calculate'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];
        switch ($operator) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    echo "Nie można dzielić przez zero!";
                }
                break;
            default:
                echo "Błąd!";
                break;
        }
        echo "<h1>Wynik: $result</h1>";
    }
    ?>
</body>
</html>
