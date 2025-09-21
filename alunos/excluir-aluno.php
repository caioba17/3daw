<?php 
$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST') {
    $matricula = $_POST["matricula"];
    $linhas = file("alunos.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $arq = fopen("alunos.txt", "w") or die("Erro ao abrir o arquivo para escrita");
    $aluno = false;
    foreach ($linhas as $linha) {
        $dados = explode(";" , trim($linha));
        if (count($dados) == 3 && trim($dados[0]) != $matricula) {
            fwrite($arq, $linha . PHP_EOL); 
        } else if (count($dados) == 3 && trim($dados[0]) == $matricula) {
            $aluno = true;
        }
    }
    fclose($arq);
    if ($aluno) {
        echo "Aluno excluído com sucesso.";
    } else {
        echo "Erro";
    }

    header("Location: listar-alunos.php");
    exit();
}
?>