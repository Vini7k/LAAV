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

        $stmt_aparelhos_reservas = $mysqli->prepare("
    SELECT aparelhos.categoria, aparelhos.marca, 
           COALESCE(COUNT(aparelho_reserva.reserva_id), 0) AS total_reservas 
    FROM aparelhos 
    LEFT JOIN aparelho_reserva ON aparelhos.id = aparelho_reserva.aparelho_id 
    GROUP BY aparelhos.categoria, aparelhos.marca
");

$stmt_aparelhos_reservas->execute();

$stmt_aparelhos_reservas->bind_result($categoria, $marca, $total_reservas_aparelho);

echo "<h2>Lista de cada aparelho e a quantidade de vezes que cada um reservado</h2>";
echo "<table>
        <tr>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Total de Reservas</th>
        </tr>";

while ($stmt_aparelhos_reservas->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($marca, ENT_QUOTES, 'UTF-8') . "</td>";
    
    if ($total_reservas_aparelho == 0) {
        echo "<td>Não há reservas</td>";
    } else {
        echo "<td>" . htmlspecialchars($total_reservas_aparelho, ENT_QUOTES, 'UTF-8') . "</td>";
    }

    echo "</tr>";
}

echo "</table>";


        $stmt_aparelhos_reservas->close();

        $mysqli->close();
        ?>
    </div>
    </div>
    </div>
</body>

</html>
