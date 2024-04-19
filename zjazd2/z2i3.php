<!DOCTYPE html>
<html>
<body>
    <h1>Formularz Rezerwacji</h1>
    <form method="post" action="">
        <fieldset>
            <legend>Dane Osobowe</legend>
            <label for="quantity">Ilość osób:</label>
            <select id="quantity" name="quantity">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br><br>
			<?php
			$guests = isset($_POST['guests']) ? $_POST['guests'] : 0;
			for ($i = 1; $i < $guests + 3; $i++) {
				echo '
					<p>Dane osoby '.$i.'</p>
					<label for="name">Imię:</label>
					<input type="text" id="name" name="name" required><br><br>
					<label for="surname">Nazwisko:</label>
					<input type="text" id="surname" name="surname" required><br><br>
					';
			}
			?>
            <label for="credit_card">Dane karty kredytowej:</label>
            <input type="text" id="credit_card" name="credit_card" required><br><br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="date">Data przyjazdu:</label>
            <input type="date" id="date" name="date" required><br><br>
        </fieldset>
        
        <fieldset>
            <legend>Udogodnienia</legend>
            <input type="checkbox" id="klima" name="amenities[]" value="klimatyzacja">
            <label for="klima">Klimatyzacja</label><br>
            <input type="checkbox" id="ashtray" name="amenities[]" value="popielniczka">
            <label for="ashtray">Popielniczka</label><br>
        </fieldset>
		<br>
        <button type="submit" name="submit">Wyślij</button>
    </form>

    <?php
	if (isset($_POST['submit'])) {
        $amenities = isset($_POST['amenities']) ? $_POST['amenities'] : array();
		
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
</body>
</html>
