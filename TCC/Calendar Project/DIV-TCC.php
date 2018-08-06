<html>
<head>
<link rel="stylesheet" href="Css/calendar2.css">
<link rel="stylesheet" href="Css/cod.css">
<link rel="stylesheet" href="Css/normalize.css">
<link rel="stylesheet" href="Css/w3.css">
</head>
<body>


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


<?php

require('verificar.php');

$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
mysqli_close($conexao);
?>

<form name="salvacao" method="post" action="#calend">
  <input type="hidden" name="codigoDisciplina">
</form>
<?php
if(empty($_REQUEST['codigoDisciplina'])){}else{
	$_SESSION['disc2'] = $_REQUEST['codigoDisciplina'];
	 $f = 'initial';
}
?>
<nav>
<ul class="w3-navbar w3-card-2 w3-black">
  <li><a href="#" onclick="document.getElementById('contatos').style.display='block'">Contatos</a></li>
  <li><a href="#" onclick="document.getElementById('sobre').style.display='block'">Sobre</a></li>
   <li style="float:right"><a href="#news" onclick="aparecer('sa')">Sair </a></li>
	<li style="float:right"><a href="alterar.php">Alterar Dados</a></li>
	<li style="float:right"> <a href="#"><?php echo $_SESSION['nome']; ?> </a></li>

   </ul>
</nav>

<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&times;</span>
      <p>Some text.Some text. Some text.</p>
      <p>Some text. Some text. Some text.</p>
    </div>
  </div>
</div>
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
<div id="en" class="w3-modal w3-round-xlarge">
  <div class="w3-modal-content w3-round-xlarge">
    <div class="w3-container ">
      <span onclick="document.getElementById('sa').style.display='none'" class="w3-closebtn" style="color:red">&times;</span>
      <div class="w3-container a">
  <h2>Enviar Solicitação?</h2>
</div>
      <form method="post" name="env_solic">
	  <input type=submit class="b1" value=Sim>
	  <input type=button class="b1" value=Não onclick="document.getElementById('en').style.display='none'">
	  <input type=hidden name=conf value=y>
	  <input type=hidden name=codE>
	  </form>

<?php

if(empty($_REQUEST['conf'])){}else{
	if($_REQUEST['conf']=='y'){
		if(empty($_REQUEST['codE'])){

    }else{
		$codE = $_REQUEST['codE'];
		$codP = $_SESSION['cod'];

		$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
  $sqlV = "SELECT * FROM `professores_cadastrados` WHERE cod_prof=$codP and cod_escola='$codE'";
  $rsV = mysqli_query($conexao,$sqlV);
  if(mysqli_num_rows($rsV)>0){
    echo "<script>alert('Solicitação está em espera ou Solicitação já foi aceita!');</script>";
  }  else{
    $sqlSolic = "INSERT INTO `professores_cadastrados`(`cod_prof`, `cod_escola`, `situacao`) VALUES ($codP,'$codE',0)";
    if($rsSolic = mysqli_query($conexao,$sqlSolic)){
      echo "<script>alert('Solicitação Enviada com Sucesso!');</script>";
}else{
  echo "<script>alert('Falha ao Enviar Solicitação!');</script>";
        }
		}
    mysqli_close($conexao);
	}
	}
}
?>
	  </div>
  </div>
</div>
<div>
	  <form method="post" align="center" name="apagarD">
	  <input class="tam_input" type="hidden" name="tipo" value="excluirD">
	  <input class="tam_input" type="hidden" name="apag">
</div>
  <?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysqli_connect_error();
}

  if (empty($_POST['tipo'])){}else{
	  if($_POST['tipo']=='excluirD'){
  $codD = $_REQUEST['apag'];
  $sqlExcluirDisc = "DELETE FROM `disciplina` cod_disc='$codD'";
if($rExcluirDisc = mysqli_query($conexao,$sqlExcluirDisc)){
	echo "<script>alert('Disciplina excluída com sucesso!');</script>";
}else{
	echo "<script>alert('Erro ao excluír Disciplina! Verifique os dados e tente novamente!');</script>";
}

	  }
  }
  mysqli_close($conexao);
  ?>
