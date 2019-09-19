<meta charset="utf-8">
<h1>Painel de controle</h1>
<?php 
	include('conn.php');	
	$nmfuncionario = $_SESSION['nmadmin'];
?>
<h3>Funcionário: <?php echo $nmfuncionario; ?></h3>
<a href="ver_reserva.php"><button>Visualizar reservas</button></a><p>
<a href="ver_quarto.php"><button>Visualizar quartos</button></a><p>
<a href="estatisticas.php"><button>Visualizar estatísticas</button></a><p>
<a href="addfotos.php"><button>Adicionar fotos</button></a>

<?php 

?>