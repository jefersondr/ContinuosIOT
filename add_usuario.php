
<?php 
  //require_once('functions.php'); 
  require_once 'config.php';
  include(HEADER_TEMPLATE); 
    $user = new Usuario();
	$user->cadastrarUsuario();
	//$db = open_database(); ?>

<!--<h1>Continuos...</h1>
<hr />-->
	  <form class="form-signin" method="POST" action="add_usuario.php">
        <h4 class="form-signin-heading">Cadastro de Usuário</h4>
        <label for="inputEmail" class="sr-only">Usuário</label>
		
		
        <input type="text" id="login" name="usuarios['login']" class="form-control" placeholder="usuarios" required autofocus>
       
	   <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="senha" name="usuarios['senha']" class="form-control" placeholder="Senha" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" id="admin" name="usuarios['admin']" value="admin"> Administrador
          </label>
        </div>
		<button type="submit" class="btn btn-primary">Salvar</button>
		<a href="index.php" class="btn btn-default">Cancelar</a>
        <!--<button class="btn btn-lg btn-primary btn-block" type="submit" value="entrar" id="entrar" name="entrar">Entrar</button>-->
		<br><br><br><br>
		<!--img src="imagens/clicker.png" alt="Imagem de página não encontrada" /-->
		
      </form>
	  <?php include(FOOTER_TEMPLATE); ?>
	  






