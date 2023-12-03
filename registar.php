<?php
$conn = new mysqli('localhost', 'root', '', 'gestao_tarefas'); 
if ($conn->connect_error) {
    die("Falha na ligação: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Utilizador registado!";
} else {
    echo "Erro ao registar o utilizador: " . $conn->error;
}

$conn->close();
?>
