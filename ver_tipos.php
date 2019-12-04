<?php include('header.php'); ?>
	<meta charset="utf-8">
	<?php
		include('conn.php');
		if(empty($_SESSION['cdadmin'])){
			header('Location: admin.php?log=0');
		}
	?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style type="text/css">
		body{
        	background-color: #758DA3; 
	    }

	    #logo{
			width: 9%;
			transition: 0.5s;
		}

		#logo:hover{
			width: 9.5%;
		}

		#imgtipo
		{
			height: 35%;
			width: 45%;
		}

		#painel{
			width: 80%;
			position: absolute;
    		left: 10%;
		}

		@font-face {
    		font-family: "Lobster";
    		src: url("fonts/lobster/Lobster.otf") format("truetype");
    	}

    	.lobster-font{
    		font-family: "Lobster"; 
       }
       .modal
       {
       		width:35%;
       }
       #caixa
       {
       		padding: 10px;
       }
	</style>
</head>
<script>
	$(document).ready(function(){
	    $('.materialboxed').materialbox();
	  });
	$(document).ready(function(){
	    $('.modal').modal();
	  });
</script>
<body>
	<nav class="black darken-2">
    	<div class="nav-wrapper" align="center">
        	<a href="painel_admin.php"><img id="logo" src="images/logotipo2.png"></a>
      	</div>      
    </nav>
	<center>
		<h1 class="lobster-font">Ver Tipos</h1>
		<a class="waves-effect waves-light indigo darken-3 btn" href="painel_admin.php" id="but">Painel de controle</a>
      	<a href="cadastro_tipo.php" class="waves-effect waves-light indigo darken-3 btn">Cadastrar tipo</a>
	</center>
	<p>
	<div id="painel" class="container">
		<?php 
			$consultatipo = "SELECT * FROM tb_tipo";
			$tipo = $mysqli->query($consultatipo);
			while($linha = $tipo->fetch_object())
				{				
					if($linha->ds_imagem!="")
					{
						echo '<div class="card panel" style="padding: 1%;">
								<div class="row">
									<div class="col s12">
										<h4>Informações</h4>
									</div>
								</div>
								<div class="row">
									<div class="col s5">
										<img  class="materialboxed" height="270" width="100%" src="'.$linha->ds_imagem.'">
									</div>
								 	<div class="col s7">
								 		<div class="row">
								 			<div class="col s4">
												<b>Tipo: </b>'.$linha->nm_tipo.'<p>
											</div>
											<div class="col s8">												
												<b>Valor:</b> R$'.number_format($linha->vl_quarto, 2, ',', '.').'<p>
											</div>											
										</div>
										<div class="row">
											<div class="col s12">
												<b>Descrição: </b>'.$linha->ds_tipo.'<p>
											</div>
										</div>																				
									</div>
								</div>';
					}
					else
					{
						echo '<div class="card panel" style="padding: 1%;">
								<div class="row">
									<div class="col s12">
										<h4>Informações</h4>
									</div>
								</div>
								<div class="row">
									<div class="col s6">
										Sem imagem
									</div>
								 	<div class="col s6">
								 		<div class="row">
								 			<div class="col s4">
												<b>Tipo: </b>'.$linha->nm_tipo.'<p>
											</div>
											<div class="col s8">												
												<b>Valor: </b>'.$linha->vl_quarto.'<p>
											</div>											
										</div>
										<div class="row">
											<div class="col s12">
												<b>Descrição: </b>'.$linha->ds_tipo.'<p>
											</div>
										</div>																				
									</div>
								</div>';
					}
					$qtde = 0;
					$consultaquartos = "SELECT * FROM tb_quarto WHERE id_tipo = $linha->cd_tipo";
					$quartos = $mysqli->query($consultaquartos);
					while($lin = $quartos->fetch_object())
					{	
						$qtde+=1;
					}
					if($qtde>0){
						echo '<p>
								<div class="row">
									<div class="col s12">
					                        <b>Não é possível alterar ou excluir um tipo de quarto com um quarto cadastrado</b><p>
					                        <button class="btn disabled" disabled>Excluir</button>
					                        <button class="btn disabled" disabled>Alterar</button>
				                      </div>
				                  </div>									
							</div>';

					}
					else{
						echo '<p>
								<div class="row">
									<div class="col s12">
					                        <span data-target="modal'.$linha->cd_tipo.'"  class="modal-trigger" id="detalhes">
					                          <button type="button" class="waves-light btn-small red" value='.$linha->cd_tipo.'>              
					                              Excluir
					                          </button>
					                       </span>
					                       <a class="btn-small waves-effect waves-light blue" href=alterar_tipo.php?id='.$linha->cd_tipo.'>Alterar</a>
				                      </div>
				                  </div>									
							</div>';
					}
						
						echo '<div id="modal'.$linha->cd_tipo.'" class="modal">
								<div id="caixa">
					                  <div align="center" class="modal-content">
					                    <h5>Deseja excluir o tipo de quarto "'.$linha->nm_tipo.'"?</h5>
					                  </div>
					                <p>                                           
					               <div class="modal-footer">
					                  <center>
					                    <a href="ver_tipos.php?id='.$linha->cd_tipo.'" title="Sim" class="btn modal-close green accent-4">Sim</a>
					                    <a href="#!" title="Não" class="btn modal-close red">Não</a>
					                  </center>
					                </div>
					              </div>
				              </div>';
												
				}
			
			if(isset($_GET['id']))
	    		{
	        		$codtipo=$_GET['id'];
	        		$deletar_tipo="DELETE FROM tb_tipo WHERE cd_tipo=\"$codtipo\"";
	        		if(!$mysqli->query($deletar_tipo))
	          		{
	            		echo "<script>alert('Não é possível excluir!! Há um quarto cadastrado com esse tipo!!');
	           		  	window.location.href='ver_tipos.php';                   
	               		</script>";
	          		}
	          		else
	          		{
	           			echo "<script>alert('Tipo excluída!!');
	                    window.location.href='ver_tipos.php';
	               		</script>";
	          		}
	      		}
		?>
	</div>
</body>