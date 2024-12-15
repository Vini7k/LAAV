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

        $stmt_users_reservas = $mysqli->prepare("
            SELECT users.name AS user_name, aparelhos.modelo AS aparelho_modelo, reservas.data_emprestimo, reservas.horario_emprestimo 
            FROM users 
            LEFT JOIN reservas ON users.id = reservas.user_id 
            LEFT JOIN aparelho_reserva ON reservas.id = aparelho_reserva.reserva_id
            LEFT JOIN aparelhos ON aparelho_reserva.aparelho_id = aparelhos.id
            UNION 
            SELECT users.name AS user_name, aparelhos.modelo AS aparelho_modelo, reservas.data_emprestimo, reservas.horario_emprestimo 
            FROM reservas 
            RIGHT JOIN users ON users.id = reservas.user_id
            LEFT JOIN aparelho_reserva ON reservas.id = aparelho_reserva.reserva_id
            LEFT JOIN aparelhos ON aparelho_reserva.aparelho_id = aparelhos.id
        ");

        $stmt_users_reservas->execute();

        $stmt_users_reservas->bind_result($user_name, $aparelho_modelo, $reserva_data_emprestimo, $reserva_horario_emprestimo);

        echo "<h2>Lista de todos os usuários, mesmo que alguns usuários não tenham reserva</h2>";
        echo "<table>
                <tr>
                    <th>Nome do Usuário</th>
                    <th>Aparelho Reservado</th>
                    <th>Data de Empréstimo</th>
                    <th>Horário de Empréstimo</th>
                </tr>";

        while ($stmt_users_reservas->fetch()) {
            $aparelho_modelo_formatado = $aparelho_modelo ? : 'Não tem Reservas';
            $data_emprestimo_formatada = $reserva_data_emprestimo ? date("d/m/Y", strtotime($reserva_data_emprestimo)) : 'Não tem Reservas';
            $horario_emprestimo_formatado = $reserva_horario_emprestimo ? date("H:i", strtotime($reserva_horario_emprestimo)) : 'Não tem Reservas';

            echo "<tr>";
            echo "<td>" . htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($aparelho_modelo_formatado, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($data_emprestimo_formatada, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($horario_emprestimo_formatado, ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        $stmt_users_reservas->close();

        $stmt_aparelhos_reservas = $mysqli->prepare("
            SELECT aparelhos.categoria, aparelhos.marca, COUNT(aparelho_reserva.reserva_id) AS total_reservas 
            FROM aparelhos 
            JOIN aparelho_reserva ON aparelhos.id = aparelho_reserva.aparelho_id 
            GROUP BY aparelhos.categoria, aparelhos.marca
        ");

        $stmt_aparelhos_reservas->execute();

        $stmt_aparelhos_reservas->bind_result($categoria, $marca, $total_reservas_aparelho);

        echo "<h2>Lista de cada categoria e marca de cada aparelho e a quantidade de vezes que cada tipo de aparelho foi reservado</h2>";
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
            echo "<td>" . htmlspecialchars($total_reservas_aparelho, ENT_QUOTES, 'UTF-8') . "</td>";
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
