<?php include('header.php'); ?>
	<title>Login administrador | Pousada Elegance<</title>
	<style type="text/css">
		body{
				background-color: #5C677D;
			}
		 /* label focus color */
		.input-field input[type=text]:focus + label {
		    color: #283593 !important;
		}

		.input-field input[type=password]:focus + label {
		    color: #283593 !important;
		}
		/* label underline focus color */
		.input-field input[type=text]:focus {
		    border-bottom: 1px solid #283593 !important;
		    box-shadow: 0 1px 0 0 #283593 !important;
		}
		.input-field input[type=password]:focus {
		    border-bottom: 1px solid #283593 !important;
		    box-shadow: 0 1px 0 0 #283593 !important;
		}
		.icon{
            padding: 5px;
            width: 20%;
            color: yellow;
            transition: 0.4s;
        }
        .icon:hover{
            width: 22%;
        }
		#lfooter{
            color: white;
            transition: 0.4s;
        }

        #lfooter:hover{
            color: #FFCA37; 
        }
        #logo{
			width: 8%;
			transition: 0.5s;
		}
		#logo:hover{
			width: 8.5%;
		}
	</style>
</head>
<body>
	<center>
		<nav class="black darken-2">
			<div class="nav-wrapper">
				<a href="index.php"><img id="logo" src="images/logotipo2.png"></a>
			</div>			
		</nav>
		<br>
	</center>
	<?php
		include('conn.php');

		if(isset($_POST['login'])){
			$login = $_POST['login'];
			$senha = $_POST['senha'];
		
			$sql = "SELECT * FROM tb_admin WHERE nm_login = \"$login\" AND ds_senha = \"$senha\"";
			$tipo = $mysqli->query($sql);
			if($tipo->num_rows>0)
			{	
				while($linha = $tipo->fetch_object())
				{
					session_start();				
					$_SESSION['cdadmin'] = $linha->cd_admin;
					$_SESSION['nmadmin'] = $linha->nm_admin;
					$_SESSION['login'] = $linha->ds_login;
					$_SESSION['senha'] = $linha->ds_senha;
					header('Location:painel_admin.php');							
				}
			}
			else
			{
				echo "<script>alert('Tente novamente');</script>";
			} 		
		}
	?>

	<center>
	<b style="font-size: 24px;">ADMINISTRADOR</b>
		<div class="card-panel" style="width: 40%;">
			<div class="row">
			    <form class="col s12" method="post">
				    <div class="row">
				       	<div class="input-field col s12">
				        	<input id="login" type="text" class="validate" name="login" required="">
				          	<label for="login">Login</label>
				       	</div>
				    </div>
				   	<div class="row">
				       	<div class="input-field col s12">
				        	<input id="password" type="password" class="validate" name="senha" required="">
				          	<label for="password">Senha</label>
				       	</div>
				    </div>
				    <button class="btn waves-effect waves-light indigo darken-3" id="logar" type="submit" name="action">CONFIRMAR
  					</button>
				</form>
			</div>
	  	</div>
	</center>
</body>
