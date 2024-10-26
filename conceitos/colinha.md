CONCEITOS DO CÓDIGO PARA INICIANTES NO PHP:
<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['mensagem']);
    
    // Insere os dados no banco de dados
    $sql_insert = "INSERT INTO users (nome, email, mensagem) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql_insert)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erro: " . $sql_insert . "<br>" . mysqli_error($conn);
    }
}
?>


