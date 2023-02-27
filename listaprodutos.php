<?php
include("conectadb.php");

// passa a instrução para o banco de dados para listar todo conteudo da tabela produtos
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($link, $sql);
$ativo = "s";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $ativo = $_POST['ativo'];
    if($ativo == 's'){
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
        $resultado = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
        $resultado = mysqli_query($link,$sql);
    }
}
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
    <br>
    <!-- filtra produtos baseado em status, se $pro_ativo='s' lista somente produtos ativos,
        se $pro_ativo='n' lista somente produtos inativos.-->
    <form action="listaprodutos.php" method="post">
        <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo=='s'?"checked":""?>>ATIVOS<br>
        <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo=='n'?"checked":""?>>INATIVOS

    </form>
    <div><table border="1">
        <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>DESC</th>
                <th>QUANT</th>
                <th>PRECO</th>
                <th>ATIVO</th>
                <th>ALTERAR DADOS</th>
            </tr>
            <?php
            //preenchendo a tabela com os dados do banco
            while($tbl = mysqli_fetch_array($resultado)){
                ?>
                <tr>
                <td><?=$tbl[0]?></td>
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[2]?></td>
                <td><?=$tbl[3]?></td>

                <!-- number format traz o formato com 2 casas após a virgula e troca . por , na apresentacao -->
                <td>R$ <?= number_format($tbl[4],2,',', '.')?></td>

                <!-- valida $pro_ativo se 's' escreve SIM se 'n' NÃO -->
                <td><?=$check=($tbl[5]=='s')?"SIM":"NÂO"?></td>
                <td><a href="alterarproduto.php?id=<?=$tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
            </tr>
            <?php
            }
            ?>
    </table></div>
</body>
</html>