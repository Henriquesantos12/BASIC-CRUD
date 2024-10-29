<?php
if (isset($_POST['id_user'])) {
    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);
    // Atualiza os dados no banco de dados
    $sql_update = "UPDATE users SET name = '$name', email = '$email', message = '$message' WHERE id_user = '$id_user'";
    mysqli_query($conn, $sql_update);
} else {
    // Insere os dados no banco de dados
    $sql = "INSERT INTO users (name, email, message) VALUES ('$name', '$email', '$message')";
    mysqli_query($conn, $sql);
}

// Consulta para obter os dados existentes na tabela 'users'
$sql = "SELECT id_user, name AS nome, email, message AS mensagem FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Formulário de Contato</title>
    <style>
        /* Seu estilo aqui */
    </style>
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

        <button type="submit" class="btn-enviar">Enviar</button>
        
    </form>

    <h2>Registros</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Mensagem</th>
            <th>Ações</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id_user']}</td>";
                echo "<td>{$row['nome']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['mensagem']}</td>";
                echo "<td>";
                // Formulário de atualização
                echo "<form action='update.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='id_user' value='{$row['id_user']}'>";
                echo "<input type='text' name='nome' value='{$row['nome']}' required>";
                echo "<input type='email' name='email' value='{$row['email']}' required>";
                echo "<textarea name='mensagem' required>{$row['mensagem']}</textarea>";
                echo "<button type='submit' action='./update.php' class='btn-atualizar'>Atualizar</button>";
                echo "</form>";

            }
        } else {
            echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
        }

            // Loop para gerar a tabela com link de atualização
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id_user']}</td>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['mensagem']}</td>";
                    echo "<td>";
                    echo "<a href='update.php?id_user={$row['id_user']}' class='btn-atualizar'>Atualizar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
            }
            ?>

        ?>
    </table>

    <script>
        function deletarRegistro(id) {
            if (confirm("Tem certeza que deseja deletar este registro?")) {
                // Implementar a lógica de deleção aqui
                alert("Deletar registro com ID: " + id);
            }
        }
    </script>
</body>
</html>

<?php
// Fecha a conexão
mysqli_close($conn);
?>
