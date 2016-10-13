<?php 
if(isset($_REQUEST['adduser']))
{
	if(isset($_REQUEST['check']))
	{
		$login =trim(htmlspecialchars( $_REQUEST['login']));
		$pass =trim(htmlspecialchars( $_REQUEST['pass']));
		$email =trim(htmlspecialchars( $_REQUEST['email']));
		if(empty($login) || empty($pass)) return;
		$user = new User($login,$pass);
		$user->setEmail($email);
		$user->intoDb();

	}
	else
	{
		$login =trim(htmlspecialchars( $_REQUEST['login']));
		$pass =trim(htmlspecialchars( $_REQUEST['pass']));
		if(empty($login) || empty($pass)) return;
		$user = new User($login,$pass);
		if($user->login())
		{
			session_start();
			$_SESSION['reg']= $login;
		}
	}
}
else
{
	echo '<form action="index.php?id=5" method="post" class="form-horizontal">';
	echo '<div class ="form-group field" >';
	echo '<label>Логин</label>';
	echo '<input name="login" type="text" class="form-control">';
	echo '</div>';
	echo '<div class ="form-group field" >';
	echo '<label>Пароль</label>';
	echo '<input name="pass" type="password" class="form-control">';
	echo '</div>';
	echo '<div class ="form-group field" >';
	echo '<label>Регистрация</label>';
	echo '<input type="checkbox" name="check"  id="check">';
	echo '</div>';
	echo '<div class ="form-group field" >';
	echo '<label id="p2">Повторите пароль</label>';
	echo '<input name="pass2" type="password " id="pass2" class="form-control">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label id="e2">Введите почту:</label>';
	echo '<input type="email" class="form-control" id="email" name="email">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<input type="submit" class="btn btn-success" id="adduser" name="adduser" value="Ввойти">';
	echo ' </div>';
	echo '</form>';
}
?>