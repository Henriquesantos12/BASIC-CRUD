<?php
// Conectar ao banco de dados
$conn = mysqli_connect("localhost", "root", "", "crud");

$user = null; // Inicializa a variável para evitar erros

if (isset($_GET['id_user'])) {
    $id_user = mysqli_real_escape_string($conn, $_GET['id_user']);
    
    // Consulta para obter os dados do usuário específico
    $sql = "SELECT nome, email, mensagem FROM users WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Usuário não encontrado.</p>";
        exit();
    }
} else {
    echo "<p>ID de usuário não fornecido.</p>";
    exit();
}

// Código para atualizar os dados ao enviar o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']);

    $sql_update = "UPDATE users SET nome = '$name', email = '$email', mensagem = '$message' WHERE id_user = '$id_user'";
    mysqli_query($conn, $sql_update);

    // Redireciona de volta para a página principal
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Registro</title>
</head>
<body>
    <style>
        body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
}
h1, h2 {
    text-align: center;
}
form, table {
    width: 80%;
    max-width: 600px;
    margin: 20px 0;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
input, textarea {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}
button {
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
table {
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
    </style>
    <h1>Atualizar Registro</h1>
    <?php if ($user): ?>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" required><?php echo htmlspecialchars($user['message']); ?></textarea>

        <button type="submit">Salvar Alterações</button>
    </form>
    <?php endif; ?>
</body>
</html>

<?php
// Fecha a conexão
mysqli_close($conn);
?>
