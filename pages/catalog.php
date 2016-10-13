<?php 
foreach ($_REQUEST as $k=>$v) 
{
	if(substr($k,0,4)=="cart")
	{
		$btnid=substr($k, 4);
		setcookie('cart'.$btnid, $btnid);
	}
}
echo '<form action="index.php?id=1" method="post" class="form-horizontal">';
$pdo=Tools::Connect();
echo '<div>';
$res= $pdo->query('select * from groups');
echo '<select name="groupid"  class="form-control" >';
while ($row=$res->fetch()) 
{
	echo '<option value="'.$row['id'].'">'.$row['groupname'].'</option>';
}
echo '</select>';
echo '</div>';
$res = $pdo->query('select id from products');
while ($row=$res->fetch()) 
{
	$product = Product::fromDb($row['id']);
	$product->draw();
}
echo '</form>'
?>