</form>
  </div>


<br/>
<br/>

<style rel="stylesheet" type="text/css">
body{
background-image: linear-gradient(to bottom, white, green);
     background-attachment: fixed;

}

.frm {
    align-items: center;
    background-color:778899;
	width:94%;
	margin-left:3%;
	}

.form {
    align-items: center;
	display:none;
    background-color:778899;
	width:94%;
	margin-left:3%;
	}
	.form2 {
    align-items: center;
    background-color:778899;
	width:94%;
	margin-left:3%;
	}
	.form3 {
    align-items: center;
    background-color:778899;
	}
.x{
	color:#1C1C1C;
	}
	.y{
	color:white;
	}
	.y2{color:white;}
.y2:hover {
background-color:red;
	color:white;
	}
.y:hover {
background-color:#00FF00;
	color:white;
	}
.y3{
border:solid black 1px;float:right;
width:25px;text-align:center;
color:white;background:red;cursor:pointer;
height:25px;
}
.tam_mat{
font-size:150%;
}
</style>

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


<section class="sol">
<h3>Escolas</h3>
<div id="solicita2">
<ul class="w3-ul w3-card-4">
<?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysqli_connect_error();
}
$codigoProf = $_SESSION['cod'];

$sqlEsc = "SELECT escola.nome,escola.cod FROM `professores_cadastrados` INNER join escola on escola.cod = professores_cadastrados.cod_escola ";
$sqlEsc = $sqlEsc."inner join professor on professor.cod = professores_cadastrados.cod_prof where professores_cadastrados.situacao = 1 and professor.cod=$codigoProf";
$rsEsc = mysqli_query($conexao,$sqlEsc);
while($rowEsc = mysqli_fetch_array($rsEsc)){
echo "<li class='w3-padding-14' style='border-bottom:solid white 1px;'>";
echo $rowEsc['nome']." - ".$rowEsc['cod'];
echo "</li>";
}
mysqli_close($conexao);
?>

</ul>
</div>
<h3>Enviar Solicitações</h3>
<form method="post" action="#solict">
<div class="search_bar">
<input id="pesquisa2" type="text" name="pesquisar" placeholder="Pesquisar"></input>
<input type="submit" value="Pesquisar" class="btn_search">
</div>
</form>
<div id="s" style="display:none;">
<span onclick="sumir('s')" class="y3">x</span>
<div id="solicita">
<ul class="w3-ul w3-card-4">
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['pesquisar'])){

}else{
$pesquisa = $_REQUEST['pesquisar'];
$sql="SELECT * FROM escola where nome like '%$pesquisa%'";

$ri = mysqli_query($conexao,$sql);
$numR = mysqli_num_rows($ri);

if($numR>0){
while($row3 = mysqli_fetch_array($ri)){
	echo "<li class='w3-padding-16' style='border-bottom:solid white 1px;'>";
	echo "<span onclick=solic('en','".$row3['cod']."') class='w3-closebtn w3-padding env_tam' style='color:purple;' >Enviar</span>";
    echo "<span class='w3-large'>Escola: ".$row3['nome']."</span><br>";
    echo "<span>Cidade: ".$row3['cidade']."<br/> Endereço: ".$row3['endereco']."</span>";
    echo "</li>";
	}
}else{
   echo "<br/><br/><br/><br/><span class='w3-xlarge' style='padding-left:20%;'>Registro não encontrado! Verifique o nome e tente novamente!</span><br/><br/><br/><br/><br/><br/>";
}
echo"<script>aparecer('s')</script>";
echo "<a href='#pesquisar' clicked></a>";
}
mysqli_close($conexao);
?>
</ul>
</div>
</div>
</section>
<br/>
<br/>
<a name="solict"></a>
<table  border="1" cellpadding="0" width="80%" >
<tr>
<td width="50%" align="center"><a href="#adicionar"><input type="submit" class="botao" name="a" value="Adicionar Disciplina" onclick="aparecer('div2')"/></a></td>
<td width="50%" align="center"><a href="#modificar"><input type="submit" class="botao" name="b" value="Modificar Disciplina" onclick="aparecer('div3')"/></a></td>
</tr>
</table>

