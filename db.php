<?php
$conn = new mysqli("localhost", "tomasz", "twojehaslo", "dwuklan");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>