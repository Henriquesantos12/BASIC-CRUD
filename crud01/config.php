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


// Fecha a conexão
mysqli_close($conn);
?>