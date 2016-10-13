<?php 
class Tools
{
	static function Connect($host='localhost', $user='root', $password='', $dbname='07422exam')
	{
		$dsn="mysql:host=".$host.";dbname=".$dbname.";charset=utf8;";
		$opt=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, 
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND=>"set names 'utf8'" 
			);
		$pdo = new PDO($dsn, $user, $password, $opt);
		return $pdo;
	}

	static function CreateTable($query)
	{
		$pdo=Tools::Connect();
		$pdo->query($query);
	}
}

class Image
{
	private $id, $imagepath,$content, $title;
	function __construct($imagepath,$content, $title, $id)
	{
		$this->imagepath=$imagepath;	
		$this->id=$id;
		$this->content=$content;	
		$this->title=$title;	

	}

	function draw()
	{
		
	echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4"">';
		echo '<div class="card">';
		  echo '<div class="card-block">';
		    echo '<p class="card-text">'.$this->title.'</p>';
		  echo '</div>';
		  $pdo=Tools::Connect();
			$res=$pdo->prepare('select * from image where id=?');
			$res->execute(array($this->id));
			$rezolution='';
			$filesize="";
			foreach ($res as $v )
			{
		 		echo '<img src="'.$v['imagepath'].'" alt="Card image" style="height: 280px; width: 100%; display: block;" class="img-thumbnail">';	
		 		$rezolution = getimagesize($v['imagepath']);
		 		$filesize = filesize($v['imagepath']);
		  	break;
			}
		 	echo ' <div class="card-block">';

		 		echo '<span class="tag tag-success">'.$rezolution[0].'x'.$rezolution[1].'px</span><br>';
				echo '<span class="tag tag-success">Размер файла : '.$filesize.' байт</span><br>';

		    echo '<div class="scrollspy">'.$this->content.'</div>';
		  echo '</div>';
		echo '</div>';
		echo '</div>';




	}

static function fromDb($id)
	{
		$pdo = Tools::Connect();
		$res = $pdo->prepare('select * from image where id=?');
		$res->execute(array($id));
		$imagepath="";
		$content="";
		$title="";
		foreach ($res as $v)
		{
			$imagepath=$v['imagepath'];
			$content=$v['content'];
			$title=$v['title'];
		}
		$image = new Image($imagepath,$content, $title, $id);
		return $image;
	}

}




// class Product
// {
// 	private $id, $groupid, $country, $productname, $info, $datein, $price;

// 	function __construct($groupid, $country, $productname, $datein, $price=0, $info="", $id=0 )
// 	{
// 		$this->groupid=$groupid;
// 		$this->country=$country;
// 		$this->productname=$productname;
// 		$this->datein=$datein;
// 		$this->price=$price;
// 		$this->info=$info;
// 		$this->id=$id;
		

// 	}
// 	function intoDb()
// 	{
// 		$ins='insert into products(groupid, country, productname, price, datein, info) values(?,?,?,?,?,?)';
// 		$pdo=Tools::Connect();
// 		$pr=$pdo->prepare($ins);
// 		$pr->execute(array($this->groupid,$this->country, $this->productname,$this->price, $this->datein,$this->info));
// 	}

// 	function draw()
// 	{
// 		echo '<div class = "pproduct">';
// 		echo '<p class="ptitle">'.$this->productname.'</p>';
// 		/*Добавить для остальныых параметров*/
// 		$pdo=Tools::Connect();
// 		$res=$pdo->prepare('select * from images where productid=?');
// 		$res->execute(array($this->id));
// 		foreach ($res as $v )
// 		{
// 			echo '<img src="'.$v['imagepath'].'" width="200px" alt="picture">';
// 			break;
// 		}
// 		echo '<a href="pages/productinfo.php?pid='.$this->id.'" target="_blank">информация о товаре</a>';
// 		echo '<button type="submit" name="cart'.$this->id.'" class="btn btn-success btn-xs btnStyle">Добавить в корзину</button>';
// 		echo '</div>';
// 	}


