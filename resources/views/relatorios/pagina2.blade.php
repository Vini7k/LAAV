<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAAV</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nav-bar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorios.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    
    <header>
        <x-nav-bar />
    </header>
    <div class='caixa'>
    <div class='div-principal'>
    <h1>RELATÓRIOS</h1>
    <div class=form-step>
        
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'laravel');

        if ($mysqli->connect_error) {
            die('Erro na conexão: ' . $mysqli->connect_error);
        }

        $stmt_total_reservas = $mysqli->prepare("SELECT COUNT(*) AS total_reservas FROM reservas");

        $stmt_total_reservas->execute();

        $stmt_total_reservas->bind_result($total_reservas);

        echo "<h2>Lista da quantidade de reservas realizadas</h2>";
        echo "<table>
                <tr>
                    <th>Total de Reservas</th>
                </tr>";

        while ($stmt_total_reservas->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($total_reservas, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        $stmt_total_reservas->close();

        $mysqli->close();
        ?>
    </div>
    </div>
    </div>
</body>

</html>
