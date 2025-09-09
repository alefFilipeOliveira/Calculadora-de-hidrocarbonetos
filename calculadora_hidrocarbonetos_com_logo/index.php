<?php
// Verificação se houve envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pegando valores do formulário
    $classe = $_POST['classe'];
    $c = intval($_POST['carbonos']);
    $h = intval($_POST['hidrogenios']);

    // Função para calcular hidrogenios conforme a classe
    function calcularHidrocarbonetos($classe, $c, $h) {
        switch ($classe) {
            case 'alcano': // fórmula geral CnH2n+2
                $h = 2 * $c + 2;
                break;
            case 'alceno': // fórmula geral CnH2n
                $h = 2 * $c;
                break;
            case 'alcino': // fórmula geral CnH2n-2
                $h = 2 * $c - 2;
                break;
            case 'cicloalcano': // fórmula geral CnH2n
                $h = 2 * $c;
                break;
            case 'cicloalceno': // fórmula geral CnH2n-2
                $h = 2 * $c - 2;
                break;
            case 'cicloalcino': // fórmula geral CnH2n-4
                $h = 2 * $c - 4;
                break;
            default:
                return "Classe inválida!";
        }

        return "Resultado: <strong>{$classe} → C{$c}H{$h}</strong>";
    }

    // Chamando a função
    $resultado = calcularHidrocarbonetos($classe, $c, $h);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Hidrocarbonetos</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Ajustar mínimo de carbonos dinamicamente
        function atualizarMinimo() {
            let classe = document.getElementById("classe").value;
            let campoCarbonos = document.getElementById("carbonos");

            if (classe === "alceno" || classe === "cicloalceno") {
                campoCarbonos.min = 3;
            } else if (classe === "alcino" || classe === "cicloalcino") {
                campoCarbonos.min = 2;
            } else {
                campoCarbonos.min = 1;
            }
        }
    </script>
</head>
<body>
    <div id="container">
        <img src="logo.png" alt="logo química" width="80">
        <h1>Calculadora de Hidrocarbonetos</h1>

        <form method="post">
            <label for="classe">Escolha a Classe:</label>
            <select name="classe" id="classe" onchange="atualizarMinimo()" required>
                <option value="" selected disabled>Selecione...</option>
                <option value="alcano">Alcano</option>
                <option value="alceno">Alceno</option>
                <option value="alcino">Alcino</option>
                <option value="cicloalcano">Cicloalcano</option>
                <option value="cicloalceno">Cicloalceno</option>
                <option value="cicloalcino">Cicloalcino</option>
            </select>

            <label for="carbonos">Número de Carbonos (C):</label>
            <input type="number" name="carbonos" id="carbonos" min="1" required>

            <label for="hidrogenios">Número de Hidrogênios (H):</label>
            <input type="number" name="hidrogenios" id="hidrogenios" min="1" required>

            <button type="submit">Calcular</button>
        </form>

        <?php if (!empty($resultado)): ?>
            <div class="resultado">
                <p><?= $resultado ?></p>
            </div>
        <?php endif; ?>

        <footer>
            <p>Colégio Newton Sucupira - versão estudantil</p>
        </footer>
    </div>
</body>
</html>
