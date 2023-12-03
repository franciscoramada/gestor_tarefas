<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'gestao_tarefas');
    if ($conn->connect_error) {
        die("Falha na ligação: " . $conn->connect_error);
    }

    $username_or_email = $_POST['username_or_email'];

    $sql = "SELECT * FROM users WHERE username='$username_or_email' OR email='$username_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id']; 

        $new_password = generateRandomPassword(); // função para gerar senha aleatória

        // atualizar a senha do user na BD
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
        $conn->query($update_password_sql);

        echo "Uma nova password foi gerada: $new_password";
    } else {
        echo "Utilizador não encontrado!";
    }

    $conn->close();
}

function generateRandomPassword() {
    return substr(md5(uniqid(rand(), true)), 0, 8);
}
?>
