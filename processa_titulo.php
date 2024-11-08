<?php
session_start();
$_SESSION['titulo'] = $_POST['titulo'];
$_SESSION['instituicao'] = $_POST['instituicao'];
$_SESSION['carga_horaria'] = $_POST['carga_horaria'];
$_SESSION['periodo'] = $_POST['periodo'];
$_SESSION['categoria'] = $_POST['categoria'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoavaliacao";

// Conectar ao banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obter id_user da sessão
$id_user = $_SESSION['id_user'];

// Configurar o diretório de upload
$dir = "arquivos/";

$file = $_FILES["comprovante"];
$comprovante_path = $dir . basename($file["name"]);

if (move_uploaded_file($file["tmp_name"], $comprovante_path)) {
    // Inserir dados no banco, incluindo o caminho do comprovante
    $sql = "INSERT INTO titulos (id_user, nome, instituicao, carga_horaria, periodo, categoria, comprovante)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issssss", $id_user, $_POST['titulo'], $_POST['instituicao'], $_POST['carga_horaria'], $_POST['periodo'], $_POST['categoria'], $comprovante_path);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Título adicionado com sucesso.');
            window.location.href = 'tabela.php';
            </script>";
    } else {
        echo "<script>
            alert('Erro ao adicionar o título.');
            window.location.href = 'tabela.php';
            </script>";
    }
} else {
    echo "<script>
        alert('Erro ao fazer upload do comprovante.');
        window.location.href = 'tabela.php';
        </script>";
}

mysqli_close($conn);
?>
