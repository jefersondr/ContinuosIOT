 <?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<?php include(HEADER_TEMPLATE); ?>
<?php
	if($user->usuarioLogado()){header("Location:status.php"); exit;}
 ?>

<!--<h1>Continuos...</h1>
<hr />-->
	  <form class="form-signin" method="POST" action="validacao.php">
        <h4 class="form-signin-heading">Identificação de Usuário</h4>
        <label for="inputEmail" class="sr-only">Usuário</label>
        <input type="text" id="login" name="login" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="entrar" id="entrar" name="entrar">Entrar</button>
		<br><br><br><br>
		<!--img src="imagens/clicker.png" alt="Imagem de página não encontrada" /-->
		
      </form>
	  <?php include(FOOTER_TEMPLATE); ?>
	  
	  
