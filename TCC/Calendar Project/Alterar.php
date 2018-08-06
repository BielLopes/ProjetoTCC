<?php
require('verificar.php');


?>
<html>
<head>
<link rel="stylesheet" href="Css/calendar.css">
<link rel="stylesheet" href="Css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
<link rel="stylesheet" href="Css/w3.css">
</head>
<body style="style = background: linear-gradient(white, green);
	background: -webkit-linear-gradient(white, green);
    background: -o-linear-gradient(white,green);
    background: -moz-linear-gradient(white,green);">
<nav>

<!-- Avisos de LOGIN INCORRETO!!!-->
	<div id="alteradoComSucesso" class="w3-modal">
	  <div class="w3-modal-content">
	    <div class="w3-container">
	      <span onclick="sumir('alteradoComSucesso')" class="w3-closebtn">&times;</span>
	      <p><h2>Alterado com Sucesso</h2></p>
	       </div>
	  </div>
	</div>

	<div id="erroAtualizar" class="w3-modal">
	  <div class="w3-modal-content">
	    <div class="w3-container">
	      <span onclick="sumir('erroAtualizar')" class="w3-closebtn">&times;</span>
	      <p><h2>ERRO ao Atualizar!<h2></p>
	       </div>
	  </div>
	</div>

	<div id="confirmacaoSenha" class="w3-modal">
	  <div class="w3-modal-content">
	    <div class="w3-container">
	      <span onclick="sumir('confirmacaoSenha')" class="w3-closebtn">&times;</span>
	      <p><h2>Confirmação de Nova Senha incorreta</h2></p>
	       </div>
	  </div>
	</div>

	<div id="confirmacaoEmail" class="w3-modal">
		<div class="w3-modal-content">
			<div class="w3-container">
				<span onclick="sumir('confirmacaoEmail')" class="w3-closebtn">&times;</span>
				<p><h2>Confirmação de email Incorreta!</h2></p>
				 </div>
		</div>
	</div>

	<div id="SenhaAtual" class="w3-modal">
		<div class="w3-modal-content">
			<div class="w3-container">
				<span onclick="sumir('SenhaAtual')" class="w3-closebtn">&times;</span>
				<p><h2>Senha Atual INCORRETA!!!</h2></p>
				 </div>
		</div>
	</div>
<!--Fim dos Avisos de LOGIM-->








<div id="contatos" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('contatos').style.display='none'" class="w3-closebtn">&times;</span>
      <p><h2>Email: calendario.cedaf@gmail.com</h2></p>
       </div>
  </div>
</div>
<div id="sobre" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('sobre').style.display='none'" class="w3-closebtn">&times;</span>
      <p><h2>Desenvolvido pelos alunos Gabriel Nery, Gabriel Lopes, Igor Henrique, estudantes do Centro de Ensino e Desenvolvimento Agrário de Florestal - UFV</h2></p>
    </div>
  </div>
</div>

<ul class="w3-navbar w3-card-2 w3-black">
  <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Ajuda</a></li>
  <li><a href="#" onclick="document.getElementById('contatos').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('sobre').style.display='block'">Sobre</a></li>
  <li><a href="DIV-TCC.php">Voltar</a></li>
   <li style="float:right"><a href="#news" onclick="aparecer('sa')">Sair </a></li>
  <li style="float:right"><a  href="#"><?php echo  "<text id = 'nomeCabecalho'>".$_SESSION['nome']."</text>"; ?></a></li>
</ul>
</nav>
<script language="Javascript">
function sumir(i) {
    document.getElementById(i).style.display = "none";
}
function aparecer(i) {
    document.getElementById(i).style.display = "initial";
}
function solic(w,z) {
    document.getElementById(w).style.display = "initial";
	document.env_solic.codE.value = z;
}
function aparecer2(cod3) {
	document.salvacao.codigoDisciplina.value=cod3;
	document.salvacao.submit();
	aparecer('tarefa');
	}

function delet(k){
                var cod2 = k.id;
				document.apagarD.apag.value=cod2;
				y = confirm("Confirmar?");
				if (y == true){
				document.apagarD.submit();
				}

			}
</script>
<div id="sa" class="w3-modal">
  <div class="w3-modal-content w3-round-xlarge">
    <div class="w3-container ">
      <span onclick="document.getElementById('sa').style.display='none'" class="w3-closebtn" style="color:red">&times;</span>
      <div class="w3-container a">
  <h2>Deseja realmente sair?</h2>
</div>
	  <form method="post">
	  <input type=submit class="b1" name=a value=Sim>
	  <input type=button class="b1" name=s onclick="document.getElementById('sa').style.display='none'" value=Não>
	  <input type=hidden name=c value=c>
	  <input type=hidden name=tipo value=fechar>

	  </form>
<?php

