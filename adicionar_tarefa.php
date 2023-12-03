<?php
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $priority = $_POST['priority'];

    $sql = "INSERT INTO tasks (title, description, due_date, status, category, priority)
            VALUES ('$title', '$description', '$due_date', '$status', '$category', '$priority')";

    if ($conn->query($sql) === TRUE) {
        echo "Tarefa criada com sucesso!";
    } else {
        echo "Erro ao criar tarefa: " . $conn->error;
    }
}
