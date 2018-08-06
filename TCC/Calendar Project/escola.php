<html>
<head>
<link rel="stylesheet" href="Css/calendar.css">
<link rel="stylesheet" href="Css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
<link rel="stylesheet" href="Css/w3.css">
</head>
<body>
<?php

require('verificar.php');

$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";


?>

<script language="Javascript">
function sumir(i) {
    document.getElementById(i).style.display = "none";
}

function aparecer(i) {
    document.getElementById(i).style.display = "initial";
}
</script>


<style rel="stylesheet" type="text/css">
body{
background-image: linear-gradient(to bottom, white, green);
}
</style>

<!--Avisos de Aceitar Professor-->
<div id="professorDinsvinculado" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="sumir('professorDinsvinculado')" class="w3-closebtn">&times;</span>
      <p><h2>Professor Desvinculado com Sucesso!</h2></p>
       </div>
  </div>
</div>

<div id="professorNaoDisvinculado" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="sumir('professorNaoDisvinculado')" class="w3-closebtn">&times;</span>
      <p><h2>Falha ao Desvincular Professor!</h2></p>
       </div>
  </div>
</div>

<div id="professorAceito" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="sumir('professorAceito')" class="w3-closebtn">&times;</span>
      <p><h2>Professor Aceito!</h2></p>
       </div>
  </div>
</div>
<!--FIM-->






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
  <li><a href="#" onclick="document.getElementById('contatos').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('sobre').style.display='block'">Sobre</a></li>

   <li style="float:right"><a href="#news" onclick="sair()">Sair </a></li>
   <li style="float:right"><a href="alterarescola.php">Alterar Dados</a></li>
   <li style="float:right"> <a href="#"><?php echo $_SESSION['nome']; ?> </a></li>
   </ul>
</nav>

<div id="conf">
	  <form method="post" align="center" name="cf">
	  <input class="tam_input" type="hidden" id="tip" name="tipo">
	  <input class="tam_input" type="hidden" name="tipo2" value="confirmar">

  <?php

	$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
	if(empty($_REQUEST['tipo2'])){}else{
		if($_REQUEST['tipo2'] == 'confirmar'){
	if(empty($_REQUEST['tipo'])){}else{
		$cod_prof = $_REQUEST['tipo'];
			$sqlConf = "UPDATE `professores_cadastrados` SET `situacao`=1 WHERE cod_prof=$cod_prof and cod_escola='".$_SESSION['cod']."'";
		$rsConf = mysqli_query($conexao,$sqlConf);
		if($rsConf){
			echo "<script>aparecer('professorAceito')</script>";
		}else{
			echo "Falha";
		}
	}
		}
	}
  ?>
</form>
  </div>
  <div id="del">
	  <form method="post" align="center" name="dl">
	  <input class="tam_input" type="hidden" name="dele">
	  <input class="tam_input" type="hidden" name="neg" value="negar">
<?php

	$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

	if(empty($_REQUEST['neg'])){}else{
		if($_REQUEST['neg'] == 'negar'){
	if(empty($_REQUEST['dele'])){}else{
		$cod2 = $_REQUEST['dele'];

		$sqlDel = "DELETE FROM `professores_cadastrados` WHERE cod_prof=$cod2 and cod_escola='".$_SESSION['cod']."'";
		$rsDel = mysqli_query($conexao,$sqlDel);
		if($rsDel){
			echo "Negado!";
		}else{
			echo "Falha!";
		}
	}
		}
	}
  ?>

	  </div>

	  <div id="profs" class="w3-modal">
  <div class="w3-modal-content w3-round-xlarge">
    <div class="w3-container ">
      <span onclick="document.getElementById('profs').style.display='none'" class="w3-closebtn" style="color:red">&times;</span>
      <div class="w3-container a">
  <h2>Deseja realmente Desvincular esse Professor?</h2>
</div>
      <form method="post" name="professores">
	  <input type="submit" class="b1" value="Sim" style="margin-bottom:2%;">
	  <input type="button"  class="b1" value="Não" onclick="document.getElementById('profs').style.display='none'">
	  <input type="hidden" name="cfm" value="y">
	  <input type="hidden" name="codP" id="fcdd">
	  </form>

