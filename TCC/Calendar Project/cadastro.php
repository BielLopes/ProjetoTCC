<html>
<head>
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
</head>
<?php 
$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
?>
<script>
function Validar(evento, campo, mask) {  
		var tecla = (evento.which) ? evento.which : evento.keyCode;  
		if (tecla == 8){ 
		return true;
		}
		if (tecla != 46 && (tecla < 48 || tecla > 57)){ 
		return false;   
		}
		campo.maxLength = mask.length;  
		entrada = campo.value;  
		if (mask.length > entrada.length && mask.charAt(entrada.length) != '#') {  
		campo.value = entrada + mask.charAt(entrada.length);                 
		}  
		return true;  
		}
</script>
<body style="background: linear-gradient(white, green);
	background: -webkit-linear-gradient(white, green); 
    background: -o-linear-gradient(white,green); 
    background: -moz-linear-gradient(white,green);">

	
	
	
	<nav>
	
	
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
  <li><a href="index.php" class="w3-white"><img src="imagens/home.png" style="width:19px;margin-bottom:-2px;"> Página Principal</a></li>
  <li><a href="#" onclick="document.getElementById('contatos').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('sobre').style.display='block'">Sobre</a></li>
  <li class="w3-right">
    <div class="w3-dropdown-click">
  <button onclick="myFunction3()" class="w3-btn">Login</button>
  <div id="Demo" class="w3-dropdown-content w3-animate-zoom w3-black w3-card-4">
    <div class="w3-container w3-blue a">
  <h2>Login</h2>
</div>
<form class="w3-container a" method="post">
 <input type="hidden" name="tipo" value="login">
 <img src="imagens/login_icon.png" class="w3-circle tam">
<p>      
<label class="w3-label w3-text-white log_txt"><b>Nome de Usuário</b></label>
<input class="w3-input w3-border w3-sand inp" name="usuario" type="text"></p>

<p>      
<label class="w3-label w3-text-white log_txt"><b>Senha</b></label>
<input class="w3-input w3-border w3-sand inp" name="senha" type="password"></p>
<p>
<input type="submit" class="w3-btn w3-green button" value="Login"></p>
</form>
<?php 
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

if(empty($_REQUEST['tipo'])){}else{
	if($_REQUEST['tipo'] == "login"){
	If(empty($_REQUEST['usuario'])||empty($_REQUEST['senha'])){
		
	}else{
		$usuario = trim($_REQUEST['usuario']);
		$senha = trim(crypt($_REQUEST['senha'], "xx"));
		
		$sqlLoginEsc = "SELECT * FROM `escola` where usuario = '$usuario'"; 
		$sqlLoginProf = "SELECT * FROM `professor` where usuario = '$usuario'";
		$rsLoginEsc = mysqli_query($conexao,$sqlLoginEsc);
		$rsLoginProf = mysqli_query($conexao,$sqlLoginProf);
		if(mysqli_num_rows($rsLoginEsc)==1){
	    $row = mysqli_fetch_array($rsLoginEsc);
		if($senha == $row['senha']){
			session_start();
		$_SESSION['nome']=$row['nome'];
		$_SESSION['cod']=$row['cod'];	
		$_SESSION['cnpj']=$row['cnpj'];
		$_SESSION['email']=$row['email'];
		$_SESSION['usuario']=$row['usuario'];
		$_SESSION['estado']=$row['estado'];
		$_SESSION['endereco']=$row['endereco'];
		$_SESSION['cidade']=$row['cidade'];
		$_SESSION['senha']=$row['senha'];
			echo "<script>alert('Login efetuado com sucesso!');</script>";
		echo "<script>location.href='escola.php';</script>";
		}else{
			echo "<script>alert('Senha Incorreta!');</script>";
		}
		}
		if(mysqli_num_rows($rsLoginProf)==1){
		
	
	$row = mysqli_fetch_array($rsLoginProf);
	if($senha == $row['senha']){
			session_start();
		$_SESSION['nome']=$row['nome'];
		$_SESSION['disc2']='0';
		$_SESSION['cod']=$row['cod'];	
		$_SESSION['sobrenome']=$row['sobrenome'];
		$_SESSION['email']=$row['email'];
		$_SESSION['usuario']=$row['usuario'];
		$_SESSION['senha']=$row['senha'];

		echo "<script>alert('Login efetuado com sucesso!');</script>";
		echo "<script>location.href='div-tcc.php';</script>";
	}else{
			echo "<script>alert('Senha Incorreta!');</script>";
	}
		}
		if((mysqli_num_rows($rsLoginProf)<1)&&(mysqli_num_rows($rsLoginEsc)<1)){
		echo "<script>alert('Nome de Usuário não existe!');</script>";
		}
	}
}
}
mysqli_close($conexao);
?>
</div></div>
  </div>
