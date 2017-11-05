<?php require_once 'config.php';
require_once DBAPI; 
include(HEADER_TEMPLATE); ?>
<meta charset="utf-8"/>
<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['usuario_id'])) {
  // Destrói a sessão por segurança
  session_destroy();
  // Redireciona o visitante de volta pro login
  header("Location: index.php"); exit;
}
$login_cookie = $_SESSION['usuario_login'];
echo"<br><b>Bem-vindo, $login_cookie!</b><p>";
//find_all('usuarios');
//$sql = "select * from usuarios";
//             from localdevice  as d
//             join statusdevice as s
//               on d.id = s.id_local
//            where s.controle in(select max(controle) from statusdevice group by id_local) 
//		 order by d.localidade";
//$result = executeQuery($sql);
$result = find_all('usuarios');
echo"<div class='table-responsive' >	
	<table  class='table table-striped table-bordered table-hover table-condensed'>
	<thead class='thead-inverse'>
    <tr>
      <th>Id</th>
      <th>Login</th>
	  <th>senha</th>
	  <th>admin</th>
    </tr>
  </thead>
  <tbody>" ;
  
  foreach ($result as $resultado) :

		$id = intval($resultado['ID']);
		
		$login = $resultado['login'];
		
		$senha = $resultado['senha'];
		
		$admin = intval($resultado['admin']);
		
		echo"
		<tr>
			<td>$id</td>
			<td>$login</td>
			<td>$senha</td>
			<td>$admin</td>
			<td class='actions text-right'>
				<a href='view.php?id=" . $id . "' class='btn btn-sm btn-success'><i class='fa fa-eye'></i> Visualizar</a>
				<a href='edit.php?id=" . $id . "' class='btn btn-sm btn-warning'><i class='fa fa-pencil'></i> Editar</a>
				<a href='#' class='btn btn-sm btn-danger'   data-toggle='modal' data-target='#delete-modal' data-customer='" . $id . "'>	
				<i class='fa fa-trash'></i> Excluir</a>
			</td>
		</tr>
		";
	endforeach; //}

echo"</tbody>
</table></div>
";


?>
<?php
include('modal.php');
include(FOOTER_TEMPLATE); ?>