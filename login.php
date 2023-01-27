<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome=$_POST['nome'];
    $password=$_POST['password'];
    include("conectadb.php");
    //Consulta SQL para verificar o usuário cadastrado
    $sql="SELECT COUNT(usu_id) FROM usuario WHERE usu_nome='$nome' AND usu_senha='$password'";
    $resultado=mysqli_query($link,$sql);
    while($tbl=mysqli_fetch_array($resultado)){
        $cont=$tbl[0];
    }
    if($cont==1){
        header("location: homesistema.html");
    }
    else{
        echo"<script>window.alert('USUÁRIO OU SENHA INCORRETOS');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN USUÁRIO</title>
    <link rel="stylesheet"href=".../stylecadastra.css">
</head>
<body>
    <div class="container">
        <!-- script para mostrar senha -->
        <script> 
            function mostrarsenha(){
                var tipo=document.getElementByID("senha");
                if(tipo=="password"){
                    tipo.type="text";
                }
                else{tipo.type="password"}
            }
        </script>
        <form action="login.php" method="POST">
            <h1>LOGIN DE USUÁRIO</h1>
            <input type="text" name="nome" id="nome" placeholder="nome">
            <br>
            <input id="password"name="password"placeholder="senha">
            <img id="olinho" onclick="mostrarsenha()" src="assets/eye.svg">
            <br>
            <input type="submit"name="login"value="LOGIN">
        </form>
    </div>
</body>
</html>