</br>
</br>
<br/>
<div class="form" id="div2">
<form method="post">
<table class="form2" border="1" cellpadding="10" width="80%" bgcolor="#778899">
<tr>
<td  bgcolor="#778899" class="x" align="Center" colspan="4" onclick="aparecer('div1')" width="90%"><b>Adicionar Disciplina</b></td>
<td  bgcolor="#696969" class="Y2" align="center" onclick="sumir('div2')">Fechar</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Nome:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" name="nomedisc"required></td>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Escola:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<a name="adicionar"></a>
<select class="tam_input" name="codesc">
<?php
  $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysqli_connect_error();
}
$codigoProf = $_SESSION['cod'];

$sqlEsc = "SELECT escola.nome,escola.cod FROM `professores_cadastrados` INNER join escola on escola.cod = professores_cadastrados.cod_escola ";
$sqlEsc = $sqlEsc."inner join professor on professor.cod = professores_cadastrados.cod_prof where professores_cadastrados.situacao = 1 and professor.cod=$codigoProf";
$rsEsc = mysqli_query($conexao,$sqlEsc);
if(mysqli_num_rows($rsEsc)>0){
while($rowEsc = mysqli_fetch_array($rsEsc)){
echo "<option value=".$rowEsc['cod']." >".$rowEsc['nome']."</option>";
}}
mysqli_close($conexao);
?>
</select>
</td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" rowspan="2" bgcolor="#778899" align="left">
<input type="submit" class="botao" name="enviar" value="Adicionar"  />
</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Código Disciplina:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" name="coddisc" onkeypress="return Validar(event, this, '#########');" required></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
</tr>
</table>
</form>
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['nomedisc'])||empty($_REQUEST['coddisc'])||empty($_REQUEST['codesc'])){

}else{
$nomedisc = addslashes($_REQUEST['nomedisc']);
$coddisc = addslashes($_REQUEST['coddisc']);
$codesc = addslashes($_REQUEST['codesc']);
$sqlValidar = "select cod_disc from disciplina where cod_disc='$coddisc'";
$rValidar = mysqli_query($conexao,$sqlValidar);
$numC = mysqli_num_rows($rValidar);
if($numC>0){
	echo "<script>alert('Codigo já cadastrado! Entre com outro valor!');</script>";
}else{
	$codP = $_SESSION['cod'];

$sqlInsert = "INSERT INTO `disciplina` VALUES ('$coddisc','$codP','$codesc','$nomedisc')";
if($rInsert = mysqli_query($conexao,$sqlInsert)){
	echo "<script>alert('Disciplina adicionada com sucesso!');</script>";
}else{
	echo "<script>alert('Erro ao adicionar Disciplina! Verifique os dados e tente novamente!');</script>";
}
}
}
mysqli_close($conexao);
?>
</div>

<div class="form" id="div3">
<form method="post">
<table class="form2" border="1" cellpadding="10" width="80%" bgcolor="#778899">
<tr>
<td  bgcolor="#778899" class="x" align="Center" colspan="4" onclick="aparecer('div1')" width="90%"><b>Modificar Disciplina</b></td>
<td  bgcolor="#696969" class="Y2" align="center" onclick="sumir('div3')">Fechar</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Novo nome:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" name="novonomedisc"></td>

<td width="20%" height="10%" bgcolor="#778899" align="right" >Escola:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<a name="modificar"></a>
<select class="tam_input" name="novocodesc">
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysqli_connect_error();
}
$codigoProf = $_SESSION['cod'];