</div>
<script>
function myFunction3() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

  </li>
  <li class="w3-right"><a href="#">Cadastrar</a></li>
</ul>
</nav>
<section>
<div class="w3-row">
<div class="w3-half tabela" align="center">
		<form name="cad_prof" method="post" action = "">
		<div class="hr_fake"></div>
		<div class='tit'>Cadastrar Professor</div>
		<table class="w3-table ">
		<tr><td></td></tr>
		
		<tr><td><div class="td_al">Nome:</div></td>
		<td><input class="tam_input" type="text" name="nome" required>
		<input class="tam_input" type="hidden" name="tipo" value="professor">
		</td></tr>
		
		<tr><td><div class="td_al">Sobrenome:</div></td>
		<td ><input  class="tam_input" type="text" name="sobrenome" required></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td><div class="td_al" >Email:</div></td>
		<td><input  class="tam_input" type="email" name="email" required></td></tr>	
		<tr><td><div class="td_al">Confirmar Email:</div></td>
		<td><input  class="tam_input" type="email" name="Conf_email" required></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>		
		<tr><td><div class="td_al">Nome de Usuário:</div></td>
		<td><input class="tam_input" type="text" name="usuario" required></td></tr>		
		<tr><td></td>		
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		<tr><td><div class="td_al">Senha:</div></td>
		<td><input  class="tam_input" type="password" name="senha" required></td></tr>
		<tr><td><div class="td_al">Confirmar Senha:</div></td>
		<td><input  class="tam_input" type="password" name="Conf_senha" required></td></tr>
		<tr><td><br/></td></tr>
		<tr><td><br/></td>
		<td></td></tr>
		<tr><td></td>
		<td></td></tr>
		
		</table>
		<input type="submit" class="botao" name="enviar" value="Cadastrar"/>
		<input type="reset" name="resetar" class="botao2" value="Limpar"/>
		<div class="hr_fake"></div>
		</form>
</div>
<div class="w3-half tabela2" align="center">
		<form name="cad_esc" method="post">
		<div class="hr_fake"></div>
		<div class='tit'>Cadastrar Escola</div>
		<table class="w3-table ">
		<tr><td></td></tr>
		<tr><td><div class="td_al">Nome:</div></td>
		<td><input class="tam_input" type="text" name="nomeesc" required>
		<input class="tam_input" type="hidden" name="tipo" value="escola"></td></tr>
		<tr><td><div class="td_al">CNPJ:</div></td>
		<td ><input  class="tam_input" type="text" onkeypress="return Validar(event, this, '##.###.###/####-##')" name="cnpj" required></td></tr>
		<tr><td><div class="td_al" >Endereço:</div></td>
		<td><input  class="tam_input" type="text" name="endereco" required></td></tr>
		<tr><td><div class="td_al">Cidade:</div></td>
		<td><input  class="tam_input" type="text" name="cidade" required></td></tr>
		<tr><td><div class="td_al">Estado:</div></td>
		<td><select class="tam_input" name="estado">
		<option value="ac" >Acre</option>
		<option value="al">Alagoas</option>
		<option value="ap">Amapá</option>
		<option value="am">Amazonas</option>
		<option value="ba">Bahia</option>
		<option value="ce">Ceará</option>
		<option value="df">Distrito Federal</option>
		<option value="es">Espirito Santo</option>
		<option value="go">Goiás</option>
		<option value="ma">Maranhão</option>
		<option value="mt">Mato Grosso</option>
		<option value="ms">Mato Grosso do Sul</option>
		<option value="mg">Minas Gerais</option>
		<option value="pa">Pará</option>
		<option value="pb">Paraíba</option>
		<option value="pr">Paraná</option>
		<option value="pe">Pernabuco</option>
		<option value="pi">Piauí­</option>
		<option value="rj">Rio de Janeiro</option>
		<option value="rn">Rio Grande do Norte</option>
		<option value="rs">Rio Grande do Sul</option>
		<option value="ro">Rondônia</option>
		<option value="rr">Roraima</option>
		<option value="sc">Santa Catarina</option>
		<option value="sp">São Paulo</option>
		<option value="se">Sergipe</option>
		<option value="to">Tocantins</option>
		</select></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Email:</div></td>
		<td><input  class="tam_input" type="email" name="emailesc" required></td></tr>
		<tr><td><div class="td_al">Confirmar Email:</div></td>
		<td><input  class="tam_input" type="email" name="conf_emailesc" required></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Nome de Usuário:</div></td>
		<td><input class="tam_input" type="text" name="usuarioesc" required></input></td></tr>
		<tr><td></td></tr>
		<tr><td><div class="td_al">Senha:</div></td>
		<td><input  class="tam_input" type="password" name="senhaesc" required></td></tr>
		<tr><td><div class="td_al">Confirmar Senha:</div></td>
		<td><input  class="tam_input" type="password" name="conf_senhaesc" required></td></tr>
		</table>
		<input type="submit" class="botao" name="enviar" value="Cadastrar"/>
		<input type="reset" name="resetar" class="botao2" value="Limpar"/>
		<div class="hr_fake"></div>
		</form>
