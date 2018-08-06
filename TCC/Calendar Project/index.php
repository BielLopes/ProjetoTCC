<html>
<head>
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
<title>Calendário Escolar</title>
</head>

<body>

<?php
$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
?>

<!--Avisos de Login-->
<div id="LoginIncorreto" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="sumir('LoginIncorreto')" class="w3-closebtn">&times;</span>
      <p><h2>Nome de Usuário ou Senha INCORREO!!!</h2></p>
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



<script language="Javascript">
function sumir(i) {
    document.getElementById(i).style.display = "none";
}

function aparecer(i) {
    document.getElementById(i).style.display = "initial";

}
</script>

<nav>
<ul class="w3-navbar w3-card-2 w3-black">
  <li><a href="index.php" class="w3-grey"><img src="imagens/home.png" style="width:19px;margin-bottom:-2px;"> Página Principal</a></li>
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

		echo "<script>location.href='escola.php';</script>";
		}else{
			echo "<script>aparecer('LoginIncorreto');</script>";
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

		echo "<script>location.href='div-tcc.php';</script>";
	}else{
			echo "<script>aparecer('LoginIncorreto');</script>";
	}
		}
		if((mysqli_num_rows($rsLoginProf)<1)&&(mysqli_num_rows($rsLoginEsc)<1)){
		echo "<script>aparecer('LoginIncorreto');</script>";
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

  <li class="w3-right"><a href="cadastro.php">Cadastrar</a></li>
</ul>
</nav>
<section>
<div class="w3-content w3-section" style="max-width:1300px">
  <img class="mySlides not_img" src="imagens/f1.jpg" >
  <img class="mySlides not_img" src="imagens/f2.jpg" >
  <img class="mySlides not_img" src="imagens/fundo.png" >
</div>
<div style="text-align:center">
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";
    }
    slideIndex++;

    if (slideIndex> slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 4000);
	}
</script>
</section>
<br/>
<form method="post" action="#final">
<input type="hidden" name="tipo" value="pesquisa">
<section id="servicos">
	</br>
	    <table border="0" width="100%">
		<tr>
			<td width="33%" class="color_text" align=right><input type="radio" name="op" value="v1" checked> Disciplina   </td>
			<td width="33%" class="color_text" align=center><input type="radio" name="op" value="v2"> Professor    </td>
			<td width="33%" class="color_text"><input type="radio" name="op" value="v3"></input>  Escola   </td>
		</tr>
		</table>
		<div class="search_bar2">
<input id="pesquisa2" type="text" name="pesq" placeholder="Pesquisar"></input>

<a href="#pesquisar"><input type="submit" value="Pesquisar" class="btn_search"></a>
</div>
<div id="resultado" style="display:none;">
Resultado
<span onclick="sumir('resultado')" class="y3">x</span>
<a name="pesquisar"></a>
  <ul class="w3-ul w3-card-4 w3-hoverable" style="margin-top:7px;cursor:pointer;text-align:left;">
  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['tipo'])){}else{
	if($_REQUEST['tipo'] == "pesquisa"){
if(empty($_REQUEST['pesq'])){

}else{
	$pesquisa = $_REQUEST['pesq'];
$opcao = $_REQUEST['op'];
if($opcao=="v1"){
$sql="SELECT disciplina.nome as disc, professor.nome as prof,professor.sobrenome as sobr, escola.nome as esc,disciplina.cod_disc as cod,disciplina.cod_prof as codP,disciplina.cod_esc as codE FROM disciplina inner join professor on disciplina.cod_prof = professor.cod INNER join escola on disciplina.cod_esc = escola.cod where disciplina.nome like '%$pesquisa%'";
}
if($opcao=="v2"){
$sql="SELECT disciplina.nome as disc, professor.nome as prof, escola.nome as esc,professor.sobrenome as sobr,disciplina.cod_disc as cod,disciplina.cod_prof as codP,disciplina.cod_esc as codE FROM disciplina inner join professor on disciplina.cod_prof = professor.cod INNER join escola on disciplina.cod_esc = escola.cod where professor.nome like '%$pesquisa%'";
}
if($opcao=="v3"){
$sql="SELECT disciplina.nome as disc, professor.nome as prof, escola.nome as esc,disciplina.cod_disc as cod,professor.sobrenome as sobr,disciplina.cod_prof as codP,disciplina.cod_esc as codE FROM disciplina inner join professor on disciplina.cod,disciplina.cod_prof as codP,disciplina.cod_esc as codE_prof = professor.cod INNER join escola on disciplina.cod_esc = escola.cod where escola.nome like '%$pesquisa%'";
}
$rs = mysqli_query($conexao,$sql);
$num_registros = mysqli_num_rows($rs);
if(empty($pesquisa)){}else{
if($num_registros>0){
while($row = mysqli_fetch_array($rs)){
	echo "<li style='border-bottom:solid white 1px;' onclick=redirecionar(".$row['cod'].",".$row['codP'].",".$row['codE'].")>";
    echo "<span class='w3-large'>Disciplina: ".$row['disc']."</span><br>";
    echo "<span>Professor: ".$row['prof']." ".$row['sobr']."<br/> Escola: ".$row['esc']."</span>";
  echo"</li>";
	}
}else{
   echo "<br/><br/><span class='w3-xlarge' style='padding-left:20%;'>Registro não encontrado! Verifique o nome e tente novamente!</span><br/><br/><br/><br/>";
}
}
echo "<script>aparecer('resultado')</script>";
}
}}
mysqli_close($conexao);
?>
<script>
function redirecionar(c,p,e){
	location.href=("calendario.php?cod="+c+"&prof="+p+"&esc="+e);
}
</script>
</ul>
</div>
	</section>

	</form>
	<a name="final"></a>
	</body>


</html>
