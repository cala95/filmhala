<?php
require_once 'login_register/core/init.php';
if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Filmhala</title>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="col-md-2">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img id="brand" src="img/logo.png">Filmhala</a>
			</div>
			</div>
			
			<div class="col-md-10">
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="index.php">Početna</a></li>
					<li><a href="profile.php?user=<?php echo escape($user->data()->username);?>">Moj profil</a></li>
					</li>
					<li><a href="insert_movie.php">Ubaci film</a></li>
					<li ><a href="find.php">Pronađi film</a></li>
					<li><a href="delete_movie.php">Obriši film</a></li>
					<li class="active" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Nalog
							 <span class="caret"></span></a>
							 		<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="login.php">Ulogujte se</a></li>
										<li><a class="dropdown-item" href="logout.php">Odjavite se</a></li>
										<li><a class="dropdown-item" href="register.php">Registrujte se</a></li>
										<li><a class="dropdown-item" href="changepassword.php">Promenite šifru</a></li>
									</ul>
					</li>
				</ul>
			</div>
			</div>
		</div>
	</nav>
<?php
if(Input::exists()){
	if(Token::check(Input::get('token'))){

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));

		if(($validation)->passed()){
				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;

				$login = $user->login(Input::get('username'), Input::get('password'), $remember);

				if($login){
					//echo 'Uspešno ste se ulogovali!';
					Redirect::to('index.php');
				}else{
					//echo '<p>Niste se uspešno ulogovali! </p>';
					Redirect::to('login.php');
					
				}
		}else{
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
		
	}
}
?>

<div class="container">
	<div class="col-md-6 col-md-offset-3" align="center">
		<div class="jumbotron">
			<div class="form-group">
				<h1>Prijavite se</h1>
			</div>
			<form class = "form-horizontal" action ="" method="POST">
				
				<div class="form-group input-group">
					<label for="username">Korisničko ime:</label>
					<input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Unesite vaše korisničko ime...">
				</div>

				<div class="form-group input-group">
					<label for="password">Šifra:</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Unesite vašu šifru..."> 
				</div>

				<div class="form-group">
					<label for="remember">
					<input type="checkbox" name="remember" id="remember"> Zapamti me
					</label>
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<input type="submit" class="btn-primary" value="Uloguj se">
			</form>
		</div>
	</div>
</div>

	<footer>
		<p>Maja Ćalić, Copyright &copy, 2017</p>
	</footer>

</body>
</html>

	