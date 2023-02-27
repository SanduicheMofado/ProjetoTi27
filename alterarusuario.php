<?php
include("conectadb.php");

//Coleta de Variáveis dos campos de texto HTML
if($_SERVER['REQUEST_METHOD']=='POST'){
$id=$_POST['id'];
$nome=$_POST['nome'];
$senha=$_POST['senha'];
$ativo = $_POST['ativo'];

//Instrução SQL para atualização de usuario e senha
$sql="UPDATE usuarios SET usu_senha='$senha',usu_nome='$nome', usu_ativo = '$ativo' WHERE usu_id='$id'";
mysqli_query($link,$sql);
header('location:listausuarios.php');
echo"<script>window.alert('USUÁRIO ALTERADO COM SUCESSO');</script>";
exit();
}

//Coletando ID via URL exemplo alterausuario.php?id=2
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
<a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div>
        <form action="alterarusuario.php" method="post">
        <input type="hidden" value="<?=$id?>" name="id" required><!-- coleta id ao carrega a página de forma oculta-->
        <label>NOME</label>
        <input type="text" name="nome" id="nome" value="<?=$nome?>"required><!-- Coleta o nome do usuario e preenche a txtbox-->
        <label>SENHA</label>
        <input type="password" name="senha" id="senha" value="<?=$senha?>"required><!-- Coleta a senha do usuario e preenche a txtbox-->
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