$sqlEsc = "SELECT escola.nome,escola.cod FROM `professores_cadastrados` INNER join escola on escola.cod = professores_cadastrados.cod_escola ";
$sqlEsc = $sqlEsc."inner join professor on professor.cod = professores_cadastrados.cod_prof where professores_cadastrados.situacao = 1 and professor.cod=$codigoProf";
$rsEsc = mysqli_query($conexao,$sqlEsc);
while($rowEsc = mysqli_fetch_array($rsEsc)){
echo "<option value=".$rowEsc['cod']." >".$rowEsc['nome']."</option>";
}
mysqli_close($conexao);
?>
</select>
</td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" rowspan="2" bgcolor="#778899" align="left">
<input type="submit" class="botao" name="enviar" value="Modificar"  />
</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Código Disciplina:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" name="coddisc2" onkeypress="return Validar(event, this, '#########');" required></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
</tr>
</table>
</form>

<?php

$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "<script>alert('Erro na conexão:".mysql_connect_error()."')</script>";
}

if(empty($_REQUEST['coddisc2'])||empty($_REQUEST['novocodesc'])||empty($_REQUEST['novonomedisc'])){

}else{
$coddisc2 = addslashes($_REQUEST['coddisc2']);
$novocodesc = addslashes($_REQUEST['novocodesc']);
$novonomedisc = addslashes($_REQUEST['novonomedisc']);
$sqlConf = "select cod_disc from disciplina where cod_disc='$coddisc2'";
$rConf = mysqli_query($conexao,$sqlConf);
$numReg = mysqli_num_rows($rConf);
if($numReg>0){
	$sqlAlterar = "UPDATE `disciplina` SET `cod_esc`='$novocodesc',`nome`='$novonomedisc' WHERE cod_disc='$coddisc2'";
	if($rAlterar = mysqli_query($conexao,$sqlAlterar)){
	echo "<script>alert('Dados Alterarados com Sucesso!');</script>";
	}else{
	echo "<script>alert('Erro ao alterar Disciplina! Verifique os dados e tente novamente!');</script>";
}
	}else{
	echo "<script>alert('Codigo da disciplina não existe!');</script>";
}
}
mysqli_close($conexao);
?>
</div>
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "<script>alert('Erro na conexão: ".mysql_connect_error()."');</script>";
}
$codP = $_SESSION['cod'];
$sqlDisc = "select * from disciplina where cod_prof='$codP' order by nome";
$rDisc = mysqli_query($conexao,$sqlDisc);
$numC = mysqli_num_rows($rDisc);
if($numC>0){
	while($row2 = mysqli_fetch_array($rDisc)){
	echo "<div class='form2' >";
	echo "<table border='0' cellpadding='0' width='100%' bgcolor='#778899'>";
	echo "<td  bgcolor='#778899' class='x' align='left' onclick=aparecer2('".$row2['cod_disc']."') width='80%'>";
	echo "<div style='height:35px;padding-left:15px;cursor:pointer;'>";
	echo "<b class='tam_mat'>".$row2['cod_disc']." - ".$row2['nome']."</b><br/>";
	echo "</div></td>";
	echo "<td  bgcolor='#696969' class='y2' align='center' id='".$row2['cod_disc']."' onclick=delet(this)>Excluir</td>";
	echo "<td  bgcolor='#696969' class='y' align='center' onclick=sumir('tarefa')>Cancelar</td>";
	echo "</table></div></br>";
	}
}
mysqli_close($conexao);
?>

<div class="frm" id="tarefa" style="display:<?php if(empty($f)){echo "none";}else{echo $f;}?>">
<a name="calend"></a>
<table class="form2 " border="0" cellpadding="0" bgcolor="#778899" width="80%">
<tr><td colspan="100%" align="center" style="font-size:20px;padding:2px;"> <?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "<script>alert('Erro na conexão: ".mysql_connect_error()."');</script>";
}
$sqlN = "SELECT `nome` FROM `disciplina` WHERE cod_disc='".$_SESSION['disc2']."'";
$rN = mysqli_query($conexao,$sqlN);
$rowN = mysqli_fetch_array($rN);
echo $rowN['nome'];
mysqli_close($conexao);
?></td></tr>
<tr>
<td colspan="3" rowspan="5" width="60%" bgcolor="#778899" height="405px" align="center">
<div class="w3-content" style="max-width:100%;position:relative;padding-bottom:50px;background:#eee;height:410px">

<section class="mySlides">

