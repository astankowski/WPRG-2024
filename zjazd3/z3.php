<?php
function manageDirectory($path, $dirname, $operation = 'read') {
    $full_path = $path . "/" . $dirname;

    if ($operation === 'read') {
        if (is_dir($full_path)) {
            $files = scandir($full_path);
            echo "<p>Zawartość katalogu $dirname:</p>";
            echo "<ul>";
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo "<li>$file</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p>Katalog $dirname nie istnieje.</p>";
        }
    } elseif ($operation === 'delete') {
        if (is_dir($full_path)) {
            if (count(scandir($full_path)) == 2) {
                if (rmdir($full_path)) {
                    echo "<p>Katalog $dirname został pomyślnie usunięty.</p>";
                } else {
                    echo "<p>Nie udało się usunąć katalogu $dirname.</p>";
                }
            } else {
                echo "<p>Katalog $dirname nie jest pusty.</p>";
            }
        } else {
            echo "<p>Katalog $dirname nie istnieje.</p>";
        }
    } elseif ($operation === 'create') {
        if (!is_dir($full_path)) {
            if (mkdir($full_path, 0777, true)) {
                echo "<p>Katalog $dirname został pomyślnie utworzony.</p>";
            } else {
                echo "<p>Nie udało się utworzyć katalogu $dirname.</p>";
            }
        } else {
            echo "<p>Katalog $dirname już istnieje.</p>";
        }
    } else {
        echo "<p>Nieprawidłowa operacja.</p>";
    }
}

if(isset($_POST['submit'])) {
    $path = $_POST['path'];
    $dirname = $_POST['dirname'];
    $operation = $_POST['operation'];
    manageDirectory($path, $dirname, $operation);
}
?>
<!DOCTYPE html>
<html>
<body>
    <form method="POST">
        <label for="path">Podaj ścieżkę:</label>
        <input type="text" id="path" name="path">
        <label for="dirname">Podaj nazwę katalogu:</label>
        <input type="text" id="dirname" name="dirname">
        <label for="operation">Wybierz operację:</label>
        <select id="operation" name="operation">
            <option value="read">Odczyt</option>
            <option value="delete">Usuwanie</option>
            <option value="create">Tworzenie</option>
        </select>
        <button type="submit" name="submit">Wykonaj</button>
    </form>
</body>
</html>
