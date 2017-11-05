<?php 
  require_once('config.php'); 
echo 'Passou aqui';
  if (isset($_GET['id'])){
    //delete($_GET['id']);
	remove('usuarios',$_GET['id']);
  } else {
    die("ERRO: ID não definido.");
  }
?>