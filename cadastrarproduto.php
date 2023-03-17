<?php

//Coleta de Variáveis dos campos de texto
if($_SERVER["REQUEST_METHOD"] =="POST")
{$pro_nome=$_POST['pro_nome'];
$pro_desc=$_POST['pro_desc'];
$pro_quant=$_POST['pro_quant'];
$pro_preco=$_POST['pro_preco'];

//abre conexão com o banco de dados
include("conectadb.php");

//Criptografa foto para o banco de dados
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem_temp = $_FILES['imagem']['tmp_name'];
    $imagem = file_get_contents($imagem_temp);
    $imagem_base64 = base64_encode($imagem);
};

//Verifica se o produto já existe
$sql="SELECT COUNT(pro_id) FROM produtos WHERE pro_nome ='$pro_nome'";
$resultado=mysqli_query($link,$sql);
while($tbl=mysqli_fetch_array($resultado)){
    $cont=$tbl[0];
}
if($cont==1){
    echo"<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
}
//caso o produto não exista os dados vão ser inseridos na tabela 'produtos'
else{
    $sql="INSERT INTO produtos(pro_nome,pro_desc,pro_quant,pro_preco,pro_ativo,imagem1)VALUES('$pro_nome','$pro_desc','$pro_quant','$pro_preco','s','$imagem_base64')";
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
        <form action="cadastrarproduto.php" method="POST" enctype="multipart/form-data">
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
            <input type="file" name="imagem" id="imagem">
            <input type="submit"name="cadastrar" id="cadastrar" value="CADASTRAR">
            
        </form>
        <script>
            function foto1(){
                document.getElementById("foto1a").src = "img/"(document.getElementById("img1").value).slice(12);
            };
        </script>
    </table></div>
</body>
</html>