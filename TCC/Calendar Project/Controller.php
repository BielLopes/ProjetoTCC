<?php
class Controller {
  public function __construct(){

  }

  private $servidorBD="localhost";
  private $usuario="root";
  private $senha="";
  private $database="tcc";



//EFETUAR LOGIN DE USUÁRIO
  public function logar(){
    $conexao= mysqli_connect($this->servidorBD, $this->usuario, $this->senha, $this->database);
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
  }









//PESQUISAR MATÉRIAS CADASTRRADAS
  public function pesquisar(){

      $conexao = mysqli_connect($this->servidorBD, $this->usuario, $this->senha, $this->database);
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



                    if(empty($pesquisa)){

                    }else{
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
                }
              }
              mysqli_close($conexao);
            }

}
?>
