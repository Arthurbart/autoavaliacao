<?php
    session_start();
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['matricula'] = $_POST['matricula'];
    $_SESSION['senha'] = $_POST['senha'];
    $_SESSION['confirma_senha'] = $_POST['confirma_senha'];

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "autoavaliacao";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    if($_SESSION['senha'] != $_SESSION['confirma_senha']){
      echo "<script>
              alert('As senhas não coincidem');
              window.location.href = 'cadastro.html';
            </script>";
        exit();
    }
    $sql = "INSERT INTO usuario (usuario, senha, matricula, nome_completo)
    VALUES ('".$_POST['usuario']."', '".$_POST['senha']."', '".$_POST['matricula']."', '".$_POST['nome']."')";

    if (mysqli_query($conn, $sql)) {

      echo "<script>
      alert('Dados cadastrados com sucesso! Por favor, realize o login.');
      window.location.href = 'login.html';
      </script>";

      exit();
    } else {
      echo "Não foi possível realizar o cadastro. ";
      echo "<br><a href='cadastro.html'>Voltar</a>";
    }

    mysqli_close($conn);
?>