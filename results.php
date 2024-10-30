<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "lucas"; 
$dbname = "nps_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$result = $conn->query("SELECT score FROM responses");

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

$scores = [];
while ($row = $result->fetch_assoc()) {
    $scores[] = $row['score'];
}

$conn->close();

// Cálculo do NPS
$promoters = count(array_filter($scores, fn($score) => $score >= 9));
$detractors = count(array_filter($scores, fn($score) => $score <= 6));
$totalResponses = count($scores);
$nps = $totalResponses > 0 ? round((($promoters - $detractors) / $totalResponses) * 100) : null;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa NPS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Resultados da Pesquisa NPS</h2>
        
        <?php if ($totalResponses > 0): ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Total de Respostas</th>
                        <th>Promoters (9-10)</th>
                        <th>Detractors (0-6)</th>
                        <th>NPS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $totalResponses; ?></td>
                        <td><?php echo $promoters; ?></td>
                        <td><?php echo $detractors; ?></td>
                        <td><?php echo $nps !== null ? $nps : 'Sem respostas'; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Não há respostas disponíveis.
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>