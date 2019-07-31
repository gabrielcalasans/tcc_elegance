<?php
	include('conn.php');
	$estado = $_POST['estado'];
    $sql = "SELECT nm_cidade as cidade, cd_cidade as codcidade from tb_cidade cid
    inner join tb_estado est on (cid.id_estado = est.cd_estado)
    where est.cd_estado = '$estado'
    order by cid.nm_cidade asc";
    $result = $mysqli->query($sql);
    echo "<option value='' disabled selected>Selecione...</option>";
    while($row = $result->fetch_object()){
    	echo "<option name='cidade' value='".$row->codcidade."'>".$row->cidade."</option>";
    }
?>