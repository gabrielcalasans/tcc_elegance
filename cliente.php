<?php include('header.php'); ?>
		<title>Cliente | Hospedagem Elegance</title>
	</head>
	<style type="text/css">
		#logo{
                width: 9%;
            }
            body{
            	background-color: #FFF7D9;
            }
        #avatar{
        	width: 120px;
        	height: 120px;
        }
	</style>
	<?php
		include('conn.php');
		if(empty($_SESSION['cliente'])){
			header('Location: index.php');
		}
		if(isset($_GET['id']) and $_GET['id'] == 0){
			session_destroy();
			header('Location: index.php');
		}
	?>
	<body>
		<!-- Modal Structure -->
        <div id="sair" class="modal" style="width: 40%;">
            <div class="modal-content">
                <center><h4>Deseja sair?</h4></center>
                
                <?php 
                    if(!empty($_SESSION['cliente'])){
                        $sql = "SELECT * from tb_cliente where cd_cliente = ".$_SESSION['cliente'];
                        $result = $mysqli->query($sql);
                        $row = $result->fetch_object();
                        echo '<p align="center"><img style="width: 20%; border-radius: 100%;" src="'.$row->ds_avatar.'"></p>';
                        echo '<p align="center">'.$row->nm_cliente.' '.$row->nm_sobrenome.'</p>';
                    } 
                ?>
                            
               
            </div>
            <div class="modal-footer">
              <center><a href="cliente.php?id=0" title="Sim" class="btn green modal-close waves-effect waves-green">Sim</a>
              <a href="#!" title="Não" class="btn red modal-close waves-effect waves-green">Não</a></center>
            </div>
        </div>
		<nav class="grey darken-2">
			<ul id="dropdown1" class="drop dropdown-content">
                <li><a href="cliente.php">Minha conta</a></li>
                <li class="divider"></li>
                <li><a href="index.php?id=0">Sair</a></li>
            </ul>
            <div class="nav-wrapper">
                <a href="index.php"><img id="logo" src="images/logotipo.png"></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   <li><a href="">Configurações</a></li>
                   <li><a class="modal-trigger" href="#sair">Sair</a></li>
                </ul>
            </div>
	    </nav>
		<div class="container">
			<?php 
				$sql = "SELECT *
						from tb_endereco ende
						inner join tb_cliente cli on ( ende.cd_endereco = cli.id_endereco )
						inner join tb_cidade cid on ( cid.cd_cidade = ende.id_cidade )
						inner join tb_estado est on ( est.cd_estado = cid.id_estado )
						where cli.cd_cliente = ".$_SESSION['cliente']
						;
				$result = $mysqli->query($sql);
				$row = $result->fetch_object();
			?>
	        <div class="row card-panel">
	        	<div align="center" class="col s12">
					<img id="avatar" src="<?php echo $row->ds_avatar; ?>">
				</div>
				<div id="edit" align="center" class="col s12">
					 <button id="editar" class="btn-small waves-effect waves-light orange darken-2" title="Editar">Editar<i class='material-icons right'>edit</i></button>
				</div>
				<div id="procurar" align="center" class="col s12">
					<label>Edite sua foto de perfil</label>
	               <div class = "file-field input-field">
	                  <div class = "btn-small waves-effect waves-light orange darken-2">
	                     <span>Procurar fotos<i class='material-icons right'>search</i></span>
	                     <input type="file" id="img" name="img[]"/>
	                  </div>
	                  <div class = "file-path-wrapper">
	                     <input id="img2" class = "file-path" type = "text" placeholder = "Carregue sua foto" />
	                  </div>
	               </div> 
				</div>
				<br>
				<div class="input-field col s6">
					<input class="alterar" id="nome" type="text" name="nome" readonly value="<?php echo $row->nm_cliente ?>"><label for="nome">Nome</label></p>
				</div>
	        	<div class="input-field col s6">
					<input class="alterar" id="sobrenome" type="text" name="sobrenome" readonly value="<?php echo $row->nm_sobrenome ?>"><label for="sobrenome">Sobrenome</label></p>
				</div>
				<div class="input-field col s12" align="center">
					Gênero:<p>
							<?php
								$sql1 = "SELECT * from tb_genero";
								$result1 = $mysqli->query($sql1);
								while($row1 = $result1->fetch_object()){
									if ($row1->cd_genero == $row->id_genero){
										echo "<label for='".$row1->cd_genero."'>
											<input class='radioal with-gap' id='".$row1->cd_genero."' type='radio' name='genero' value='".$row1->cd_genero."' required='' checked disabled><span>".$row1->nm_genero."</span>
										</label>";
									}
									else{
										echo "<label for='".$row1->cd_genero."'>
											<input class='radioal with-gap' id='".$row1->cd_genero."' type='radio' name='genero' value='".$row1->cd_genero."' required='' disabled><span>".$row1->nm_genero."</span>
										</label>";
									}
								}
							?>	
					    	</p>
				</div>
	        	<div class="input-field col s4">
					<input class="alterar" id="cpf" type="text" name="cpf" readonly value="<?php echo $row->nr_cpf; ?>"><label for="cpf">CPF</label></p>
				</div>
	        	<div class="input-field col s4">
					<input class="alterar" id="rg" type="text" name="rg" readonly value="<?php echo $row->nr_rg ?>"><label for="rg">RG</label></p>
				</div>
				<div class="input-field col s4">
					<input class="alterar" id="orgao" type="text" name="orgao" readonly value="<?php echo $row->ds_orgao ?>"><label for="orgao">Órgão de expedição</label></p>
				</div>
				<div class="input-field col s6">
					<input class="alterar" id="cell" type="text" name="cell" readonly value="<?php echo $row->nr_celular ?>"><label for="cell">Celular</label></p>
				</div>
				<div class="input-field col s6 ">
					<input class="alterar" id="tel" type="text" name="tel" readonly value="<?php echo $row->nr_telefone ?>"><label for="tel">Telefone</label></p>
				</div>
	        </div>
	        <button id="alterar" class="btn-small red darken-2" title="Editar">Alterar dados<i class='material-icons right'>edit</i></button>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script>
            $(document).ready(function(){
            	$("#procurar").hide();
            	$("#editar").click(function(){
            		$("#procurar").show();
            		$("#edit").hide();
            	});
            	$("#alterar").click(function(){
            		$(".alterar").removeAttr('readonly');
            		$(".radioal").removeAttr('disabled');
            	});
                $('.modal').modal();
            });
        </script>
	</body>
</html>