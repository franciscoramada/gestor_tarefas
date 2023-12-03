<?php
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Título: " . $row["title"]. " - Status: " . $row["status"]. "<br>";
        echo "<a href='editar_tarefa.php?task_id=" . $row["id"] . "'>Editar </a>";
        echo "<a href='excluir_tarefa.php?task_id=" . $row["id"] . "'> Excluir</a><br><br>";
    }
} else {
    echo "Nenhuma tarefa encontrada.";
}

$conn->close();
?>
