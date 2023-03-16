<?php
include("conectadb.php");

//Coleta de Variáveis dos campos de texto HTML
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pro_id = $_POST['id'];
    $pro_nome = $_POST['nome'];
    $pro_desc = $_POST['descricao'];
    $pro_quant = $_POST['quantidade'];
    $pro_preco = $_POST['preco'];
    $pro_ativo = $_POST['ativo'];

    // instrução SQL para atualizar os dados da tabela no banco de dados
    $sql = "UPDATE produtos SET pro_nome = '$pro_nome', pro_desc = '$pro_desc', pro_quant = '$pro_quant', pro_preco = '$pro_preco', pro_ativo = '$pro_ativo' WHERE pro_id = $pro_id";
    mysqli_query($link, $sql);

    header("Location: listaprodutos.php");
    echo"<script>window.alert('PRODUTO ALTERADO!');</script>";
    
}
// capturando ID via GET
$pro_id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = $pro_id";
$resultado = mysqli_query($link, $sql);

// preenchendo a tabela com os dados do banco
while($tbl = mysqli_fetch_array($resultado)){
    $pro_nome = $tbl[1];
    $pro_desc = $tbl[2];
    $pro_quant = $tbl[3];
    $pro_preco = $tbl[4];
    $pro_ativo = $tbl[5];

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>ALTERAR PRODUTO</title>
</head>
<body>
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div>
        <form action="alterarproduto.php" method="post">
            <input type="hidden" name="id" value="<?=$pro_id?>">
            <label>NOME</label>
            <input type="text" name="nome", value="<?=$pro_nome?>" required>
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricao", value="<?=$pro_desc?>" required>
            <label>QUANTIDADE</label>
            <input type="number" name="quantidade", value="<?=$pro_quant?>" required>
            <label>PRECO</label>
            <input type="number" name="preco", value="<?=$pro_preco?>" required>
            <br></br>
            <label>STATUS: <?=$check = ($pro_ativo == 's')?"ATIVO":"INATIVO"?></label><br>

            <!-- botões para validar ativo/inativo -->
            <input type="radio" name="ativo" value="s" <?=$pro_ativo == "s"?"checked":""?>>ATIVO<br>
            <input type="radio" name="ativo" value="n" <?=$pro_ativo == "n"?"checked":""?>>INATIVO

            <input type="submit" value="SALVAR">

        </form>
    </div>
</body>
</html>