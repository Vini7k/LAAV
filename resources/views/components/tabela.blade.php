
<?php

//inicializa o filtro
$filtrosql = "";

//verifica se clicou em filtrar
if( $_POST !=NULL){
    //obtem filtro digitado por usuario 
    $filtro = $_POST["filtro"];
    //Cria filtro em SQL
    $filtrosql = "WHERE id = '$filtro' OR nome LIKE '%filtro%' OR matricula LIKE '%filtro%' OR data LIKE '%filtro%' ";
}

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

// Executar a consulta
$stmt->execute();

// Vincular os resultados às variáveis
$stmt->bind_result($userName, $data_emprestimo, $devolucao_prevista, $horario_devolucao_emprestimo, $aparelho_modelos);

// Criar a tabela HTML
echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, .25);
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
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

// Iterar sobre os resultados e exibir na tabela
while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($data_emprestimo, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($devolucao_prevista, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($horario_devolucao_emprestimo, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($aparelho_modelos, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "</tr>";
}

// Fechar a tabela HTML
echo "</table>";

// Fechar a declaração
$stmt->close();
?>

