  <?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<meta charset="utf-8"/>
<?php
include  ('inc/usuario.class.php');
// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
  header("Location: index.php"); exit;
}
$usuario = mysql_real_escape_string($_POST['login']);
$senha = mysql_real_escape_string($_POST['senha']);
echo $usuario . '-' . $senha;
$user = new Usuario();

if (!$user->logaUsuario($usuario,$senha)){
	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	echo "Login inválido!"; exit;
	
}else{
	echo "Login válido!";
	  header("Location: status.php"); exit;
}