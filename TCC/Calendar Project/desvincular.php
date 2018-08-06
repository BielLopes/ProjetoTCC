<?php 
$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";

  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}


$codigoD = $_REQUEST["cod"];
$email = $_REQUEST["email"];

$sql= "SELECT `email`, `cod_disc` FROM `alunos` WHERE email='".$email."' and cod_disc=".$codigoD;
$rs = mysqli_query($conexao,$sql);

if(mysqli_num_rows($rs)>0){
	$sqlD = "DELETE FROM `alunos` WHERE email='".$email."' and cod_disc=".$codigoD;
	$rsD = mysqli_query($conexao,$sqlD);
	if($rsD){
		echo "Desvinculado!";
	}else{echo "Falha!";}
}

?>