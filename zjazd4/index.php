<?php
session_start();

if (isset($_POST['submit'])) {
    setcookie('quantity', $_POST['quantity'], time() + 86400, "/");
    setcookie('name', $_POST['name'], time() + 86400, "/");
    setcookie('surname', $_POST['surname'], time() + 86400, "/");
    setcookie('credit_card', $_POST['credit_card'], time() + 86400, "/");
    setcookie('email', $_POST['email'], time() + 86400, "/");
    setcookie('date', $_POST['date'], time() + 86400, "/");
    setcookie('amenities', json_encode(isset($_POST['amenities']) ? $_POST['amenities'] : array()), time() + 86400, "/");
}

if (isset($_POST['clear'])) {
    setcookie('quantity', '', time() - 3600, "/");
    setcookie('name', '', time() - 3600, "/");
    setcookie('surname', '', time() - 3600, "/");
    setcookie('credit_card', '', time() - 3600, "/");
    setcookie('email', '', time() - 3600, "/");
    setcookie('date', '', time() - 3600, "/");
    setcookie('amenities', '', time() - 3600, "/");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$valid_username = "admin";
$valid_password = "password";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['loggedin'] = true;
        setcookie('username', $username, time() + 86400, "/");
    } else {
        $login_error = "Nieprawidłowy login lub hasło.";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formularz Rezerwacji</title>
</head>
<body>
<?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) : ?>
    <h1>Logowanie</h1>
    <?php if (isset($login_error)) : ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Login:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="login">Zaloguj się</button>
    </form>
<?php else : ?>
    <h1>Witaj, <?php echo htmlspecialchars($_COOKIE['username']); ?>!</h1>
    <form method="post" action="">
        <button type="submit" name="logout">Wyloguj się</button>
    </form>

    <h1>Formularz Rezerwacji</h1>
    <form method="post" action="">
        <fieldset>
            <legend>Dane Osobowe</legend>
            <label for="quantity">Ilość osób:</label>
            <select id="quantity" name="quantity">
                <option value="1" <?php if (isset($_COOKIE['quantity']) && $_COOKIE['quantity'] == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_COOKIE['quantity']) && $_COOKIE['quantity'] == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if (isset($_COOKIE['quantity']) && $_COOKIE['quantity'] == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if (isset($_COOKIE['quantity']) && $_COOKIE['quantity'] == 4) echo 'selected'; ?>>4</option>
            </select><br><br>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($_COOKIE['name']) ? htmlspecialchars($_COOKIE['name']) : ''; ?>" required><br><br>
            <label for="surname">Nazwisko:</label>
            <input type="text" id="surname" name="surname" value="<?php echo isset($_COOKIE['surname']) ? htmlspecialchars($_COOKIE['surname']) : ''; ?>" required><br><br>
            <label for="credit_card">Dane karty kredytowej:</label>
            <input type="text" id="credit_card" name="credit_card" value="<?php echo isset($_COOKIE['credit_card']) ? htmlspecialchars($_COOKIE['credit_card']) : ''; ?>" required><br><br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>" required><br><br>
            <label for="date">Data przyjazdu:</label>
            <input type="date" id="date" name="date" value="<?php echo isset($_COOKIE['date']) ? htmlspecialchars($_COOKIE['date']) : ''; ?>" required><br><br>
        </fieldset>

        <fieldset>
            <legend>Udogodnienia</legend>
            <?php
            $amenities = isset($_COOKIE['amenities']) ? json_decode($_COOKIE['amenities']) : array();
            ?>
            <input type="checkbox" id="klima" name="amenities[]" value="klimatyzacja" <?php if (in_array('klimatyzacja', $amenities)) echo 'checked'; ?>>
            <label for="klima">Klimatyzacja</label><br>
            <input type="checkbox" id="ashtray" name="amenities[]" value="popielniczka" <?php if (in_array('popielniczka', $amenities)) echo 'checked'; ?>>
            <label for="ashtray">Popielniczka</label><br>
        </fieldset>
        <br>
        <button type="submit" name="submit">Wyślij</button>
        <button type="submit" name="clear">Wyczyść formularz</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $amenities = isset($_POST['amenities']) ? $_POST['amenities'] : array();
        $errors = array();

        if (isset($_POST['quantity']) && $_POST['quantity'] != '') {
            $quantity = $_POST['quantity'];
        } else {
            $errors[] = "Proszę wybrać ilość osób.";
        }

        if (isset($_POST['name']) && $_POST['name'] != '') {
            $name = $_POST['name'];
        } else {
            $errors[] = "Proszę podać imię.";
        }

        if (isset($_POST['surname']) && $_POST['surname'] != '') {
            $surname = $_POST['surname'];
        } else {
            $errors[] = "Proszę podać nazwisko.";
        }

        if (isset($_POST['credit_card']) && $_POST['credit_card'] != '') {
            $credit_card = $_POST['credit_card'];
        } else {
            $errors[] = "Proszę podać dane karty kredytowej.";
        }

        if (isset($_POST['email']) && $_POST['email'] != '') {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Proszę podać poprawny adres e-mail.";
            }
        } else {
            $errors[] = "Proszę podać adres e-mail.";
        }

        if (isset($_POST['date']) && $_POST['date'] != '') {
            $date = $_POST['date'];
        } else {
            $errors[] = "Proszę podać datę przyjazdu.";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
        } else {
            $summary = "
                    <h1>Rezerwacja</h1>
                    <p>Ilość osób: $quantity</p>
                    <p><b>Dane osoby rezerwującej:</b></p>
                    <p>Imię: $name</p>
                    <p>Nazwisko: $surname</p>
                    <p>Dane karty kredytowej: $credit_card</p>
                    <p>E-mail: $email</p>
                    <p>Data: $date</p>
                    <p>Udogodnienia: ";
            if (!empty($amenities)) {
                $summary .= "<ul>";
                foreach ($amenities as $amenity) {
                    $summary .= "<li>$amenity</li>";
                }
                $summary .= "</ul>";
            } else {
                $summary .= "Brak udogodnień";
            }
            echo $summary;
        }
    }
    ?>
<?php endif; ?>
</body>
</html>
