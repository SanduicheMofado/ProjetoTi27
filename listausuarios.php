<?php
include("conectadb.php");

// passa a instrução para o banco de dados para listar todo conteudo da tabela usuarios
$sql = "SELECT * FROM usuarios WHERE usu_ativo='s'";
$resultado = mysqli_query($link, $sql);
$ativo = "s";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $ativo = $_POST['ativo'];
    if($ativo == 's'){
        $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
        $resultado = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM usuarios WHERE usu_ativo = 'n'";
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
    <title>LISTA USUÁRIOS</title>
</head>

<body>
    <link rel="stylesheet" href="estilo.css">
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <br>
    <form action="listausuarios.php" method="post">
        <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo=='s'?"checked":""?>>ATIVOS<br>
        <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo=='n'?"checked":""?>>INATIVOS

    </form>
    <div class="container">
        <table border="1">
            <tr>
                <th>NOME</th>
                <th>ALTERAR DADOS</th>
                <th>ATIVO</th>
            </tr>
            <?php
            //preenchendo a tabela com os dados do banco
            while($tbl = mysqli_fetch_array($resultado)){
                ?>
                <tr>
                <td><?=$tbl[1]?></td>
                <td><a href="alterarusuario.php?id=<?=$tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
                
                <!-- valida $ativo se 's' escreve SIM se 'n' NÃO -->
                <td><?=$check=($tbl[3]=='s')?"SIM":"NÂO"?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>

</html>