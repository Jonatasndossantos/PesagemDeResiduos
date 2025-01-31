<?php

    require_once('Conexao.php');
    use PHP\Modelo\DAO\Conexao;
function loginUsuario(Conexao $conexao,
	string $usuario,
	string $senha){
	$usuario = $_POST["usuario"];
	$senha = md5($_POST["senha"]);
	$connect = $conexao->conectar();
	$db = mysql_select_db("phpTINT");
	try{
	    $verifica = mysql_query('SELECT * FROM usuarios WHERE login = $login AND senha = $senha) or die(erro ao selecionar');
	      if (mysql_num_rows($verifica)<=0){
	        echo '<script language="javascript" type="text/javascript"> alert("Login e/ou senha incorretos");window.location .href="../Telas/login.php";</script>';
	        die();
	      }else{
	        setcookie("login",$login);
			return '<script language="javascript" type="text/javascript"> window.location .href="../Telas/login.php";</script>';
	        header("Location:login.php");
	      }
	}catch(Except $erro){
		echo 'Erro encontrado: $erro "\n"';
	}  
}
?>