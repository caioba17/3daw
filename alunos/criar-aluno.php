<?php 
$method = $_SERVER['REQUEST_METHOD'];
$errors = [];
if($method == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $matricula = $_POST["matricula"];

    if(empty($nome)) {
        $errors[] = "Nome é obrigatório";
    }

    $emailRegex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if(!preg_match($emailRegex, $email)) {
        $errors[] = "Email inválido";
    }

    $matriculaRegex = "/^[0-9]{3}$/";

    if(!preg_match($matriculaRegex, $matricula)) {
        $errors[] = "Matrícula inválida";
    }
    if (empty($errors)) {
        if(file_exists("alunos.txt")) {
            $arqAluns = fopen("alunos.txt", "a") or die("erro");
        } else {
            $arqAluns = fopen("alunos.txt", "w") or die("erro");
        }
        $linha = $matricula . ";" . $nome . ";" . $email . "\n";    
        fwrite($arqAluns, $linha);
        fclose($arqAluns);
        echo "Aluno cadastrado com sucesso!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
</head>
<body>
    <h1>bom dia</h1>
    <ul>
        <li><a href="listar-alunos.php" target="external">Listar Alunos</a></li>
    </ul>

    <?php
    if (!empty($errors)) {
        echo "<div>";
        echo "<strong>Erros: </strong><br>";
        foreach ($errors as $error) {
            echo "- " . $error . "<br>";
        }
        echo "</div>";        
    }
    ?>

    <form action="criar-aluno.php" method="POST" name="aluno"> 
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="matricula" placeholder="Matrícula">
        <input type="submit" name="Enviar" value="Criar aluno">
    </form>
</body>
</html>