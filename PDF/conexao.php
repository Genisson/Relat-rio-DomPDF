<?php 

// Conexão com banco de dados


$host = "localhost";
$user = "root";
$password = "matrix007";
$dbname = "crud";
$port =3308;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" .$dbname ,$user ,$password);

    echo "Conexão com banco de dados realizado com sucesso.";
}catch (PDOException $err) {

    echo "Erro: Conexão com banco de dados não realizada com sucesso.Erro gerado";
    $err->getMessage();

}

?>


<!-- $mysqli = new mysqli($servername,$username,$password,$dbname);

if($mysqli -> connect_errno)
	echo "Falha ao conectar: (" .$mysqli->connect_errno.")".$mysqli->connect_errno;
else
	//echo "Conectado ao Banco de Dados"; -->