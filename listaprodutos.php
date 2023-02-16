<?php
include("conectadb.php");
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($link, $sql)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA PRODUTOS</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div><table border="1">
        <tr>
                <th>NOME</th>
                <th>DESC</th>
                <th>QUANT</th>
                <th>PRECO</th>
                <th>ATIVO</th>
                <th>ALTERAR DADOS</th>
            </tr>
            <?php
            while($tbl = mysqli_fetch_array($resultado)){
                ?>
                <tr>
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[2]?></td>
                <td><?=$tbl[3]?></td>
                <td><?=$tbl[4]?></td>
                <td><?=$check=($tbl[5]=='s')?"SIM":"NÂO"?></td>
                <td><a href="alterarproduto.php?id=<?=$tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
            </tr>
            <?php
            }
            ?>
    </table></div>
</body>
</html>