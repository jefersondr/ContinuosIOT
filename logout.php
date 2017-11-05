      <?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>
<?php 
$user = new Usuario();
$user->logout();
//setcookie('login');
//unset($_COOKIE['login']);
header("Location:index.php");
?>