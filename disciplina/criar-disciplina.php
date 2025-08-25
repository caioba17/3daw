<?php
$msg = "";
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST') {  
    $nome = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];
    echo "Nome: " . $nome . " | Sigla: " . $sigla . " | Carga: " . $carga . "<br>";
    if (!file_exists("disciplinas.txt")) {
        $arq = fopen("disciplinas.txt", "w") or die("erro");
        $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
        fwrite($arq, $linha);
        fclose($arq);
        $msg = "Disciplina cadastrada com sucesso!";
    } else {
        $arq = fopen("disciplinas.txt", "a") or die("erro");
        $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
        fwrite($arq, $linha);
        fclose($arq);
        $msg = "Disciplina cadastrada com sucesso!";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Disciplinas</title>
  <style> 
    form {
        display: flex;
        flex-direction: column;
        width: 20%;
        gap: 5px
    }
    input {
        padding: 5px
    }
  </style>
</head>
<body>
  <h1>bom dia</h1>
  <form action="criar-disciplina.php" method="POST" name="disciplina">
    <input type="text" name="nome" placeholder="Nome">
    <input type="text" name="sigla" placeholder="Sigla">
    <input type="text" name="carga" placeholder="Carga">
    <input type="submit" name="Enviar" value="Criar disciplina">
  </form>
  <p><?php echo $msg; ?></p>
</body>
</html>

