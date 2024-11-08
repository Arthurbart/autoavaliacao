<?php
session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoavaliacao";

// Conectar ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Consulta SQL para verificar se o usuário e a senha existem na tabela
$query = "SELECT id_user FROM usuario WHERE usuario = ? AND senha = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $usuario, $senha);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se a consulta retornou algum resultado
if ($row = mysqli_fetch_assoc($result)) {
    // Usuário encontrado, armazena o id_user na sessão
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['usuario'] = $usuario; // Armazena o nome do usuário também
    echo "
    <script>
        alert('Login realizado com sucesso, bem-vindo!');
        window.location.href = 'tabela.php';
    </script>";
} else {
    // Usuário ou senha incorretos, redirecionar para uma página de erro
    echo "
    <script>
        alert('Usuário ou senha incorretos');
        window.location.href = 'login.html';
    </script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
