<?
    $servername = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "crud";

    if ($conn = mysqli_connect($servername, $user, $pass, $db)) {
        echo "conectado";
    } else {
        echo "erro";
    }

    // Consulta para obter os dados existentes na tabela 'users'
$sql = "SELECT id, name AS nome, email, message AS mensagem FROM users";
$result = mysqli_query($conn, $sql);




// Fecha a conexão
mysqli_close($conn);
?>