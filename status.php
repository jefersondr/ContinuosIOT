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
$sql = "select d.id, d.localidade, s.status, datahora
             from localdevice  as d
             join statusdevice as s
               on d.id = s.id_local
            where s.controle in(select max(controle) from statusdevice group by id_local) 
		 order by d.localidade";
$result = executeQuery($sql);
echo"<div class='table-responsive' >	
	<table  class='table table-striped table-bordered table-hover table-condensed'>
	<thead class='thead-inverse'>
    <tr>
      <th>localidade</th>
      <th>status</th>
    </tr>
  </thead>
  <tbody>" ;
  
  foreach ($result as $resultado) :

		$localidade = $resultado['localidade'];
		
		$datahora = $resultado['datahora'];
		
		$id = intval($resultado['id']);
		
		if (!empty($datahora)){
		$status_real = $resultado['status'];
			if ($resultado['status'] == 1){
				$status = '<img src="imagens/acesa32_b.png" alt="Imagem de página não encontrada" />';
				
			}else{
				$status = '<img src="imagens/apagado32_z1.png" alt="Imagem de página não encontrada" />';
		}}else{
			$status = "Chato";
		}
		
		$status = "<a href='insert_status.php?id=$id&status=$status_real'>$status</a>";
		
		echo"
		<tr>
		
			<td>$localidade</td>
			<td>$status</td>
		
		</tr>
		";
	endforeach; //}

echo"</tbody>
</table></div>
";


?>
<?php include(FOOTER_TEMPLATE); ?>