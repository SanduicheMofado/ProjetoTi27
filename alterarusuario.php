<?php
include("conectadb.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
$id=$_POST['id'];
$nome=$_POST['nome'];
$senha=$_POST['senha'];
$ativo = $_POST['ativo'];

$sql="UPDATE usuarios SET usu_senha='$senha',usu_nome='$nome', usu_ativo = '$ativo' WHERE usu_id='$id'";
mysqli_query($link,$sql);
header('location:listausuarios.php');
echo"<script>window.alert('USUÁRIO ALTERADO COM SUCESSO');</script>";
exit();
}
//Capturar id via GET
$id=$_GET['id'];
$sql="SELECT * FROM usuarios WHERE usu_id='$id'";
$resultado=mysqli_query($link,$sql);
while($tbl=mysqli_fetch_array($resultado)){
    $nome=$tbl[1];
    $senha=$tbl[2];
    $ativo=$tbl[3];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTERAR USUÁRIO</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div>
        <form action="alterarusuario.php" method="post">
        <input type="hidden" value="<?=$id?>" name="id" required>    
        <label>NOME</label>
        <input type="text" name="nome" id="nome" value="<?=$nome?>"required>
        <label>SENHA</label>
        <input type="password" name="senha" id="senha" value="<?=$senha?>"required>
        <br>
        <label>Status: <?=$check = ($ativo == 's')?"ATIVO":"INATIVO";?></label>
        <br></br>
        <input type="radio" name="ativo" value="s">ATIVAR<br>
        <input type="radio" name="ativo" value="n">DESATIVAR
        <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>