<?php
 $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$sql2 = "select * from atividades where cod_disc='".$_SESSION['disc2']."'";
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

$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}


for($cont2=1;$cont2<=31;$cont2++){
$x=0;
$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-01-".$cont2."'";
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
}

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

  $x = 0;
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=28;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-02-".$cont2."'";
$ra = mysqli_query($conexao,$obina);
$brasil = mysqli_fetch_array($ra);

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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-03-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-04-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-05-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-06-".$cont2."'";
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

echo "<li><span></span></li>";
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-07-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-08-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-09-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;

for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-10-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=30;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-11-".$cont2."'";
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
mysqli_close($conexao);
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
	echo "Erro na conexão:".mysqli_connect_error();
}

 $x = 0;
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
	echo "<li><span>-</span></li>";
for($cont2=1;$cont2<=31;$cont2++){

$obina = "select count(*) from atividades where cod_disc='".$_SESSION['disc2']."' and data= '2017-12-".$cont2."'";
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

echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
echo "<li><span></span></li>";
mysqli_close($conexao);
?>
</ul>
</section>
<a class="btnNP" style="position:absolute;top:15%;left:5" onclick="plusDivs(-1)"><</a>
<a class="btnNP" style="position:absolute;top:15%;right:5" onclick="plusDivs(1)">></a>

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
</td>

<td colspan="2" rowspan="5" width="40%" height="405px" bgcolor="white" valign="top">
<div class="w3-container w3-pale-blue  w3-responsive" style="overflow-y:scroll;height:205px;">

 <table class="w3-table " style="font-size:100%;">
<tr>
  <th>Codigo</th>
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
$sql2 = "select * from atividades where cod_disc='".$_SESSION['disc2']."' order by data";
$rs2 = mysqli_query($conexao,$sql2);
if(mysqli_num_rows($rs2)>0){
	while($row2 = mysqli_fetch_array($rs2)){
	echo "<tr><td>".$row2['cod_ativ']."</td>";
	echo "<td>".$row2['descricao']."</td>";
	echo "<td>".$row2['hora']."</td>";
	echo "<td>".$row2['local']."</td>";
	echo "<td>".date("d-m-Y", strtotime($row2['data']))."</td></tr>";

	}
}else{
	echo "<tr><td colspan=5 style='font-size:25px;'><br/>Nenhuma atividade desta materia encontrada!</td></tr>";
}
mysqli_close($conexao);
	?>
</table>
</div>
<br/>
<div class="w3-container h">
    <ul class="w3-ul">
    <li class="w3-hover-red"><span class="circ w3-red"></span> Prova</li>
    <li class="w3-hover-green"><span class="circ w3-green"></span>Atividade Avaliativa</li>
    <li class="w3-hover-yellow"><span class="circ w3-yellow"></span>Entrega de Trabalho</li>
	<li class="w3-hover-purple"><span class="circ w3-purple"></span>Atividades diversas (Ex:Prova e Trabalho)</li>
      </ul>
  </div>
</td>

</div>


<div class="form">
<form method="post" name="adicionar">
<input type="hidden" name="tipo" value="adicionar">
<input type="hidden" name="cod_d">
<table class="form2" border="1" cellpadding="0" width="80%" bgcolor="#778899">
<tr>

<td width="20%" height="10%" colspan="5" bgcolor="#778899" align="center"><br/>ADICONAR ATIVIDADE<br/><br/><br/></td>

</tr>
<tr>
  <td width="20%" height="10%" bgcolor="#778899" align="right" >Codigo:</td>
  <td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" style="border-radius: 5px" class="tam_input2" onkeypress="return Validar(event, this, '########');" name="codatv"></td>

<td width="20%" height="10%" bgcolor="#778899" align="right" >Data:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<input type="date" style="border-radius: 5px" class="tam_input2"  name="data" max="2017-12-31" ></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" rowspan="2" bgcolor="#778899" align="left">
<input type="submit" class="botao" name="enviar" value="Adicionar"  />
</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Tipo:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<select class="tam_input2" style="border-radius: 10px" name="atividade">
<option value="0"></option>
<option value="1">Entrega de Trabalho</option>
<option value="2">Prova</option>
<option value="3">Atividade Avaliativa</option>
</td>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Hora:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="time" style="border-radius: 5px" onkeypress="return Validar(event, this, '##:##')" class="tam_input2" name="hora"></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Local:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input class="tam_input2" style="border-radius: 5px" type="text" name="local"></td>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Descrição:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" class="tam_input2" style="border-radius: 5px" name="descatv"></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
</table>
</form>
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
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['tipo'])){}else{
if($_REQUEST['tipo']=='adicionar'){
if(empty($_REQUEST['data'])||empty($_REQUEST['hora'])||empty($_REQUEST['local'])||empty($_REQUEST['descatv'])||$_REQUEST['atividade']=='0'){
echo "<script>alert('Preencha todos os dados!');</script>";
}else{
$data = addslashes($_REQUEST['data']);
$hora = addslashes($_REQUEST['hora']);
$local = addslashes($_REQUEST['local']);
$descatv = addslashes($_REQUEST['descatv']);
$ativ = addslashes($_REQUEST['atividade']);
$codD = $_SESSION['disc2'];
$codatv = addslashes($_REQUEST['codatv']);

echo "<script>alert('".$data."')</script>";


$sqlValidarAtv = "select cod_ativ from atividades where cod_ativ='$codatv'and cod-disc='$codD'";
$rValidarAtv = mysqli_query($conexao,$sqlValidarAtv);
$numCatv = mysqli_num_rows($rValidarAtv);
if($numCatv>0){
	echo "<script>alert('Codigo já cadastrado! Entre com outro valor!')</script>";
}else{

$sqlInsertAtv = "INSERT INTO `atividades` VALUES ('$codatv','$codD','$ativ','$local','$data','$hora','$descatv')";
if($rInsertAtv = mysqli_query($conexao,$sqlInsertAtv)){
	echo "<script>alert('Atividade adicionada com sucesso!')</script>";
}else{
	echo "<script>alert('Erro ao adicionar Atividade! Verifique os dados e tente novamente!')</script>";
}
}
}}}
mysqli_close($conexao);
?>
<form method="post" name="alterar">
<input type="hidden" name="tipo" value="alterar">
<input type="hidden" name="cod_d2">
<table class="form2" border="1" cellpadding="0" width="80%" bgcolor="#778899">
<tr>
<td width="100%" colspan="5" bgcolor="#778899" align="center"><hr/></td></tr>
<tr>
<tr>
<td width="20%" height="10%" colspan="5" bgcolor="#778899" align="center"><br/>ALTERAR ATIVIDADE<br/><br/><br/></td></tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Codigo:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" class="tam_input2" style="border-radius: 5px" onkeypress="return Validar(event, this, '########');" name="nvcodatv"></td>

