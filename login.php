<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

$username_or_email = $_POST['username_or_email'];
$password = $_POST['password'];

$sql = "SELECT id, username FROM users WHERE username='$username_or_email' OR email='$username_or_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['id']; // Define o user_id na sessão
        echo "Login bem-sucedido!"; 
    } else {
        echo "Palavra-passe incorreta!";
    }
} else {
    echo "Utilizador não encontrado!";
}

$conn->close();
?>
