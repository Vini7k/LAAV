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

        $stmt = $mysqli->prepare("SELECT aparelhos.modelo, aparelhos.marca, reservas.data_emprestimo
            FROM reservas
            LEFT JOIN aparelho_reserva ON reservas.id = aparelho_reserva.reserva_id
            LEFT JOIN aparelhos ON aparelho_reserva.aparelho_id = aparelhos.id");

        $stmt->execute();

        $stmt->bind_result($modelo, $marca, $data_emprestimo);

        echo "<h2>Lista de todas as reservas e os aparelhos associados</h2>";
        echo "<table>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Data de Empréstimo</th>
                </tr>";

        while ($stmt->fetch()) {
            $data_emprestimo_formatada = date("d/m/Y", strtotime($data_emprestimo));

            echo "<tr>";
            echo "<td>" . htmlspecialchars($modelo, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($marca, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($data_emprestimo_formatada, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        $stmt->close();

       
        $mysqli->close();
        ?>
    </div>
    </div>
    </div>
</body>

</html>
