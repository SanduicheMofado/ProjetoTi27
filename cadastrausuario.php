<?php
if($_SERVER["REQUEST_METHOD"] =="POST")
{$nome=$_POST['nome'];
$senha=$_POST['senha'];
include("conectadb.php");

//Verificar usuário existente
$sql="SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome ='$nome' AND usu_senha ='$senha'";
$resultado=mysqli_query($link,$sql);
while($tbl=mysqli_fetch_array($resultado)){
    $cont=$tbl[0];
}
if($cont==1){
    echo"<script>window.alert('USUARIO JÁ CADASTRADO!');</script>";
}
else{
    $sql="INSERT INTO usuarios(usu_nome,usu_senha,usu_ativo)VALUES('$nome','$senha','n')";
    mysqli_query($link,$sql);
    header("location:listausuarios.php");

}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE USUÁRIOS</title>
    <link rel="stylesheet" href="./estilo.css">
    
</head>
<body>
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div>
    <script> 
            function mostrarsenha(){
                var tipo=document.getElementByID("senha");
                if(tipo=="password"){
                    tipo.type="text";
                }
                else{tipo.type="password"}
            }
        </script>
        <form action="cadastrausuario.php" method="POST">
            <h1>CADASTRO DE USUÁRIOS</h1>
            <input type="text"name="nome" id="nome"placeholder="NOME">
            <br>
            <input type="password" id="senha" name="senha" placeholder="SENHA">
            <img id="olinho" onclick="mostrarsenha()" src="assets/eye.svg">
            <br>
            <input type="submit"name="cadastrar" id="cadastrar" value="CADASTRAR">
        </form>
    </div>
</body>
</html>