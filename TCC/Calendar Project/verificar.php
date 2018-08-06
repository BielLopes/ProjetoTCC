<?php
session_start();
if(!isset($_SESSION['cod'])||!isset($_SESSION['nome'])){
	header("Location:inicial.php");
	exit;
}
?>