if(empty($_REQUEST['c'])){}else{
	if($_REQUEST['c']=='c'){
		session_destroy();
		echo "<script>location.href='index.php'</script>";
	}
}

?>
	  </div>
  </div>
</div>
<div  align="center">
		<form name="cad_prof" method="post">
		<div ></div>
		<div class='tit'>Alterar Professor<br/><br/><br/></div>
		<table class="w3-table ">
		<tr><td><div class="td_al">Senha Atual:</div></td>
		<td><input  class="tam_input" type="password" name="senhaatl"  required></td></tr>

		<tr><td colspan="2"><hr/></td></tr>
		<tr><td align="right"><div >Nome:</div></td>
		<td><input id = "NomeDoUsuario" class="tam_input" type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" required></td></tr>
		<tr><td><div class="td_al">Sobrenome:</div></td>
		<td ><input id = "SobrenomeDoUsuario"  class="tam_input" type="text" name="sobrenome" value="<?php echo $_SESSION['sobrenome']; ?>" required></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td><div class="td_al" >Novo Email:</div></td>
		<td><input id = "NovoEmail"  class="tam_input" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" ></td></tr>
		<tr><td><div class =" td_al">Confirmar Email:</div></td>
		<td><input id = "ConfirmaNovoEmail"  class = "tam_input" type="email" name="Conf_email" value="<?php echo $_SESSION['email']; ?>" ></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td><div class="td_al">Nova Senha:</div></td>
		<td><input  class="tam_input" type="password" name="senha" ></td></tr>
		<tr><td><div class="td_al">Confirmar Senha:</div></td>
		<td><input  class="tam_input" type="password" name="Conf_senha" ></td></tr>
		<tr><td><br/></td></tr>
		<tr><td><br/></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>

		</table>
		<input type="submit" class="botao" name="enviar" value="Modificar"/>
		<input type="reset" name="resetar" class="botao2" value="Limpar"/>
		<div class="hr_fake"></div>
		</form>

</div>
		<?php
if($_POST){

$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
//Encontrar a senha atual do usuário no banco

$cod = $_SESSION['cod'];


/*
$sql2 = "select * from professor where cod='".$_SESSION['cod']."'";
$rs2 = mysqli_query($conexao,$sql2);
$num = mysqli_num_rows($rs2);
$k = 0;
if($num>0){

	while($row2 = mysqli_fetch_array($rs2)){
		$senhaNoBanco = $row2['senha'];
	}

}else{

}

Obs: A senha Atual está na seção atual
*/




$nome = $_REQUEST['nome'];
$sobrenome = $_REQUEST['sobrenome'];
$email = $_REQUEST['email'];

$senha = $_REQUEST['senha'];
$Conf_email = $_REQUEST['Conf_email'];
$Conf_senha = $_REQUEST['Conf_senha'];
$senhaatl = $_REQUEST['senhaatl'];
$sql = "";
$senhaCriptografada = crypt($senha,"xx");
$foiPreenchido = $_POST["senha"];




if($senha != ""){
	$sql = "UPDATE `professor` SET `nome`='$nome',`sobrenome`='$sobrenome',`email`='$email',`senha`='$senhaCriptografada' WHERE cod=$cod";
}else {
	$sql = "UPDATE `professor` SET `nome`='$nome',`sobrenome`='$sobrenome',`email`='$email'  WHERE cod=$cod";
}

if(crypt($senhaatl,"xx") == $_SESSION['senha']){
if($email == $Conf_email){
	if($senha == $Conf_senha){
		$rs = mysqli_query($conexao,$sql);

		if($rs){
		echo"<script>aparecer('alteradoComSucesso')</script>";

		$_SESSION['nome']= $nome;
		$_SESSION['sobrenome']= $sobrenome;
		$_SESSION['email']= $email;
		if($foiPreenchido){
			$_SESSION['senha'] = crypt($senha,"xx");
		}
	header("Location: div-tcc.php");

	echo "<script type='text/javascript'>   function atualizarFormulario() { document.getElementById('NomeDoUsuario').value = '$nome';  document.getElementById('nomeCabecalho').value = '$nome';	 document.getElementById('SobrenomeDoUsuario').value = '$sobrenome';	document.getElementById('NovoEmail').value = '$email';	document.getElementById('ConfimaNovoEmail').value = '$email'   } </script>";
	echo "<script> atualizarFormulario(); </script>";

}else{
	echo "<script>aparecer('erroAtualizar');</script>";
}
	}else{
		echo"<script>aparecer('confirmacaoSenha');</script>";
	}
}else{
	echo"<script>aparecer('confirmacaoEmail');</script>";
}
	}else{
		echo "<script>aparecer('SenhaAtual');</script>";
	}
mysqli_close($conexao);
}
?>
</body>
</html>
