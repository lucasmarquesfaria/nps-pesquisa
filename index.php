<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa NPS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .nps-container {
            margin-top: 50px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .nps-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .thank-you {
            display: none;
            margin-top: 20px;
        }
        button {
            width: 60px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nps-container text-center">
            <h2>Qual a probabilidade de você nos recomendar a um amigo?</h2>
            <p>0 (Nada provável) - 10 (Muito provável)</p>
            
            <div class="nps-buttons">
                <?php for ($i = 0; $i <= 10; $i++): ?>
                    <button class="btn btn-primary" onclick="submitScore(<?php echo $i; ?>)"><?php echo $i; ?></button>
                <?php endfor; ?>
            </div>
            
            <div class="thank-you alert alert-success" id="thankYouMessage">
                <strong>Obrigado pelo seu feedback!</strong>
            </div>
        </div>
    </div>

    <div class="adm">
        <button class="login">
            
        </button>
    </div>


    <script>
        function submitScore(score) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "process.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.querySelector(".nps-buttons").style.display = "none";
                    document.getElementById("thankYouMessage").style.display = "block";
                }
            };
            xhr.send("score=" + score);
        }
    </script>

    <script src="script.js"></script>
</body>
</html>