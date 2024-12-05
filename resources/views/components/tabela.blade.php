<?php

$user = "root"; 
$password = ""; 
$database = "laravel"; 
$hostname = "localhost";
$mysqli = new mysqli('localhost', 'root', '', 'laravel');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("
    SELECT 
        users.name, 
        reservas.data_emprestimo, 
        reservas.devolucao_prevista, 
        reservas.horario_devolucao_emprestimo,
        GROUP_CONCAT(aparelhos.modelo SEPARATOR ', ') AS aparelho_modelos
    FROM 
        reservas 
    INNER JOIN 
        users ON reservas.user_id = users.id
    INNER JOIN 
        aparelho_reserva ON reservas.id = aparelho_reserva.reserva_id
    INNER JOIN 
        aparelhos ON aparelho_reserva.aparelho_id = aparelhos.id
    GROUP BY 
        reservas.id, users.name, reservas.data_emprestimo, reservas.devolucao_prevista, reservas.horario_devolucao_emprestimo
");

$stmt->execute();

$stmt->bind_result($userName, $data_emprestimo, $devolucao_prevista, $horario_devolucao_emprestimo, $aparelho_modelos);

echo "<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}

/* Estilo para as células da tabela */
th, td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
    font-size: 14px;
    background-color: #fff;
    color: #333;
}

th {
    background-color: #06864a;
    color: #fff;
    font-weight: bold;
}

td {
    box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.1);
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

table {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
}

.table-container {
    padding: 50px;
    background-color: #fafafa;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>";

echo "<table>
        <tr>
            <th>Nome do Usuário</th>
            <th>Data de Empréstimo</th>
            <th>Data de Devolução</th>
            <th>Horário de Devolução</th>
            <th>Aparelhos</th>
        </tr>";

while ($stmt->fetch()) {
    // Formatar o horário de devolução para mostrar apenas a hora e minuto
    $horario_formatado = date("H:i", strtotime($horario_devolucao_emprestimo));
    
    // Formatar as datas para o formato dd/mm/aaaa
    $data_emprestimo_formatada = date("d/m/Y", strtotime($data_emprestimo));
    $devolucao_prevista_formatada = date("d/m/Y", strtotime($devolucao_prevista));

    echo "<tr>";
    echo "<td>" . htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($data_emprestimo_formatada, ENT_QUOTES, 'UTF-8') . "</td>"; // Exibe a data de empréstimo formatada
    echo "<td>" . htmlspecialchars($devolucao_prevista_formatada, ENT_QUOTES, 'UTF-8') . "</td>"; // Exibe a data de devolução formatada
    echo "<td>" . htmlspecialchars($horario_formatado, ENT_QUOTES, 'UTF-8') . "</td>"; // Exibe a hora formatada
    echo "<td>" . htmlspecialchars($aparelho_modelos, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "</tr>";
}

echo "</table>";

$stmt->close();
?>
