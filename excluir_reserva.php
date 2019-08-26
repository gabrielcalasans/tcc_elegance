<meta charset="utf-8">
<?php
include('conn.php');
$codreserva=$_GET['id'];
$deletar_reserva="DELETE FROM tb_reserva WHERE cd_reserva=\"$codreserva\"";
$executar = $mysqli->query($deletar_reserva);
echo "<script type='text/javascript'>alert('Reserva Excluída!'); window.location.href='ver_reserva.php';</script>";






?>