<td width="20%" height="10%" bgcolor="#778899" align="right" >Nova Data:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="date" style="border-radius: 5px" class="tam_input2"  onkeypress="return Validar(event, this, '##/##/####')" name="nvdata" max="2017-12-31" <?php echo"min='".date("Y-m-d")."'";?>></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" rowspan="2" bgcolor="#778899" align="left">
<input type="submit" class="botao" name="enviar" value="Alterar"  />
</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Novo Tipo:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<select class="tam_input2" style="border-radius: 10px" name="nvatividade">
<option value="0"></option>
<option value="1">Entrega de Trabalho</option>
<option value="2">Prova</option>
<option value="3">Atividade Avaliativa</option>
</td>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Nova Hora:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input class="tam_input2" style="border-radius: 5px"  onkeypress="return Validar(event, this, '##:##')" type="time" name="nvhora"></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right">Novo Local:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" class="tam_input2" style="border-radius: 5px" name="nvlocal"></td>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Nova Descrição:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" class="tam_input2"  style="border-radius: 5px" name="nvdescatv"></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
</tr>
</table>
</form>
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['tipo'])){}else{
if($_REQUEST['tipo']=='alterar'){
if(empty($_REQUEST['nvcodatv'])||empty($_REQUEST['nvdata'])||empty($_REQUEST['nvhora'])||empty($_REQUEST['nvlocal'])||empty($_REQUEST['nvdescatv'])||$_REQUEST['nvatividade']=='0'){

}else{
$codD = $_SESSION['disc2'];
$nvcodatv = addslashes($_REQUEST['nvcodatv']);
$nvdata = addslashes($_REQUEST['nvdata']);
$nvhora = addslashes($_REQUEST['nvhora']);
$nvlocal = addslashes($_REQUEST['nvlocal']);
$nvdescatv = addslashes($_REQUEST['nvdescatv']);
$nvativ = addslashes($_REQUEST['nvatividade']);

$sqlValidarAtv2 = "select cod_ativ from atividades where cod_ativ='$nvcodatv'";
$rValidarAtv2 = mysqli_query($conexao,$sqlValidarAtv2);
$numCatv2 = mysqli_num_rows($rValidarAtv2);
if($numCatv2<1){
	echo "<script>alert('Codigo da atividade não existe! Entre com outro valor!')</script>";
}else{
$sqlUpdateAtv = "UPDATE `atividades` SET `tipo`='$nvativ',`local`='$nvlocal',`data`='$nvdata',`hora`='$nvhora',`descricao`='$nvdescatv' WHERE cod_ativ='$nvcodatv' and cod_disc='$codD'";
if($rUpdateAtv = mysqli_query($conexao,$sqlUpdateAtv)){
	echo "<script>alert('Atividade alterada com sucesso!')</script>";
}else{
	echo "<script>alert('Erro ao alterar Atividade! Verifique os dados e tente novamente!')</script>";
}
}
}}}
mysqli_close($conexao);
?>
<form method="post" name="excluir">
<input type="hidden" name="tipo" value="excluir">
<input type="hidden" name="cod_d3">
<table class="form2" border="1" cellpadding="0" width="80%" bgcolor="#778899">
<tr>
<td width="100%" colspan="100%" bgcolor="#778899" align="center"><hr/></td></tr>
<tr>
<tr>
<a name='calendar'></a>
<td width="20%" height="10%" colspan="5" bgcolor="#778899" align="center"><br/>EXCLUIR ATIVIDADE<br/><br/><br/></td></tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right" >Codigo:</td>
<td width="20%" height="10%" bgcolor="#778899" align="left"><input type="text" class="tam_input2" style="border-radius: 5px" onkeypress="return Validar(event, this, '########');" name="Excodatv"></td>

