<!DOCTYPE html>
<html>
<body>
    <form method="GET">
        <label for="birthdate">Podaj datę urodzenia:</label>
        <input type="date" id="birthdate" name="birthdate">
        <button type="submit">Wyślij</button>
    </form>

    <?php
	function getDayOfWeek($date) {
		return date('l', $date);	
	}
	
	function getAge($date) {
		return date('Y') - date('Y', $date);
	}
	
	function getDaysUntilNextBirthday($date) {
	$next_birthday = date('Y') . '-' . date('m-d', $date);
    if ($next_birthday < date('Y-m-d')) {
        $next_birthday = (date('Y') + 1) . '-' . date('m-d', $date);
    }
	
    return ceil((strtotime($next_birthday) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
	}
	
    if(isset($_GET['birthdate'])) {
        $birthdate = strtotime($_GET['birthdate']);
        echo "<p>Urodziłeś się w dniu: " . getDayOfWeek($birthdate) . "</p>";
        echo "<p>Masz obecnie " . getAge($birthdate) . " lat/a</p>";
        echo "<p>Do Twoich kolejnych urodzin pozostało " . getDaysUntilNextBirthday($birthdate) . " dni</p>";
	}
    ?>
</body>
</html>
