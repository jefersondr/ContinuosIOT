<?php include  (USUARIO_CLASSE); ?>
<!DOCTYPE html>
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistema Continuos</title>

    <!-- Bootstrap core CSS 
    <link rel="stylesheet" href="<?php // echo BASEURL; ?>css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 


    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php  echo BASEURL; ?>css/signin.css" rel="stylesheet">
	<link href="<?php  echo BASEURL; ?>css/navbar-top-fixed.css" rel="stylesheet">
  </head>

  <body>
  
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo BASEURL; ?>index.php" class="navbar-brand">Continuos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		
			
		<?php		  
$user = new Usuario();
if ($user->usuarioLogado()){
	echo "teste: " . $_SESSION['usuario_admin'];
	if(($_SESSION['usuario_admin']) == 1) {
		echo " <ul class='nav navbar-nav'>  
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
							Cadastrar <span class='caret'></span>
						</a>
						<ul class='dropdown-menu'>
							<li><a href='" . BASEURL . "add_usuario.php'>Usuario</a></li>
							<li><a href='" . BASEURL . "add_local_device.php'>Local device</a></li>
						</ul>
					</li>
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
							Manutenção <span class='caret'></span>
						</a>
						<ul class='dropdown-menu'>
							<li><a href='" . BASEURL . "Manutencao_usuario.php'>Usuario</a></li>
							<li><a href='" . BASEURL . "Manutencao_local_device.php'>Local device</a></li>
						</ul>
					</li>
				</ul>";
	}
}
	
?>
			<ul class="nav navbar-nav navbar-right">
				<li> <?php if ($user->usuarioLogado()){echo "<a class='nav-link' href='logout.php'>Logout</a>" ;  } ?> <!--<a href="#"><span class="glyphicon glyphicon-user"></span> Cadastrar</a>--></li>
			</ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <div class="container">
  
  
  
  
  


	
	
	


    