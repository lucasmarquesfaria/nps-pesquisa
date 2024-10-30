<?php
$servername = "localhost";
$username = "root"; // Altere conforme necessário
$password = "lucas"; // Altere conforme necessário
$dbname = "nps_db"; // Altere conforme necessário

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

$conn->close();
?>


<!-- neste tes_db estava testando o BD pois havia um erro de conexão, deixei o mesmo para testes futuros -->