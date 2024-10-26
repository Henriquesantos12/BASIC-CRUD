<?php
$servername = "localhost";
$user = "root";
$pass = "";
$db = "crud";

// Conexão com o banco de dados
$conn = mysqli_connect($servername, $user, $pass, $db);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['mensagem']);
    
    // Insere os dados no banco de dados
    $sql = "INSERT INTO users (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Consulta para obter os dados existentes na tabela 'users'
$sql = "SELECT id, name AS nome, email, message AS mensagem FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Formulário de Contato</title>
</head>
<body>
    <h1>Contato</h1>
    <form action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" required></textarea>

        <button type="submit">Enviar</button>
    </form>

    <!-- Tabela que exibe os registros do banco de dados -->
    <h2>Registros</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Mensagem</th>
        </tr>
        <?php
        // Verifica se há registros no banco e os exibe na tabela
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id_user']}</td>";
                echo "<td>{$row['nome']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['mensagem']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Fecha a conexão
mysqli_close($conn);
?>
