<meta charset="utf-8">
<?php
    include('conn.php');
    session_start();
    $_SESSION['idreserva']=$_GET['idreserva'];

    echo "<script type='text/javascript'>alert('Encaminhando para Página de Alteração'); window.location.href='alterar_reserva.php';</script>";




?>
