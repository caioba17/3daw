<?php
$method = $_SERVER['REQUEST_METHOD'];

$v1 = 0;
$v2 = 0;
$op = '+';

if ($method == 'POST') {
  echo "<br/>É POST<br/>";
  $v1 = $_POST["a"] ?? 0;
  $v2 = $_POST["b"] ?? 0;
  $op = $_POST["operacao"] ?? '+';
} else {
  echo "É GET<br/>";
  $v1 = $_GET["a"] ?? 0;
  $v2 = $_GET["b"] ?? 0;
  $op = $_GET["operacao"] ?? '+';
}

$result = 0;

switch ($op) {
  case '+':
    $result = $v1 + $v2;
    break;
  case '-':
    $result = $v1 - $v2;
    break;
  case '*':
    $result = $v1 * $v2;
    break;
  case '/':
    if ($v2 != 0) {
      $result = $v1 / $v2;
    } else {
      $result = "Erro: Divisão por zero";
    }
    break;
  default:
    $result = "Operação inválida";
    break;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Calculadora</title>
</head>
<body>
  <h1>Resultado: <?php echo $result; ?></h1>
</body>
</html>
