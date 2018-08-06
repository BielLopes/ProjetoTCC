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
<body style="style=background: linear-gradient(white, green);
	background: -webkit-linear-gradient(white, green);
    background: -o-linear-gradient(white,green);
    background: -moz-linear-gradient(white,green);">


		<!-- Avisos de Midificar!!!-->
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
		<!--Fim dos Avisos de Midificar-->





<nav>
<ul class="w3-navbar w3-card-2 w3-black">
  <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Ajuda</a></li>
  <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Sobre</a></li>
  <li><a href="escola.php">Voltar</a></li>
    <li style="float:right"><a href="#news" onclick="aparecer('sa')">Sair </a></li>
  <li style="float:right"><a href="#"><?php echo $_SESSION['nome']; ?></a></li>

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
				if (y==true){
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
		<form name="cad_esc" method="post">
		<div ></div>
		<div class='tit'>Alterar Escola<br/><br/><br/></div>
		<table class="w3-table ">
		<tr><td><div class="td_al">Senha Atual:</div></td>
		<td><input  class="tam_input" type="password" name="senhaatl" required></td></tr>

		<tr><td colspan="2"><hr/></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Nome:</div></td>
		<td><input class="tam_input" id="NomeDoUsuario"  type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" required></td></tr>
		<tr><td><div class="td_al">CNPJ:</div></td>
		<td ><input  class="tam_input" id="CNPJ" type="text" name="cnpj" value="<?php echo $_SESSION['cnpj']; ?>" required></td></tr>
		<tr><td><div class="td_al" >Endereço:</div></td>
		<td><input id="CampoEndereco" class="tam_input" type="text" name="endereco" value="<?php echo $_SESSION['endereco']; ?>" required></td></tr>
		<tr><td><div class="td_al">Cidade:</div></td>
		<td><input  id="CampoCidade" class="tam_input" type="text" name="cidade" value="<?php echo $_SESSION['cidade']; ?>" required></td></tr>
		<tr><td><div class="td_al">Estado:</div></td>
		<td><select class="tam_input" name="estado">
		<option <?php if($_SESSION['estado']=="ac"){echo "selected";}?> value="ac"  >Acre</option>
		<option <?php if($_SESSION['estado']=="al"){echo "selected";}?> value="al"  >Alagoas</option>
		<option <?php if($_SESSION['estado']=="ap"){echo "selected";}?> value="ap">Amapá</option>
		<option <?php if($_SESSION['estado']=="am"){echo "selected";}?> value="am">Amazonas</option>
		<option <?php if($_SESSION['estado']=="ba"){echo "selected";}?> value="ba">Bahia</option>
		<option <?php if($_SESSION['estado']=="ce"){echo "selected";}?> value="ce">Ceará</option>
		<option <?php if($_SESSION['estado']=="df"){echo "selected";}?> value="df">Distrito Federal</option>
		<option <?php if($_SESSION['estado']=="es"){echo "selected";}?> value="es">Espirito Santo</option>
		<option <?php if($_SESSION['estado']=="go"){echo "selected";}?> value="go">Goiás</option>
		<option <?php if($_SESSION['estado']=="ma"){echo "selected";}?> value="ma">Maranhão</option>
		<option <?php if($_SESSION['estado']=="mt"){echo "selected";}?> value="mt">Mato Grosso</option>
		<option <?php if($_SESSION['estado']=="ms"){echo "selected";}?> value="ms">Mato Grosso do Sul</option>
		<option <?php if($_SESSION['estado']=="mg"){echo "selected";}?> value="mg">Minas Gerais</option>
		<option <?php if($_SESSION['estado']=="pa"){echo "selected";}?> value="pa">Pará</option>
		<option <?php if($_SESSION['estado']=="pb"){echo "selected";}?> value="pb">Paraíba</option>
		<option <?php if($_SESSION['estado']=="pr"){echo "selected";}?> value="pr">Paraná</option>
		<option <?php if($_SESSION['estado']=="pe"){echo "selected";}?> value="pe">Pernabuco</option>
		<option <?php if($_SESSION['estado']=="pi"){echo "selected";}?> value="pi">Piauí­</option>
		<option <?php if($_SESSION['estado']=="rj"){echo "selected";}?> value="rj">Rio de Janeiro</option>
		<option <?php if($_SESSION['estado']=="rn"){echo "selected";}?> value="rn">Rio Grande do Norte</option>
		<option <?php if($_SESSION['estado']=="rs"){echo "selected";}?> value="rs">Rio Grande do Sul</option>
		<option <?php if($_SESSION['estado']=="ro"){echo "selected";}?> value="ro">Rondônia</option>
		<option <?php if($_SESSION['estado']=="rr"){echo "selected";}?> value="rr">Roraima</option>
		<option <?php if($_SESSION['estado']=="sc"){echo "selected";}?> value="sc">Santa Catarina</option>
		<option <?php if($_SESSION['estado']=="sp"){echo "selected";}?> value="sp">Sã	o Paulo</option>
		<option <?php if($_SESSION['estado']=="se"){echo "selected";}?> value="se">Sergipe</option>
		<option <?php if($_SESSION['estado']=="to"){echo "selected";}?> value="to">Tocantins</option>
		</select></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Novo Email:</div></td>
		<td><input id="NovoEmail"  class="tam_input" type="email" name="email" value="<?php echo $_SESSION['email']; ?>" ></td></tr>
		<tr><td><div class="td_al">Confirmar Email:</div></td>
		<td><input id="ConfimaNovoEmail"  class="tam_input" type="email" name="Conf_email" value="<?php echo $_SESSION['email']; ?>" ></td></tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Nova Senha:</div></td>
		<td><input  class="tam_input" type="password" name="senha" ></td></tr>
		<tr><td><div class="td_al">Confirmar Senha:</div></td>
		<td><input  class="tam_input" type="password" name="Conf_senha" ></td></tr>
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



$nome = $_REQUEST['nome'];
$cnpj = $_REQUEST['cnpj'];
$email = $_REQUEST['email'];
$endereco = $_REQUEST['endereco'];
$cidade = $_REQUEST['cidade'];
$estado = $_REQUEST['estado'];
$senha = $_REQUEST['senha'];
$Conf_email = $_REQUEST['Conf_email'];
$Conf_senha = $_REQUEST['Conf_senha'];
$senhaatl = $_REQUEST['senhaatl'];


$sen = $_SESSION['senha'];
$cod = $_SESSION['cod'];

$senhaAtualCrypto = crypt($senhaatl,"xx");
$senhaCrypto = crypt($senha,"xx");


$foiPreenchido = $_POST["senha"];
$sql = "";


if($foiPreenchido){
	$sql = "UPDATE `escola` SET `nome`='$nome',`cnpj`='$cnpj',`cidade`='$cidade',`endereco`='$endereco',`estado`='$estado',`email`='$email',`senha`='$senhaCrypto' WHERE cod =$cod";
}else{
	$sql = "UPDATE `escola` SET `nome`='$nome',`cnpj`='$cnpj',`cidade`='$cidade',`endereco`='$endereco',`estado`='$estado',`email`='$email',`senha`='$senhaAtualCrypto' WHERE cod =$cod";
}


if($senhaAtualCrypto == $sen){
	if($email==$Conf_email){
		if($senha==$Conf_senha){
		$rs = mysqli_query($conexao,$sql);

		if($rs){
		echo"<script>aparecer('alteradoComSucesso')</script>";

		$_SESSION['nome']= $nome;
		$_SESSION['cnpj']= $cnpj;
		$_SESSION['cidade']= $cidade;
		$_SESSION['estado']= $estado;
		$_SESSION['endereco']= $endereco;
		$_SESSION['email']= $email;
		if($foiPreenchido){
			$_SESSION['senha']= $senhaCrypto;
		}


		echo "<script type='text/javascript'>   function atualizarFormulario() { document.getElementById('NomeDoUsuario').value = '$nome';  document.getElementById('CampoEndereco').value = '$endereco';	 document.getElementById('CNPJ').value = '$cnpj';	document.getElementById('NovoEmail').value = '$email';	document.getElementById('ConfimaNovoEmail').value = '$email';   	document.getElementById('CampoCidade').value = '$cidade';} </script>";
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
