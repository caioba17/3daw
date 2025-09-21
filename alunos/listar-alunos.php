<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar alunos</title>
</head>
<body>
    <h1>Lista de alunos</h1>
    <ul>
        <li><a href="criar-aluno.php" target="external">Criar Aluno</a></li>
    </ul>
     <table>
        <tr>
            <th>Matrícula</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Excluir</th>
            <th>Alterar</th>
        </tr>
        <?php 
        $arq = fopen("alunos.txt", "r") or die("Erro");
        while (!feof($arq)) {
            $linha = fgets($arq);
            $dados = explode(";", trim($linha));
            if(count($dados) == 3) {
                echo "<tr>
                        <td>" . $dados[0] . "</td>" .
                       "<td>" . $dados[1] . "</td>" .
                       "<td>" . $dados[2] . "</td>
                       <td> 
                        <form method='post' action='excluir-aluno.php'>
                            <input type='hidden' name='matricula' value='" . $dados[0] . "'>
                            <input type='submit' value='Excluir'>
                        </form>
                     </td>
                     <td> <a href='alterar-aluno.php?matricula=" . $dados[0] . "'>Alterar</a> </td>
                   </tr>";
            }
        }
        ?>
    </table>
</body>
</html>
