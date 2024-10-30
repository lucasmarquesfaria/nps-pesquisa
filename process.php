<?php
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if (isset($_POST['score'])) {
    $score = (int) $_POST['score'];

    $stmt = $conn->prepare("INSERT INTO responses (score) VALUES (?)");
    $stmt->bind_param("i", $score);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
