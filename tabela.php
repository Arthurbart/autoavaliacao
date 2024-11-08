<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabela de Títulos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="fonte bg-light">
    <nav class="navbar navbar-expand-lg bg-success navbar-light text-underline">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Autoavaliação.sa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active me-5 pt-3" href="legislacao.html">Legislação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active me-5 pt-3" href="editais.html">Editais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active me-5" href="login.html">
                            <button type="button" class="btn btn-dark">Login</button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="col-6 ps-5 pt-5 mb-3">Ano 2024</h1>
    <div class="col-2 ps-5 pt-4">
        <a href="formulario.html"><button class="btn btn-dark btn-round btn-redondo">+</button></a>
    </div>
    <div class="container my-4 pb-5 text-center">

        <?php
            session_start();
            // Conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "autoavaliacao";

            // Criar conexão
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Verificar conexão
            if (!$conn) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            // Obtendo o id_user da sessão
            $id_user = $_SESSION['id_user']; // Pegando o id_user da sessão

            // Consultar os dados da tabela 'titulos' filtrando pelo id_user
            $sql = "SELECT nome, instituicao, carga_horaria, periodo, categoria, comprovante FROM titulos WHERE id_user = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id_user); // "i" indica que é um inteiro
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

        ?>

        <div class="row my-3 text-start">
            <h1>Tabela de títulos</h1>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-secondary">
                <tr>
                    <td><strong>Título</strong></td>
                    <td>Instituição</td>
                    <td>Carga <br>horária</td>
                    <td>Período</td>
                    <td>Categoria</td>
                    <td>Comprovante</td>
                    <td>Pontuação</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    // Exibir os dados em cada linha
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['instituicao'] . "</td>";
                        echo "<td>" . $row['carga_horaria'] . "</td>";
                        echo "<td>" . $row['periodo'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        // Exibir o comprovante como link
                        echo "<td><a href='" . $row['comprovante'] . "' target='_blank'>Ver Comprovante</a></td>";
                        echo"";
                        echo "<td>" . $_SESSION['pontuacao'] . "</td>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum título encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
            // Fechar conexão com o banco
            mysqli_close($conn);
        ?>
    </div>
    <footer class="mt-5 pt-5">
        <row class="d-flex">
            <div class=" col-6 text-start">
                <p class="ps-3">Licença MIT - 2024</p>
            </div>
            <div class="col-6 text-end">
                <p class="pe-3">Código</p>
            </div>
        </row>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