<?php
if(!empty($_REQUEST['cfm'])){
	if($_REQUEST['cfm']=='y'){
		if(!empty($_REQUEST['codP'])){
		$codP = $_REQUEST['codP'];
		$codE = $_SESSION['cod'];
		$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}

$sqlDem = "DELETE FROM `professores_cadastrados` WHERE cod_prof=$codP and cod_escola='$codE'";
if($rsDem = mysqli_query($conexao,$sqlDem)){
echo "<script>aparecer('professorDinsvinculado');</script>";
}else{echo "<script>aparecer('professorNaoDisvinculado');</script>";}

	}
	}
	}
?>
	  </div>
  </div>
</div>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&times;</span>
      <p>Some text.Some text. Some text.</p>
      <p>Some text. Some text. Some text.</p>
    </div>
  </div>
</div>

<section>
<h1 align="center">Confirmar Professores</h1>
<div class="c">
<ul class="w3-ul w3-card-4">
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$cod_esc = $_SESSION['cod'];
$sql = "SELECT professor.cod,professor.email,professor.nome,professor.sobrenome FROM `professor`";
$sql = $sql." inner join professores_cadastrados on professor.cod = professores_cadastrados.cod_prof";
$sql = $sql." inner join escola on escola.cod = professores_cadastrados.cod_escola";
$sql = $sql." where professores_cadastrados.situacao = 0 and escola.cod = '$cod_esc'";
$rs = mysqli_query($conexao,$sql);
if(mysqli_num_rows($rs)>0){
	while($row = mysqli_fetch_array($rs)){
	echo "<li class='w3-padding-16' style='border-bottom:solid white 1px;'>";
	echo "<span onclick=delet(this) class='w3-closebtn w3-padding' id='".$row['cod']."'>x</span>";
	echo "<img src='imagens/icon-ok.png' onclick=confirmar(this)  class='w3-right w3-circle btnC' name='".$row['cod']."'>";
    echo "<img src='imagens/img_avatar2.png' class='w3-left w3-circle' style='width:60px;margin-right:15px;'>";
    echo "<span class='w3-xlarge'>".$row['nome']." ".$row['sobrenome']."</span><br>";
    echo "<span>".$row['email']."</span>";
  echo "</li>";
	}
}
mysqli_close($conexao);
?>
<script>
            function confirmar(i){
                var cod = i.name;
				document.getElementById('tip').value = cod;
				x = confirm("Confirmar?");
				if (x==true){
				document.cf.submit();
				}
			}
			function delet(j){
                var cod2 = j.id;
				document.dl.dele.value=cod2;
				y = confirm("Confirmar?");
				if (y==true){
				document.dl.submit();
				}

			}
function sair(){
	document.getElementById('sa').style.display='block';
}
function solic(w,z) {
	document.getElementById('fcdd').value = z;
	var xs = document.getElementById('fcdd').value;
	document.getElementById('profs').style.display='initial';
}
</script>
</ul>
</div>
<h1 align="center">Professores</h1>
<div class="c">
<ul class="w3-ul w3-card-4">
  <?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}$cod_esc = $_SESSION['cod'];
$sql = "SELECT professor.cod,professor.email,professor.nome,professor.sobrenome FROM `professor`";
$sql = $sql." inner join professores_cadastrados on professor.cod = professores_cadastrados.cod_prof";
$sql = $sql." inner join escola on escola.cod = professores_cadastrados.cod_escola";
$sql = $sql." where professores_cadastrados.situacao = 1 and escola.cod = '$cod_esc'";
$rs = mysqli_query($conexao,$sql);
if(mysqli_num_rows($rs)>0){
	while($row = mysqli_fetch_array($rs)){
	echo "<li class='w3-padding-16' style='border-bottom:solid white 1px;'>";
    echo "<img src='imagens/remove.png' onclick=solic('profs','".$row['cod']."') class='w3-right w3-circle btnD'>";
    echo "<img src='imagens/img_avatar2.png' class='w3-left w3-circle' style='width:60px;margin-right:15px;'>";
    echo "<span class='w3-xlarge'>".$row['nome']." ".$row['sobrenome']."</span><br>";
    echo "<span>".$row['email']."</span>";
  echo "</li>";
	}
}
mysqli_close($conexao);
?>

</ul>
</div>
</section>

<br/>
<br/>
</body>
</html>
