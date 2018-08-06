<html>
<head>
<link rel="stylesheet" href="Css/calendar.css">
<link rel="stylesheet" href="Css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
<link rel="stylesheet" href="Css/w3.css">
</head>

<body>
<?php
$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";

$codigoD = $_GET["cod"];
$codigoP = $_GET["prof"];
$codigoE = $_GET["esc"];

if(!isset($codigoD)||!isset($codigoE)||!isset($codigoP)){
	header("Location:inicial.php");
	exit;
}

?>

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

<nav>
<ul class="w3-navbar w3-card-2 w3-black">
  <li><a href="index.php" class="w3-white"><img src="imagens/home.png" style="width:19px;margin-bottom:-2px;"> Página Principal</a></li>
 <li><a href="#" onclick="document.getElementById('contatos').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('sobre').style.display='block'">Sobre</a></li>
  <li class="w3-right">
    <div class="w3-dropdown-click">
  <button onclick="myFunction3()" class="w3-btn">Login</button>
  <div id="Demo" class="w3-dropdown-content w3-animate-zoom w3-black w3-card-4" style="z-index:5;">
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

<span>
<form method="post">
<div style="width:100%;height:28px;;padding-left:35px;">
 <font style="text-transform:uppercase;text-decoration:underline;font-size:29px;">
 <?php
 $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$sql = "select * from disciplina where cod_disc='$codigoD' and cod_prof='$codigoP' and cod_esc='$codigoE'";
$rs = mysqli_query($conexao,$sql);
if(mysqli_num_rows($rs)==1){
	$row = mysqli_fetch_array($rs);
	echo $row['nome'];
}else{
	echo "Desculpe-nos mas estamos com problema para obter o nome da Disciplina!";
}
 ?></font>

 <span style="right:15px;position:absolute;margin-top:4px;">
Email do Aluno:
<input type="email" name="email"></input>
<input type="submit" value="Cadastrar" class="btn2"></input>
<input type="hidden"  name="tipo" value="email">
</div>
</form>
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

if(empty($_REQUEST['tipo'])){}else{
	if($_REQUEST['tipo'] == 'email'){
$email = $_REQUEST['email'];
$sqlValidar = "select * from alunos where cod_disc='$codigoD' and email='$email'";
$rValidar = mysqli_query($conexao,$sqlValidar);
$numC = mysqli_num_rows($rValidar);
if($numC>0){
	echo "<script>alert('Email já cadastrado nesta Disciplina!')</script>";
}else{
	$sqlInsert = "INSERT INTO `alunos` VALUES ('$email','$codigoD')";
if($rInsert = mysqli_query($conexao,$sqlInsert)){
echo "<script>alert('Email cadastrado com sucesso!')</script>";
}else{
echo "<script>alert('Falha ao cadastrar email!')</script>";
}
}
	}
}
?>
</span>
<div class="w3-content" style="max-width:100%;position:relative;border-bottom:solid 1px black;padding-bottom:50px;margin-top:0;background: #eee;">

<section class="mySlides">
<?php
 $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$sql2 = "select * from atividades where cod_disc='$codigoD'";
$rs2 = mysqli_query($conexao,$sql2);
$num = mysqli_num_rows($rs2);
$k = 0;
if($num>0){
	while($row2 = mysqli_fetch_array($rs2)){
		$datas[$k]=$row2['data'];
		$tipo[$k]=$row2['tipo'];
		$dia[$k] = substr($datas[$k],8);
		$mes[$k] = substr($datas[$k],5,2);
		$k++;
	}
}else{

}
mysqli_close($conexao);
	?>

<div class="month">
  <ul>
    <li style="text-align:center">
      Janeiro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
  <?php
    $x = 0;

  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

for($cont2=1;$cont2<=31;$cont2++){
$obina = "select count(*) from atividades where cod_disc='$codigoD' and data= '2017-01-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="01" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);


echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>
</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Fevereiro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=28;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-02-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="02" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";

?>

</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Março<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
<?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-03-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="03" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>

</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Abril<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-04-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="04" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>
</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Maio<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-05-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="05" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>
</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Junho<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

<?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-06-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="06" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);


