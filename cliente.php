<?php include('header.php'); ?>
		<title>Cliente | Hospedagem Elegance</title>
	</head>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
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
        .input-field input:focus + label {
		    color: #fbc02d !important;
		}
		.input-field input:focus {
		    border-bottom: 1px solid #fbc02d !important;
		    box-shadow: 0 1px 0 0 #fbc02d !important;
		}		
		[type="radio"]:checked + span:after,
		[type="radio"].with-gap:checked + span:before,
		[type="radio"].with-gap:checked + span:after {
			border: 2px solid #fbc02d;
		}
		[type="radio"]:checked + span:after,
		[type="radio"].with-gap:checked + span:after {
			background-color: #fbc02d;
		}
		.dropdown-content li > a, .dropdown-content li > span {
			color: #fbc02d !important;
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
              <center><a href="cliente.php?id=0" title="Sim" class="btn modal-close waves-effect waves-light green accent-4">Sim</a>
              <a href="#!" title="Não" class="btn modal-close waves-effect waves-light red">Não</a></center>
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
						inner join tb_profissao prof on ( cli.id_profissao = prof.cd_profissao )
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
	                    	<input class="inpute" type="file" id="img" name="img[]"/>
	                	</div>
	                	<div class = "file-path-wrapper">
	                    	<input id="img2" class = "file-path" type = "text" placeholder = "Carregue sua foto" />
	                  	</div>
	               	</div> 
				</div>
				<br>
				<div class="input-field col s6">
					<input class="alterar inpute" id="nome" type="text" name="nome" readonly value="<?php echo $row->nm_cliente ?>"><label for="nome">Nome</label></p>
				</div>
	        	<div class="input-field col s6">
					<input class="alterar inpute" id="sobrenome" type="text" name="sobrenome" readonly value="<?php echo $row->nm_sobrenome ?>"><label for="sobrenome">Sobrenome</label></p>
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
					<input class="alterar inpute" id="cpf" type="text" name="cpf" readonly value="<?php echo $row->nr_cpf; ?>"><label for="cpf">CPF</label></p>
				</div>
	        	<div class="input-field col s4">
					<input class="alterar inpute" id="rg" type="text" name="rg" readonly value="<?php echo $row->nr_rg ?>"><label for="rg">RG</label></p>
				</div>
				<div class="input-field col s4">
					<input class="alterar inpute" id="orgao" type="text" name="orgao" readonly value="<?php echo $row->ds_orgao ?>"><label for="orgao">Órgão de expedição</label></p>
				</div>
				<div class="input-field col s4 ">
					<input class="alterar inpute" id="email" type="email" name="email" readonly value="<?php echo $row->nm_email ?>"><label for="email">E-mail</label></p>
				</div>
				<div class="input-field col s4">
					<input class="alterar inpute" id="cell" type="text" name="cell" readonly value="<?php echo $row->nr_celular ?>"><label for="cell">Celular</label></p>
				</div>
				<div class="input-field col s4 ">
					<input class="alterar inpute" id="tel" type="text" name="tel" readonly value="<?php echo $row->nr_telefone ?>"><label for="tel">Telefone</label></p>
				</div>
				<div class="input-field col s3 ">
					<input class="alterar inpute" id="nasc" type="date" name="nasc" readonly value="<?php echo $row->dt_nascimento ?>"><label for="nasc">Data de Nascimento</label></p>
				</div>
				<div class="input-field col s3 ">
					<input class="alterar inpute" id="nacio" type="text" name="nacio" readonly value="<?php echo $row->ds_nacionalidade ?>"><label for="nacio">Nacionalidade</label></p>
				</div>
				<div class="input-field col s3 ">
					<select name="profissao" class="inpute">
						<?php
							$sql2 = "SELECT * from tb_profissao order by nm_profissao asc";
							$result2 = $mysqli->query($sql2);
							while($row2 = $result2->fetch_object()){
								if($row2->cd_profissao == $row->id_profissao){
									echo "<option value='".$row2->cd_profissao."' selected>".$row2->nm_profissao."</option>";
								}
								else{
									echo "<option value='".$row2->cd_profissao."'>".$row2->nm_profissao."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="input-field col s3 ">
					<input class="alterar inpute" id="profi" type="text" name="profi" readonly><label for="profi">Outra</label></p>
				</div>
				<div class="input-field col s12 ">
					<center><button id="alterarpes" class="btn-small red darken-2" title="Editar">Alterar dados pessoais<i class='material-icons right'>edit</i></button></center>
				</div>
	        </div>
	        
	        <div class="row card-panel">
				<div class="input-field col s6">
					<input class="alterar1 inpute" id="ende" type="text" name="ende" readonly value="<?php echo $row->nm_endereco; ?>"><label for="ende">Endereço</label></p>
				</div>
	        	<div class="input-field col s3">
					<input class="alterar1 inpute" id="numero" type="text" name="numero" readonly value="<?php echo $row->nr_endereco ?>"><label for="numero">Número</label></p>
				</div>
				<div class="input-field col s3">
					<input class="alterar1 inpute" id="cep" type="text" name="cep" readonly value="<?php echo $row->nr_cep ?>"><label for="cep">CEP</label></p>
				</div>
				<div class="input-field col s4">
					<select class="inpute" id="estado" name="estado" required="">
						<option value="" disabled>Estado</option>
						<?php
							$sql4 = "SELECT * from tb_estado order by nm_estado asc";
							$result4 = $mysqli->query($sql4);
							while($row4 = $result4->fetch_object()){
								if ($row4->cd_estado == $row->cd_estado) {
									echo "<option value='".$row4->cd_estado."' selected>".$row4->nm_estado."</option>";
								}
								else{
									echo "<option value='".$row4->cd_estado."'>".$row4->nm_estado."</option>";
								}
								
							}
						?>
					</select>
				</div>
				<div class="input-field col s4">
					<select class="inpute" id="cidade" name="cidade" required="">
						<option value="" disabled selected>Cidade</option>
					</select>
				</div>
				<div class="input-field col s4">
					<input class="alterar1 inpute" id="bairro" type="text" name="bairro" readonly value="<?php echo $row->nm_bairro ?>"><label for="bairro">Bairro</label></p>
				</div>
				<div class="input-field col s12">
					<center><button id="alterarende" class="btn-small red darken-2" title="Editar">Alterar dados de endereço<i class='material-icons right'>edit</i></button></center>
				</div>
	        </div>
	        <div class="row card-panel musenha">
	        	<div class="input-field col s3">
					<input class="inpute" id="senha2" type="password" name="senhatual" value="" ><label for="senha">Senha atual</label><span class="helper-text a1" data-error="wrong" data-success="right"></span>
				</div>
				<div class="input-field col s1">
					<a class="btn waves-effect waves-light orange darken-2" id="senhatual" title="Visualizar"><i class="material-icons large">remove_red_eye</i></a>
				</div>
	        	<div class="input-field col s3">
					<input class="inpute" id="senha" type="password" name="senha" value="" ><label for="senha">Nova senha</label><span class="helper-text a2" data-error="wrong" data-success="right"></span>
				</div>
				<div class="input-field col s1">
					<a class="btn waves-effect waves-light orange darken-2" id="novasenha" title="Visualizar"><i class="material-icons large">remove_red_eye</i></a>
				</div>
				<div class="input-field col s3">
					<input class="inpute" id="senha1" type="password" name="senha1" value="" ><label for="senha1">Confirmar senha</label><span class="helper-text a2" data-error="wrong" data-success="right"></span>
				</div>
				<div class="input-field col s1">
					<a class="btn waves-effect waves-light orange darken-2" id="confirmarsenha" title="Visualizar"><i class="material-icons large">remove_red_eye</i></a>
				</div>
	        </div>
	        
	        
	        <center><button id="botaosenha" class="btn orange darken-2" title="Alterar senha">Alterar senha<i class='material-icons right'>edit</i></button>
	        <button id="efetuar" type="submit" class="btn green accent-4" title="Efetuar alterações" disabled>Efetuar alterações</button></center>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script>
            $(document).ready(function(){
            	$("#procurar").hide();
            	$("#senha1").change(function(){
					var s1 = $("#senha").val();
					var s2 = $("#senha1").val();
					var s3 = $("#senha2").val();
					if(s1 == s2){
						if(s1){
							$(".a2").html("Senhas correspondentes <i class='tiny material-icons left'>check</i>");
							if(s3 == s2){
								$(".a2").html("Nova senha é igual a atual <i class='tiny material-icons left'>clear</i>");
							}
						}
						else{
							$(".a2").html(null);
						}
					}
					else{
						$(".a2").html("Senhas não correspondentes <i class='tiny material-icons left'>clear</i>");
					}
				});
				$("#senha2").change(function(){
					var senhatual = {senhatual: $("#senha2").val()};
			        $.ajax({
			            type: 'POST',
			            url: 'php.php',
			            data: senhatual,
			            success: function(response){
			               $(".a1").html(response);
			            }
		        	});
				});
            	$(".inpute").change(function(){
            		$("#efetuar").removeAttr('disabled');
            	});
            	$("#novasenha").click(function(){
            		$("#senha").attr('type', 'text');
            	});
            	$("#confirmarsenha").click(function(){
            		$("#senha1").attr('type', 'text');
            	});
            	$("#senhatual").click(function(){
            		$("#senha2").attr('type', 'text');
            	});
            	$(".musenha").hide();
            	$("#botaosenha").click(function(){
            		$(".musenha").show(700);
            		$("#botaosenha").hide();
            	});
            	$("#editar").click(function(){
            		$("#procurar").show(700);
            		$("#edit").hide();
            	});
            	$("#alterarpes").click(function(){
            		$(".alterar").removeAttr('readonly');
            		$(".radioal").removeAttr('disabled');
            	});
            	$("#alterarende").click(function(){
            		$(".alterar1").removeAttr('readonly');
            	});
            	$("#cpf").mask("999.999.999-99");
			    $("#cep").mask("99999-999");
			    $("#cell").mask("(99) 99999-9999");
			    $("#tel").mask("(99) 9999-9999");
			    $("#rg").mask("99.999.999-9");
			    $("#cadastrar").click(function(){
					$("#cpf").val($("#cpf").cleanVal());
					$("#cep").val($("#cep").cleanVal());
					$("#tel").val($("#tel").cleanVal());
					$("#celular").val($("#celular").cleanVal());
					$("#rg").val($("#rg").cleanVal());
				});
				$(document).on('change', '#estado', function(){
			        var estado = {estado: $("#estado").val()};
			        $.ajax({
			            type: 'POST',
			            url: 'php.php',
			            data: estado,
			            success: function(response){
			                console.log(response);
			                $("#cidade").html(response);
			                $('select').formSelect();
			            }
		        	});
		    	});
                $('.modal').modal();
                $('select').formSelect();
            });
        </script>
        <div class="section"></div>
	</body>
</html>