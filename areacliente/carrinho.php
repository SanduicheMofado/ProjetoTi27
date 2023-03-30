<?php
//trazer conexão do banco
include("../conectadb.php");
//inicia sessão já aberta
session_start();
$idcliente=$_SESSION['idcliente'];
$finalizada='n';
//lista  todos os produtos do carrinho
$sql="SELECT numero_carrinho,pro_nome,pro_desc,pro_preco,item_quantidade,valor_carrinho,imagem1,carrinho_id
FROM itens_carrinho INNER JOIN clientes ON fk_cli_id=cli_id INNER JOIN produtos ON fk_pro_id=pro_id
WHERE cli_id=$idcliente AND carrinho_finalizado='n'";
//captura resultados de pesquisa sql
$resultado =mysqli_query($link,$sql);
//seletor de carrinho finalizado ou não
if($_SERVER['REQUEST METHOD']=='POST'){
    $finalizada=$_POST['finalizada'];
    if($finalizada=='n'){
        $sql="SELECT numero_carrinho,pro_nome,pro_desc,pro_preco,item_quantidade,valor_carrinho,imagem1,carrinho_id
        FROM itens_carrinho INNER JOIN clientes ON fk_cli_id=cli_id INNER JOIN produtos ON fk_pro_id=pro_id
        WHERE cli_id=$idcliente AND carrinho_finalizado='n'";
        mysqli_query($link,$sql);
    }
    else{
        $sql="SELECT numero_carrinho,pro_nome,pro_desc,pro_preco,item_quantidade,valor_carrinho,imagem1,carrinho_id
        FROM itens_carrinho INNER JOIN clientes ON fk_cli_id=cli_id INNER JOIN produtos ON fk_pro_id=pro_id
        WHERE cli_id=$idcliente AND carrinho_finalizado='s'";
        mysqli_query($link,$sql);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <form action="carrinho.php" method="post">
    <a href="loja.php"><input type="button" id="loja" value="VOLTAR PARA LOJA"></a>
    <input type="radio" name="finalizada" value="s" required onclick="submit()"<?=$finalizada=='s'?"checked":"" ?>COMPRAS FINALIZADAS>
    <input type="radio" name="finalizada" value="n" required onclick="submit()"<?=$finalizada=='s'?"checked":"" ?>CARRINHOS ABERTOS>
    </form>
    <div class="container">
        <td><a href="finalizavenda.php?id=<?=$tbl[0]?>"><input type="button" value="FINALIZAR VENDA"></a></td>
        <table border="1">
            <tr>
                <th>NUMERO DO CARRINHO</th>
                <th>NOME PRODUTO</th>
                <th>DESCRICAO</th>
                <th>PRECO UNITARIO</th>
                <th>QUANTIDADE PRODUTOS</th>
                <th>IMAGEM</th>
            </tr>
            <?php
            while($tbl=mysqli_fetch_array($resultado)){
                ?>
                <tr>
                    <td><?=$tbl[0]?></td>
                    <td><?=$tbl[1]?></td>
                    <td><?=$tbl[2]?></td>
                    <td><?=$tbl[3]?></td>
                    <td>R$<?=number_format($tbl[4],2,',', '.')?></td>
                    <td><img src="data:image/jpeg;base64,<?=$tbl[6]?>" width="100" height="100"></td>
                    <td><a href="excluirproduto.php?id=<?=$tbl[7]?>"><input type="button" value="REMOVER ITEM"></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>