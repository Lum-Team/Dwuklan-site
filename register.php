<?php
session_start();
include("db.php"); // połączenie z bazą danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "Uzupełnij wszystkie pola!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed);

        if ($stmt->execute()) {
            echo "<p>Konto utworzone! <a href='login.php'>Zaloguj się</a></p>";
        } else {
            echo "<p>Błąd: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vikaln - Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="top">
        <a href="index.html" id="main">DwuKlan Vlog</a>
        <div class="links">
            <a href="https://open.spotify.com/">Spotify</a>
            <a href="about.html">O nas</a>
            <a href="login.php">Zaloguj się</a>
        </div>
    </nav>
    
    <div class="formula">
        <h1>Załóż konto</h1>

        <form method="post" action="">
            <h4>Login</h4>
            <input type="text" name="username" required>

            <h4>Hasło</h4>
            <input type="password" name="password" required>

            <div class="loreg">
                <button type="submit" id="loreg">Zarejestruj się</button>
                <a href="login.php">Zaloguj się</a>
            </div>
        </form>
    </div>
</body>
</html>
