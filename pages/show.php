<div class="container marketing">
	<div class="row">
		<?php  
		echo '<form action="index.php?id=1" method="post" class="form-horizontal">';
		$pdo=Tools::Connect();


		$res = $pdo->query('select id from image');
		while ($row=$res->fetch()) 
		{
			$image = Image::fromDb($row['id']);
			$image->draw();
		}
		echo '</form>'
		?>
	
	</div>
</div>