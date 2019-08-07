<?php
		
			session_start();
			$_SESSION['quarto']=$_POST['tipoquarto'];
			$checkin=$_POST['checkin'];
			$checkout=$_POST['checkout'];
			//echo $checkin;
			//echo $checkout;

			date_default_timezone_set('America/Sao_paulo');
			$data1 = new datetime($_POST['checkin']);
			$data2 = new datetime($_POST['checkout']);
			while($data1<=$data2)
			{
				
				if($data1->format('D')=="Sun" || $data1->format('D')=="Mon" || $data1->format('D')=="Sat" || $data1->format('D')=="Fri" )
				{
					echo " é mais caro<br>";
					
				}
				else
				{
					echo "Não é caro<br>";

				}
				$data1->modify('+1 day');

			}


			


			//echo $_SESSION['quarto'];
			//header('location:pagamento.php');
		

		?>