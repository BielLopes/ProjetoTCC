<?php 

$servidorBD="localhost";
$usuario="root";
$senha="";
$database="tcc";

$diaAtual = date("Y-m-d");

 $conexao= mysqli_connect($servidorBD,$usuario,$senha,$database);
if(mysqli_connect_errno())
{
	echo "Erro na conexão:".mysql_connect_error();
}
$sql2 = "SELECT * FROM `alunos` INNER join atividades on alunos.cod_disc=atividades.cod_disc";
$rs2 = mysqli_query($conexao,$sql2);
$num = mysqli_num_rows($rs2);
$k = 0;

if($num>0){
	while($row2 = mysqli_fetch_array($rs2)){
		$datas[$k]=$row2['data'];
		$email[$k]=$row2['email'];
		$codD[$k]=$row2['cod_disc'];
		$codA[$k]=$row2['cod_ativ'];
		$tipo[$k]=$row2['tipo'];
		$descricao[$k]=$row2['descricao'];
		$k++;
	}
} 
			for($f=0;$f<$num;$f++){
			$dia[$f] = substr($datas[$f],8);
			$dia1[$f] = substr($datas[$f],8);
						
			if($dia[$f]>5){
			$dia[$f] -= 5;
			if($dia[$f]<10){
			$dia[$f] = "0".$dia[$f];
			}
			$resto[$f] = substr($datas[$f],0,8);
			$datas5[$f] = $resto[$f].$dia[$f];
			}else{
			$dia[$f] = $dia[$f]+25;
			$mes[$f] = substr($datas[$f],5,2);
			if($mes[$f]>1){
			$mes[$f] -= 1;
			if($mes[$f]<10){
			$mes[$f] = "0".$mes[$f];
			}
			$ano[$f] = substr($datas[$f],0,5);
			$datas5[$f] = $ano[$f].$mes[$f]."-".$dia[$f];
			}else{
				$mes[$f] = 12;
			$ano[$f] = substr($datas[$f],0,4);
			$ano[$f] -= 1;
			$datas5[$f] = $ano[$f]."-".$mes[$f]."-".$dia[$f];
			}
			}
			
			if($dia1[$f]>1){
			$dia1[$f] -= 1;
			if($dia1[$f]<10){
			$dia1[$f] = "0".$dia1[$f];
			}
			$resto2[$f] = substr($datas[$f],0,8);
			$datas1[$f] = $resto2[$f].$dia1[$f];
			}else{
			$dia1[$f] = $dia1[$f]+29;
			$mes1[$f] = substr($datas[$f],5,2);
			if($mes1[$f]>1){
			if($mes1[$f]=='02'){$dia1[$f] -= 2;}
				$mes1[$f] -= 1;
			if($mes1[$f]<10){
			$mes1[$f] = "0".$mes1[$f];
			}
			$ano1[$f] = substr($datas[$f],0,5);
			$datas1[$f] = $ano1[$f].$mes1[$f]."-".$dia1[$f];
			}else{
				$mes1[$f] = 12;
			$ano1[$f] = substr($datas[$f],0,4);
			$ano1[$f] -= 1;
			$datas1[$f] = $ano1[$f]."-".$mes1[$f]."-".$dia1[$f];
			}
			}
		}
			for($s=0;$s<$num;$s++){
				$sql = "SELECT * FROM `disciplina` WHERE cod_disc=".$codD[$s];
				$rs = mysqli_query($conexao,$sql);
				$row = mysqli_fetch_array($rs);
				$nomeD[$s] = $row['nome'];
			}
			
			for($s=0;$s<$num;$s++){
				if($tipo[$s]==1){
					$nomeA = 'Prova';
				}
				if($tipo[$s]==2){
					$nomeA = 'Atividade Avaliativa';
				}
				if($tipo[$s]==3){
					$nomeA = 'Trabalho';
				}
				if($tipo[$s]==4){
					$nomeA = 'Atividades';
				}
			    
				if(!empty($datas5[$s])){
				if($diaAtual == $datas5[$s]){
				$assunto="<h1>".$codD[$s]."-".$nomeD[$s]." : ".$nomeA."</h1>";
				$mensagem ="<h3>Falta <font color=red>5</font> dias para a realização da atividade: ".$descricao[$s];	
			    $mensagem=$mensagem."<br/> Tipo: ".$nomeA;	
			    $mensagem=$mensagem."<br/> Disciplina: ".$nomeD[$s];	
			    $mensagem=$mensagem."<br/> Data: ".$datas[$s];	
			    $mensagem=$mensagem."</h3>";		
				
				$status=mail($email[$s], $assunto, $mensagem);
				
				if($status)
					echo "<script>alert('E-mail enviado com sucesso!');</script>";
				else
					echo "<script>alert('Falha ao enviar E-mail!');</script>";
				
				}
				}
				
				if(!empty($datas1[$s])){
				if($diaAtual == $datas1[$s]){
				$assunto=$codD[$s]."-".$nomeD[$s]." : ".$nomeA;
				$cabecalho = "MIME-version: 1.0\r\n"."Content-type: text/html; charset=iso-8859-1\r\n"."From: \"Envio de e-mails\" \r\n";
				$mensagem="<h3>Falta <font color=red>1</font> dia para a realização da atividade: ".$descricao[$s];	
			    $mensagem=$mensagem."<br/>Tipo: ".$nomeA;	
			    $mensagem=$mensagem."<br/>Disciplina: ".$nomeD[$s];	
			    $mensagem=$mensagem."<br/>Data: ".$datas[$s];
			    $mensagem=$mensagem."<br/>Site: http://localhost/TCC/Calendar%20Project/";
			    $mensagem=$mensagem."<br/><br/><br/><a href=http://localhost/TCC/Calendar%20Project/desvincular.php?cod=".$codD[$s]."&email=".$email[$s].">Desvincular</a>";
			    $mensagem=$mensagem."</h3>";
				
			 	
				
				$status=mail($email[$s], $assunto, $mensagem,$cabecalho);
				
				if($status)
					echo "<script>alert('E-mail enviado com sucesso!');</script>";
				else
					echo "<script>alert('Falha ao enviar E-mail!');</script>";
				}
				}	
			echo "<script>alert('".$datas1[$s]."/".$datas5[$s]."/".$diaAtual."');</script>";
			}
			
			
			
		
	?>