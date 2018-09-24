<?php
require_once 'login_register/core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();

#var_dump(Token::check(Input::get('token'))); 
#we're grabing token from form, which has been set in the session already
#we use Token:check to pass in the token that has been supplied by the form
#Token:check checks if session exists and if the token from form matches the session
#if it does exists we delete it end return true, that means that CSRF has failed

$nameErr = $emailErr = $passErr = $passagainErr ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Obavezno polje";
  }

  if (empty($_POST["email"])) {
    $emailErr = "Obavezno polje";
  }

  if (empty($_POST["password"])) {
    $passErr = "Obavezno polje";
  }

  if (empty($_POST["password_again"])) {
    $passagainErr = "Obavezno polje";
  }
}


if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'email' => array(
				'required' => true,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()){
			$user = new User();

			$salt = Hash::salt(32);
		
			try{
				$user->create(array(
					'username' => Input::get('username'),
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password'), $salt), #It's very important to remember the salt because otherwise password will be lost
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
				));

				Session::flash('home', 'Uspešno ste se registrovali!');
				#header('Location: index.php');
				Redirect::to('index.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		}else{
			//output errors
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	
	<div class="container">
	<div class="col-md-6 col-md-offset-3" align="center">
		<div class="jumbotron">
			<div class="form-group">
				<h1>Registrujte se</h1>
			</div>
			<form class = "form-horizontal" action ="register.php" method="POST">
				
				<div class="form-group input-group">
					<label for="name">Ime i prezime:</label>
					<input type="text" class="form-control" name="name" 
					value="<?php echo escape(Input::get('name')); ?>" id="name" placeholder="Unesite vaše ime i prezime...">
					<span class="error"> * <?php echo $nameErr; ?></span>
				</div>

				<div class="form-group input-group">
					<label for="email">E-mail:</label>
					<input type="email" class="form-control" name="email" id="email" 
					value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" placeholder="Unesite vaš e-mail...">
					<span class="error"> * <?php echo $emailErr; ?></span>
				</div>

				<div class="form-group input-group">
					<label for="username">Korisničko ime:</label>
					<input type="text" class="form-control" name="username" id="username" 
					value="<?php echo escape(Input::get('username')); ?>" autocomplete="off" placeholder="Unesite željeno korisničko ime...">
				</div>

				<div class="form-group input-group">
					<label for="password">Izaberite šifru:</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Unesite šifru..."> 
					<span class="error"> * <?php echo $passErr; ?></span>
				</div>

				<div class="form-group input-group">
					<label for="password_again">Potvrdite šifru:</label>
					<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Ponovite šifru..."> 
					<span class="error"> * <?php echo $passagainErr; ?></span>
				</div>

				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<input type="submit" class="btn-primary" value="Registruj se">
			</form>
		</div>
	</div>
</div>

	<footer>
		<p>Maja Ćalić, Copyright &copy, 2017</p>
	</footer>

</body>
</html>

