<?php
$sigla = "";
$nome = "";
$carga = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['sigla'])) {
    $sigla = $_GET['sigla'];
    $arq = fopen("disciplinas.txt", "r") or die("Erro");

    while (!feof($arq)) {
        $linha = fgets($arq);
        $dados = explode(";", trim($linha));

        if (count($dados) == 3 && $dados[1] == $sigla) {
            $nome = $dados[0];
            $carga = $dados[2];
            break;
        }
    }

    fclose($arq);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $carga = $_POST['carga'];

    $linhas = file("disciplinas.txt");
    $arq = fopen("disciplinas.txt", "w") or die("Erro");

    foreach ($linhas as $linha) {
        $dados = explode(";", trim($linha));

        if (count($dados) == 3 && $dados[1] == $sigla) {
            fwrite($arq, "$nome;$sigla;$carga\n");
        } else {
            fwrite($arq, $linha);
        }
    }

    fclose($arq);
    $msg = "Disciplina alterada com sucesso!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Alterar</title>
</head>

<body>
    <h1>Alterar a disciplina</h1>
    <br>
    <ul>
        <li><a href="criar-disciplina.php" target="external">Incluir Disciplina</a></li>
        <li><a href="listar-disciplina.php" target="external">Listar Disciplinas</a></li>
    </ul>
    <form action="alterar-disciplina.php" method="POST">
        Nome: <input type="text" name="nome" value="<?php echo $nome; ?>">
        <br><br>
        Sigla: <input type="text" name="sigla" value="<?php echo $sigla; ?>" readonly>
        <br><br>
        Carga Horária: <input type="text" name="carga" value="<?php echo $carga; ?>">
        <br><br>
        <input type="submit" value="Alterar Disciplina">
    </form>
    <p><?php echo $msg; ?></p>
</body>

</html>