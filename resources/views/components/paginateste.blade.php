<html>
<!--Cria botão e local de escrita -->

        <form method = "post" >
                Filtrar
                <input type="text" name="filtro">
                <input type="submit" value="OK">
        </form>
</html>
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

$stmt = $mysqli->prepare("SELECT users.name, reservas.data_emprestimo, reservas.devolucao_prevista, reservas.horario_devolucao_emprestimo FROM reservas INNER JOIN users ON reservas.user_id = users.id");
$stmt->execute();
$stmt->bind_result($userName, $data_emprestimo,$devolucao_prevista,$horario_devolucao_emprestimo);

echo "<table> 
        <style>
                th,tr,td{
                        background-color: #fff;
                        border-radius: 15px;
                        box-shadow: 3px 3px 3px rgba(0, 0, 0, .25);
                        padding: 5px;
                }
        </style>
        <tr>
                <th>Nome do Usuário</th>
                <th>Data de Empréstimo</th>
                <th>Data de Devolução</th>
                <th>Horario de Devolução</th>
                <th>Aparelho</th>
        </tr>";

while ($stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . $userName . "</td>";
    echo "<td>" . $data_emprestimo . "</td>";
    echo "<td>" . $devolucao_prevista . "</td>";
    echo "<td>" . $horario_devolucao_emprestimo . "</td>";
    
    echo "</tr>";
}

echo "</table>";

$stmt->close();
?>