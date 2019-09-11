<meta charset="utf-8">
<?php
    include('conn.php');
   
    $_SESSION['idreserva']=$_GET['idreserva'];

    echo "<script type='text/javascript'> window.location.href='alterar_reserva.php';</script>";




?>
