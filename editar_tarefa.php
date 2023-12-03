<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Tarefa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 0 auto;
        }

        input[type="text"],
        textarea,
        input[type="date"],
        select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
    if ($conn->connect_error) {
        die("Falha na ligação: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
        $task_id = $_GET['task_id'];

        // Recupere os dados da tarefa específica
        $sql = "SELECT * FROM tasks WHERE id=$task_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <form action="atualizar_tarefa.php" method="post">
                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                <input type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="Título" required>
                <textarea name="description" placeholder="Descrição"><?php echo $row['description']; ?></textarea>
                <input type="date" name="due_date" value="<?php echo $row['due_date']; ?>">
                <select name="status">
                    <option value="pendente" <?php if ($row['status'] == 'pendente') echo 'selected'; ?>>Pendente</option>
                    <option value="em_andamento" <?php if ($row['status'] == 'em_andamento') echo 'selected'; ?>>Em Andamento</option>
                    <option value="concluída" <?php if ($row['status'] == 'concluída') echo 'selected'; ?>>Concluída</option>
                </select>
                <button type="submit">Atualizar Tarefa</button>
            </form>
    <?php
        }
    }
    $conn->close();
    ?>
</body>

</html>
