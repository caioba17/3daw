<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Listar</title>
    <style>
    table {
      width: 20%;
      border-collapse: collapse;
   
    }
    th, td {
      border: 1px solid #000;
      padding: 4px;
      text-align: left;
    }
   </style>
</head>

<body>
  <h1>Listar Disciplinas</h1>
  <table>
    <tr>
      <th>Nome</th>
      <th>Sigla</th>
      <th>Carga</th>
    </tr>
    <?php
    $arq = fopen("disciplinas.txt", "r") or die("Erro");

    while (!feof($arq)) {
      $linha = fgets($arq);
      $dados = explode(";", trim($linha));

      if (count($dados) == 3) {
        echo "<tr><td>" . $dados[0] . "</td>" .
          "<td>" . $dados[1] . "</td>" .
          "<td>" . $dados[2] . "</td>" .
          "<td><form method='post' action='excluir-disciplina.php'>" .
          "<input type='hidden' name='sigla' value='" . $dados[1] . "'>" .
          "<input type='submit' value='Excluir'>" .
          "</form>" .
          " <a href='alterar-disciplina.php?sigla=" . $dados[1] . "'>Alterar</a>" .
          "</td></tr>";
      }
    }

    fclose($arq);
    ?>
  </table>
</body>

</html>