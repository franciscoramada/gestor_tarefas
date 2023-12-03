<?php
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    // Exclua a tarefa específica
    $sql = "DELETE FROM tasks WHERE id=$task_id";
    if ($conn->query($sql) === TRUE) {
        echo "Tarefa excluída com sucesso!";
    } else {
        echo "Erro ao excluir a tarefa: " . $conn->error;
    }
} else {
    echo "Requisição inválida!";
}

$conn->close();
?>