?>
  </ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Julho<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-07-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="07" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
?>
</ul>
</section>

<section class="mySlides" >

<div class="month">
  <ul>
    <li style="text-align:center">
      Agosto<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-08-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="08" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>
</ul>
</section>

<section class="mySlides" >

<div class="month">
  <ul>
    <li style="text-align:center">
      Setembro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-09-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="09" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>

  </ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Outubro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
 <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;

for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-10-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="10" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>

</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Novembro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">

<?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-11-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="11" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>

</ul>
</section>

<section class="mySlides">

<div class="month">
  <ul>
    <li style="text-align:center">
      Dezembro<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


<ul class="weekdays">
  <li>D</li>
  <li>S</li>
  <li>T</li>
  <li>Q</li>
  <li>Q</li>
  <li>S</li>
  <li>S</li>
</ul>

<ul class="days">
  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$codigoD."' and data= '2017-12-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil= mysqli_fetch_array($ra);

if($brasil["count(*)"]<2){
	for($cont=0;$cont<$num;$cont++){
  if($mes[$cont]=="12" && $dia[$cont]==$cont2){
	 if($tipo[$cont]==1){
	 echo "<li><span class='hov trab'> ".$cont2." </span></li>";
	 $x=1;
  }
  if($tipo[$cont]==2){
	 echo "<li><span class='hov prov'> ".$cont2." </span></li>";
	$x=1;
  }
  if($tipo[$cont]==3){
	 echo "<li><span class='hov atv_av'> ".$cont2." </span></li>";
	$x=1;
  }
  }
	}
}else{
	 echo "<li><span class='hov divers'> ".$cont2." </span></li>";
	$x=1;
}
if($x==0){echo "<li><span class='hov'> ".$cont2." </span></li>";}
$x=0;
}
mysqli_close($conexao);

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
?>
</ul>
</section>

<a class="btnNP" style="position:absolute;top:10%;left:7" onclick="plusDivs(-1)"><</a>
<a class="btnNP" style="position:absolute;top:10%;right:7" onclick="plusDivs(1)">></a>

</div>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
</script>
 <section class="w3-row">
   <div name="atividades" class="w3-twothird w3-container w3-pale-blue w3-leftbar w3-border-blue w3-responsive" style="overflow-y: scroll;min-height:28%;height:32%;">
   <table class="w3-table ">
<tr>
  <th>Atividade</th>
  <th>Horário</th>
  <th>Local</th>
  <th>Data</th>
</tr>
<?php
 $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$sql2 = "select * from atividades where cod_disc='$codigoD'";
$rs2 = mysqli_query($conexao,$sql2);
if(mysqli_num_rows($rs2)>0){
	while($row2 = mysqli_fetch_array($rs2)){
	echo "<tr><td>".$row2['descricao']."</td>";
	echo "<td>".$row2['hora']."</td>";
	echo "<td>".$row2['local']."</td>";
	echo "<td>".date("d-m-Y",strtotime($row2['data']))."</td></tr>";
	}
}else{
	echo "<tr><td colspan=4 style='font-size:25px;'><br/>Nenhuma atividade desta disciplina encontrada!</td></tr>";
}
mysqli_close($conexao);
	?>
</table>
</div>
  <div class="w3-container w3-third">
    <ul class="w3-ul" style="margin-top:5%;">
	<li class="w3-hover-red"><span class="circ w3-red"></span> Prova</li>
    <li class="w3-hover-green"><span class="circ w3-green"></span>Atividade Avaliativa</li>
    <li class="w3-hover-yellow"><span class="circ w3-yellow"></span>Entrega de Trabalho</li>
	<li class="w3-hover-purple"><span class="circ w3-purple"></span>Atividades diversas (Ex:Prova e Trabalho)</li>
  </ul>
  </div>
</section>
</body>

</html>
