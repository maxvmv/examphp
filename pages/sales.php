<?php 
	session_start();
	if(!$_SESSION['reg'])
	{
		header('Location:index.php?id=5');
	}

	$pdo=Tools::Connect();
	$res=$pdo->query('select * from sales order by datesale');
	$total=0;
	echo '<table class=" table  table-striped">';
	while($row=$res->fetch())
	{
		$total +=$row['price'];
		echo '<tr><td>'.$row['datesale'].'</td>';
		echo '<td>'.$row['product'].'</td>';
		echo '<td>'.$row['price'].'</td></tr>';

	}
	echo '</table>';


	echo '<div class="panel panel-success">';
	  echo '<div class="panel-heading">общая сумма</div>';
	  echo '<div class="panel-body ">'.$total.'</div>';
	echo '</div>';


 ?>