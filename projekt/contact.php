<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Contact</h1>
    <form action="contact.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea><br>
        <input type="submit" value="Send Message">
    </form>
</body>
</html>
