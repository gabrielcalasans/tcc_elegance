	<?php include('header.php'); ?>
		<title>Galeria | Hospedagem Elegance</title>
		<?php
	        include('conn.php');
	    ?>
	    <style type="text/css">
	    	body{
                background-color: #FFF7D9;
            }

            nav{
                padding: 0 0 0 10px;
            }

            #logo{
                width: 9%;
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
                width: 9%;
            }
            .foto{
                width: 200px;
                height: 200px;
            }
	    </style>
	</head>
	<body>
		<nav class="grey darken-2">
           <?php
                include('menu.php');
            ?>
        </nav>
        <div class="section">
        	<h4 style="text-align: center;">Galeria</h4>
        	<div class="container">
                <?php 
                    $sql = "SELECT * from tb_galeria";
                    $result = $mysqli->query($sql);
                    if($result->num_rows > 0){
                        $c = 3;
                        while($row = $result->fetch_object()){
                            if($c%3 == 0){
                                echo '<div class="col s4 m4"><img src="'.$row->ds_endereco.'" alt="" class="foto materialboxed responsive-img"></div><br><br>';
                            }
                            else{
                                echo '<div class="col s4 m4"><img src="'.$row->ds_endereco.'" alt="" class="foto materialboxed responsive-img"></div>';
                            }
                            $c++;
                        }
                    }
                ?>
				<!-- <div class="row">
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?forest" alt="" class="materialboxed responsive-img"></div>  
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?snow" alt="" class="materialboxed responsive-img"></div>
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?storm" alt="" class="materialboxed responsive-img"></div>
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?ocean" alt="" class="materialboxed responsive-img"></div>
				</div>
				<div class="row">
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?lion" alt="" class="materialboxed responsive-img"></div>  
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?fox" alt="" class="materialboxed responsive-img"></div>
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?eagle" alt="" class="materialboxed responsive-img"></div>
					<div class="col s3 m3"><img src="https://source.unsplash.com/800x600/?penguin" alt="" class="materialboxed responsive-img"></div>
				</div> -->
			</div>
        </div>
        <script type="text/javascript">
			var mb = document.querySelectorAll('.materialboxed');
		      M.Materialbox.init(mb,{

		      })
		</script>

<?php include('footer.php'); ?>