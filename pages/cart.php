<?php 
if (isset($_REQUEST['buy']))
{
	$pdo=Tools::Connect();
	foreach($_COOKIE as $k=>$v)
	{
		if(substr($k,0,4) == 'cart')
			{
				$pid =substr($k,4);
				Product::Sale($pid);
				setcookie('cart'.$pid, 0, time()-10);
				       header("Location:index.php?id=2");
			}
	}

}
else
{
		echo '<form action="index.php?id=2" method="post" class="form-horizontal">';
		foreach($_COOKIE as $k=>$v)
		{
			if(substr($k,0,4) == 'cart')
			{

				$cid = substr($k,4);
				$product = Product::fromDb($cid);
				$product -> drawForCart();
			}

		}

		echo '<div class ="form-group field col-lg-6" >';
		echo '<input type="submit"  value="buy" name="buy" class="btn btn-xs btn-success"/>';
		echo '</div>';
		echo '</form>';



}
foreach($_REQUEST as $k=>$v)
		{
			if(substr($k,0,3) == 'del')
			{
				setcookie('cart'.substr($k,3), 0, time()-10);
				header("Location:index.php?id=2");
			}
		}
 ?>