// 	function  drawForCart()
// 	{
// 		echo '<div class="row">';
// 		echo '<div class="cartProduct">';
// 		echo '<div class="container">';
// 		echo '<div class="col-sm-3">';
// 		echo '<p class="ptitle">'.$this->productname.'</p>';
// 		/*Добавить для остальныых параметров*/
// 		$pdo=Tools::Connect();
// 		$res=$pdo->prepare('select * from images where productid=?');
// 		$res->execute(array($this->id));
// 		foreach ($res as $v )
// 		{
// 			echo '<img src="'.$v['imagepath'].'" width="200px" alt="picture">';
// 			break;
// 		}
// 		echo '</div>';
// 		echo '<div class="col-sm-9">';
// 		echo '<table class="table table-striped">';
// 		echo '<tbody>';
// 		echo '<tr>';
// 		echo '<td>Страна поставщик</td>';
// 		echo '<td>'.$this->country.'</td>';
// 		echo '</tr>';
// 		echo '<tr>';
// 		echo '<td>Цена за 1 шт</td>';
// 		echo '<td>'.$this->price.'</td>';
// 		echo '</tr>';
// 		echo '<tr>';
// 		echo '<td>Дата выпуска</td>';
// 		echo '<td>'.$this->datein.'</td>';
// 		echo '	</tr>';
// 		echo '</tbody>';
// 		echo '</table>';

// 		echo '<a href="pages/productinfo.php?pid='.$this->id.'" target="_blank">Информация о товаре</a>';
// 		echo '<button type="submit" name="del'.$this->id.'" class="btn btn-warning btn-xs btnStyle">Удалить</button>';
// 		echo '</div>';
// 		echo '</div>';
// 		echo '</div>';
// 		echo '</div>';
// 	}

// 	static function fromDb($id)
// 	{
// 		$pdo = Tools::Connect();
// 		$res = $pdo->prepare('select * from products where id=?');
// 		$res->execute(array($id));
// 		$productname="";
// 		$groupid="";
// 		$country="";
// 		$price="";
// 		$datein="";
// 		$info="";

// 		foreach ($res as $v)
// 		{
// 			$productname=$v['productname'];
// 			$groupid=$v['groupid'];
// 			$country=$v['country'];
// 			$price=$v['price'];
// 			$datein=$v['datein'];
// 			$info=$v['info'];
// 		}
// 		$product = new Product($groupid, $country, $productname, $datein, $price, $info, $id);
// 		return $product;
// 	}


// static function Sale($id)
// {
// 	$pdo=Tools::Connect();
// 	$d=@date('Y/m/d H:i:s');
// 	$sel='insert into sales (product, price, country,datein,groupid, datesale)
// 	select productname, price, country,datein, groupid, "'.$d.'" from products where id='.$id;
// 	/*
// 	$res=$pdo->prepare($sel);
// 	$res->execute(array($id));
// 	$res->closeCursor();
// 	*/
// 	$pdo->query($sel);
// 	$sel='delete from products where id=?';
// 	$res = $pdo->prepare($sel);
// 	$res->execute(array($id));
// 	$res->closeCursor();

// }
// }


// class User
// {
// 	private $username, $pass, $email, $discount, $roleid, $id;

// 	function __construct($username, $pass)
// 	{
// 		$this->username = $username;
// 		$this->pass = $pass;
// 		$this->email = "";
// 		$this->discount =0;
// 		$this->roleid = 2;
// 		$this->id=0;
// 	}

// 	public function setEmail($mail)
// 	{
// 		$this->email = $mail;
// 	}

// 	public function getEmail()
// 	{
// 		return $this->email;
// 	}

// 	public function setDiscount($dics)
// 	{
// 		$this->discount = $dics;
// 	}

// 	public function getDiscount()
// 	{
// 		return $this->discount;
// 	}


// 	public function intoDb()
// 	{
// 		$ins='insert into users(username, pass, email, discount, roleid) values(?,?,?,?,?)';
// 		$pdo=Tools::Connect();
// 		$pr=$pdo->prepare($ins);
// 		$pr->execute(array($this->username,$this->pass, $this->email,$this->discount, $this->roleid));
// 	}

// 	public function login()
// 	{
// 		$pdo=Tools::Connect();
// 		$sel='select * from users where username =? and pass=?';
// 		$res= $pdo->prepare($sel);
// 		$res->execute(array($this->username, $this->pass));
// 		$readname='';
// 		foreach($res as $r)
// 		{
// 			$readname=$r['username'];
// 		}
// 		if($readname==$this->username)
// 		{
// 			echo '<div class="alert alert-success">Вы вошли!</div>';


// 			return true;

// 		}
// 		else
// 		{
// 			echo '<div class="alert alert-danger">Вы не вошли!</div>';
// 			return false;
// 		}
// 	}
// }
?>