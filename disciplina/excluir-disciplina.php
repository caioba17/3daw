<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sigla = trim($_POST['sigla']);

  $linhas = file("disciplinas.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $arq = fopen("disciplinas.txt", "w") or die("Erro ao abrir o arquivo para escrita");

  $disciplina = false;

  foreach ($linhas as $linha) {
    $dados = explode(";", trim($linha));

    if (count($dados) == 3 && trim($dados[1]) != $sigla) {
      fwrite($arq, $linha . PHP_EOL);
    } else if (count($dados) == 3 && trim($dados[1]) == $sigla) {
      $disciplina = true;
    }
  }

  fclose($arq);

  if ($disciplina) {
    echo "Disciplina excluída com sucesso.";
  } else {
    echo "Erro";
  }

  header("Location: listar-disciplina.php");
  exit;
}