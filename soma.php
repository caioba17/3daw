<?php
$v1 = $_GET["v1"] ?? 0;
$v2 = $_GET["v2"] ?? 0;


$result = $v1 + $v2;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Soma</title>
</head>

<body>
  <?php echo "<h1>Resultado: $result</h1>"; ?>


</body>


</html>