<td width="20%" height="10%" bgcolor="#778899" align="right" ></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></td>
<td width="20%" height="10%" bgcolor="#778899" align="left">
<input type="submit" class="botao3" name="enviar" value="Excluir"/>
</td>
</tr>
<tr>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="right"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
<td width="20%" height="10%" bgcolor="#778899" align="left"></br></td>
</tr>
</table>
</form>
<?php
$conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
if(empty($_REQUEST['tipo'])){}else{
if($_REQUEST['tipo']=='excluir'){
if(empty($_REQUEST['Excodatv'])){

}else{
	$codD = $_SESSION['disc2'];
	$Excodatv = addslashes($_REQUEST['Excodatv']);
	$sqlValidarAtv3 = "select cod_ativ from atividades where cod_ativ='$Excodatv'";
$rValidarAtv3 = mysqli_query($conexao,$sqlValidarAtv3);
$numCatv3 = mysqli_num_rows($rValidarAtv3);
if($numCatv3<1){
	echo "<script>alert('Codigo da atividade não existe! Entre com outro valor!')</script>";
}else{

$sqlExcluirAtv = "DELETE FROM `atividades` WHERE cod_ativ='$Excodatv' and cod_disc='$codD'";
if($rExcluirAtv = mysqli_query($conexao,$sqlExcluirAtv)){
	echo "<script>alert('Atividade excluída com sucesso!')</script>";
}else{
	echo "<script>alert('Erro ao excluír Atividade! Verifique os dados e tente novamente!')</script>";
}
}
}}}
mysqli_close($conexao);
?>
</div>

</body>
</html>
