<?php

//Coleta de Variáveis dos campos de texto
if($_SERVER["REQUEST_METHOD"] =="POST")
{$pro_nome=$_POST['pro_nome'];
$pro_desc=$_POST['pro_desc'];
$pro_quant=$_POST['pro_quant'];
$pro_preco=$_POST['pro_preco'];

//abre conexão com o banco de dados
include("conectadb.php");

//Verifica se o produto já existe
$sql="SELECT COUNT(pro_id) FROM produtos WHERE pro_nome ='$pro_nome' AND pro_desc='$pro_desc' AND pro_quant='$pro_quant' AND pro_preco='$pro_preco'";
$resultado=mysqli_query($link,$sql);
while($tbl=mysqli_fetch_array($resultado)){
    $cont=$tbl[0];
}
if($cont==1){
    echo"<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
}
//caso o produto não exista os dados vão ser inseridos na tabela 'produtos'
else{
    $sql="INSERT INTO produtos(pro_nome,pro_desc,pro_quant,pro_preco,pro_ativo)VALUES('$pro_nome','$pro_desc','$pro_quant','$pro_preco','s')";
    mysqli_query($link,$sql);
    header("location:listaprodutos.php");
}}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRAR PRODUTOS</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <!--  -->
        <form action="cadastrarproduto.php" method="POST">
            <h1>CADASTRO DE PRODUTOS</h1>
            <hr>
            <input type="text"name="pro_nome" id="pro_nome"placeholder="NOME" required>
            <p></p>
            <input type="text" id="pro_desc" name="pro_desc" placeholder="DESCRIÇÃO" required>
            <p></p>
            <input type="text" id="pro_preco" name="pro_preco" placeholder="PREÇO" required>
            <p></p>
            <input type="text" id="pro_quant" name="pro_quant" placeholder="QUANTIDADE" required>
            <p></p>

            <label>IMAGEM I</label>
            <input type="file" name="file1" id="img1" onchange="foot1()">
            <img src="img/semimg.gif" width="50px" id="foto1a">

            <input type="submit"name="cadastrar" id="cadastrar" value="CADASTRAR">
        </form>
    </table></div>
</body>
</html>