</div>
</div>
</section>
<?php
if($_POST){
	if($_POST['tipo']=='professor'){
$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
	

$nome = trim(addslashes($_REQUEST['nome']));
$sobrenome = trim(addslashes($_REQUEST['sobrenome']));
$email = trim(addslashes($_REQUEST['email']));
$usuario = trim(addslashes($_REQUEST['usuario']));
$senha = trim(crypt($_REQUEST['senha'], "xx"));
$Conf_email = trim(addslashes($_REQUEST['Conf_email']));
$Conf_senha = trim(crypt($_REQUEST['Conf_senha'], "xx"));

$sql2="SELECT count(*) FROM `professor` WHERE usuario = '$usuario'";

$ri = mysqli_query($conexao,$sql2);
$count = 0;
while($row = mysqli_fetch_array($ri)){
	$count1 = $row['count(*)'];
}

$sql3="SELECT count(*) FROM `escola` WHERE usuario = '$usuario'";

$ra = mysqli_query($conexao,$sql3);
$count = 0;
while($row = mysqli_fetch_array($ra)){
	$count2 = $row['count(*)'];
}

if(($count1==0) && ($count2==0)){
$sql="INSERT INTO `professor`(`cod`, `nome`, `sobrenome`, `email`, `usuario`, `senha`) VALUES (null,'$nome','$sobrenome','$email','$usuario','$senha')";

if($email==$Conf_email){
	if($senha==$Conf_senha){
		$rs = mysqli_query($conexao,$sql);
		mysqli_close($conexao);
echo"<script>alert('Cadastrado com sucesso!')</script>";
	}else{
		echo"<script>alert('Confirmação de Senha Incorreta')</script>";
	}
}else{
		echo"<script>alert('Confirmação de Email Incorreto')</script>";
	
}
}else{
		echo"<script>alert('Nome de Usuario já utilizada')</script>";
}
		
	}
	else if($_REQUEST['tipo']=='escola'){

	$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
	

$nome = trim(addslashes($_REQUEST['nomeesc']));
$cnpj = trim(addslashes($_REQUEST['cnpj']));
$endereco = trim(addslashes($_REQUEST['endereco']));
$cidade = trim(addslashes($_REQUEST['cidade']));
$estado = trim(addslashes($_REQUEST['estado']));
$email = trim(addslashes($_REQUEST['emailesc']));
$usuario = trim(addslashes($_REQUEST['usuarioesc']));
$senha = trim(crypt($_REQUEST['senhaesc'], "xx"));
$Conf_email = trim(addslashes($_REQUEST['conf_emailesc']));
$Conf_senha = trim(crypt($_REQUEST['conf_senhaesc'], "xx"));
$cod_esc = rand(10000000,99999999);

$sql20="SELECT count(*) FROM `professor` WHERE usuario = '$usuario'";

$rg = mysqli_query($conexao,$sql20);
$count1 = 0;
while($row = mysqli_fetch_array($rg)){
	$count1 = $row['count(*)'];

}

$sql30="SELECT count(*) FROM `escola` WHERE usuario = '$usuario'";

$rk = mysqli_query($conexao,$sql30);
$count2 = 0;
while($row = mysqli_fetch_array($rk)){
	$count2 = $row['count(*)'];
}

if(($count1==0) && ($count2==0)){
	
$sql3="INSERT INTO `escola` VALUES('$cod_esc','$nome','$cnpj','$cidade','$endereco','$estado','$email','$usuario','$senha')";

if($email==$Conf_email){
	if($senha==$Conf_senha){
		$rs = mysqli_query($conexao,$sql3);
		mysqli_close($conexao);
echo"<script>alert('Cadastrado com sucesso!')</script>";
	}else{
		echo"<script>alert('Confirmação de Senha Incorreta')</script>";
	}
}else{
		echo"<script>alert('Confirmação de Email Incorreto')</script>";
	
}
}else{
		echo"<script>alert('Nome de Usuario já utilizada')</script>";
}
		
	}
}
?>



</body>


</html>
			