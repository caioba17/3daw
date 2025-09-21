<?php 
$matricula = "";
$nome = "";
$email = "";
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'GET' && isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];
    $arq = fopen("alunos.txt", "r") or die("Erro");
    while(!feof($arq)) {
        $linha = fgets($arq);
        $dados = explode(";", trim($linha));
        if(count($dados) == 3 && $dados[0] == $matricula) {
            $nome = $dados[1];
            $email = $dados[2];
            break;
        }
    }
    fclose($arq);
} else if ($method == 'POST') {
    $matricula_original = $_POST['matricula_original'];
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $linhas = file("alunos.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $arq = fopen("alunos.txt", "w") or die("Erro");
    foreach($linhas as $linha) {
        $dados = explode(";", trim($linha));
        if(count($dados) == 3 && $dados[0] == $matricula_original) {
            fwrite($arq, "$matricula;$nome;$email" . PHP_EOL);
        } else {
            fwrite($arq, $linha . PHP_EOL);
        }
    }

    fclose($arq);

    header("Location: listar-alunos.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Aluno</title>
</head>
<body>
    <h1>Alterar Aluno</h1>
    <ul>
        <li><a href="criar-aluno.php" target="external">Criar Aluno</a></li>
        <li><a href="listar-alunos.php" target="external">Listar Alunos</a></li>
    </ul>
    <form action="alterar-aluno.php" method="post">
        <input type="hidden" name="matricula_original" value="<?php echo $matricula; ?>">
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" value="<?php echo $matricula; ?>" required>
        <br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        <br>
        <input type="submit" value="Alterar">
    </form>
</body>
</html>