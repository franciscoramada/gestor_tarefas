<?php
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title='$title', description='$description', due_date='$due_date', status='$status' WHERE id=$task_id";

    if ($conn->query($sql) === TRUE) {
        echo "Tarefa atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a tarefa: " . $conn->error;
    }
} else {
    echo "Requisição inválida!";
}

$conn->close();
?>
