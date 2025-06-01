<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['username'];
    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "rpg_editor");

    if ($conn->connect_error) die("Erro na conexão: " . $conn->connect_error);

    $stmt = $conn->prepare("INSERT INTO usuarios (username, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $senha);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Formulário -->
<form method="POST" action="">
  <input type="text" name="username" placeholder="Usuário" required><br>
  <input type="password" name="password" placeholder="Senha" required><br>
  <button type="submit">Cadastrar</button>
</form>
