<?php
// Ustawienia bazy danych
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'zad5';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

$sql = "SELECT id, name, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Użycie mysqli_fetch_row:<br>";
    $result->data_seek(0);
    while ($row = mysqli_fetch_row($result)) {
        echo "ID: $row[0], Name: $row[1], Email: $row[2]<br>";
    }

    echo "<br>Użycie mysqli_fetch_array:<br>";
    $result->data_seek(0);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Email: " . $row['email'] . "<br>";
    }

    echo "<br>Liczba wierszy w wyniku: " . mysqli_num_rows($result) . "<br>";
} else {
    echo "Brak wyników";
}

$insert_sql = "INSERT INTO users (name, email) VALUES ('Jan Kowalski', 'jan.kowalski@example.com')";
if ($conn->query($insert_sql) === TRUE) {
    echo "Nowy rekord został pomyślnie dodany<br>";
} else {
    echo "Błąd: " . $insert_sql . "<br>" . $conn->error;
}

$conn->close();
?>
