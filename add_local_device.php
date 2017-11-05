
<?php 
  //require_once('functions.php'); 
  require_once 'config.php';
  include(HEADER_TEMPLATE);
if (!empty($_POST['localdevice'])) {
	$localdevice = null;
	$localdevice = $_POST['localdevice'];
	save('localdevice', $localdevice);
	echo"<script language='javascript' type='text/javascript'>alert('" . $_SESSION['message'] . "');window.location.href='add_local_device.php'</script>";
	
    //header('location: add_local_device.php');
}  
    
	//$db = open_database(); ?>

<!--<h1>Continuos...</h1>
<hr />-->
	  <form class="form-signin" method="POST" action="add_local_device.php">
        <h4 class="form-signin-heading">Cadastro de Local Device</h4>
        <label for="inputEmail" class="sr-only">Localidade</label>
		
		
        <input type="text" id="localidade" name="localdevice['localidade']" class="form-control" placeholder="localidade" required autofocus>
       
	   <label for="inputPassword" class="sr-only">Id_device</label>
        <input type="password" id="id_device" name="localdevice['id_device']" class="form-control" placeholder="id_device" required>
        <button type="submit" class="btn btn-primary">Salvar</button>
		<a href="index.php" class="btn btn-default">Cancelar</a>
        <!--<button class="btn btn-lg btn-primary btn-block" type="submit" value="entrar" id="entrar" name="entrar">Entrar</button>-->
		<br><br><br><br>
		<!--img src="imagens/clicker.png" alt="Imagem de página não encontrada" /-->
		
      </form>
	  <?php include(FOOTER_TEMPLATE); ?>
	  






