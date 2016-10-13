<div class="container">
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
			<?php 
			echo '<div class="main">';
			echo '<form action="index.php?id=4" method="post">';
			echo '<div class="form-group field">';
			echo '<label for="groupid">Select Group</label>';
			echo '<select name="groupid" class="form-control">';

			$pdo = Tools::Connect();
			$res = $pdo->query('select * from groups');

			while ($row = $res->fetch())
			{
				echo '<option value="'.$row['id'].'">'.$row['groupname'].'</option>';	
			}

			echo '</select>';
			echo '</div>';

			echo '<div class ="form-group ">';
			echo '<label for="product">Product Name</label>';
			echo '<input type="text" name="product" class="form-control"/>';
			echo '</div>';

			echo '<div class ="form-group ">';
			echo '<label for="country">Maker</label>';
			echo '<input type="text" name="country" class="form-control" />';
			echo '</div>';

			echo '<div class ="form-group ">';
			echo '<label for="price">Product Price</label>';
			echo '<input type="number" name="price" class="form-control"/>';
			echo '</div>';

			echo '<div class ="form-group ">';
			echo '<label for="info">Product Info</label>';
			echo '<textarea name="info"  class="form-control"></textarea>';
			echo '</div>';

			echo '<div class ="form-group ">';
			echo '<input type="reset" value="Reset" class="btn btn-info"> ';
			echo '<input type="submit" name="addproduct" value="Add"  class="btn btn-success"/>';
			echo '</div>';
			echo '</div>';
			echo '</form>';

			if(isset( $_POST['addproduct']))
			{
				$product = trim(htmlspecialchars($_POST['product']));
				$country = trim(htmlspecialchars($_POST['country']));
				$info = trim(htmlspecialchars($_POST['info']));
				if(empty($product)) return;
				$p= new Product($_POST['groupid'], $country, $product, @date('Y/m/d'), $_POST['price'], $info);
				$p->intoDb();
			}


			/*доработать!!!! _____________________________________________________*/
			echo '<form action="index.php?id=4" method="post" enctype="multipart/form-data">';
			echo '<div class="form-group field">';
			echo '<label for="groupid">Select Product</label>';
			echo '<select name="prodid">';

			$pdo = Tools::Connect();
			$res = $pdo->query('select * from products');

			while ($row = $res->fetch())
			{
				echo '<option value="'.$row['id'].'">'.$row['productname'].'</option>';	
			}

			echo '</select>';
			echo '<input type="file" name="file[]" multiple="multiple" accept="image/*" />';
			echo '<input type="submit" name="addimg" value="Add image "  class="btn btn-success"/>';
			echo '</div>';
			echo '</form>';
			
			if (isset($_POST['addimg']))
			{
				$path = "images/";
				$count = 0;

				foreach ($_FILES['file']['name'] as $k => $v)
				{
					if ($_FILES['file']['error'][$k]>0) continue; 
					
					if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $path.$v)) 
					{
						$count++;
						$productid = $_POST['prodid'];
						$ins = 'insert into image (imagepath) values ('.$path.$v.'")';
						$pdo->query($ins);
					}
				}
			}


			?>





		</div>