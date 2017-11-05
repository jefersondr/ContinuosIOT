<?php 
$id = intval($_GET['id']);
$status = intval($_GET['status']);

if($status == 1){
	$status = 0;
}else{
	$status = 1;
}

$connect = mysql_connect('localhost','root','3141323');
$db = mysql_select_db('continuos');
try {
  
$query = "INSERT INTO statusdevice (id_local,status,datahora) VALUES ($id,$status,now())";
echo $query;
$insert = mysql_query($query,$connect)  or die(mysql_error());
       if($insert){
		   //echo "Status cadastrado com sucesso";
          echo"<script language='javascript' type='text/javascript'>alert('Status cadastrado com sucesso!');window.location.href='status.php'</script>";
        }else{
			//echo "Não foi possível cadastrar esse status";
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse status');window.location.href='status.php'</script>";
        }
} catch (Exception $e) {
    echo 'ERROR:'.$e->getMessage();
}
        
 

?>