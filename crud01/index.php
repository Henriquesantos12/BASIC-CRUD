<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
</head>
<body>
    <h1>Contato</h1>
    <form action="submit.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" required></textarea>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
