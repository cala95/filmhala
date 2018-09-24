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
					<li class="active"><a href="profile.php?user=<?php echo escape($user->data()->username);?>">Moj profil</a></li>
					</li>
					<li><a href="insert_movie.php">Ubaci film</a></li>
					<li ><a href="find.php">Pronađi film</a></li>
					<li><a href="delete_movie.php">Obriši film</a></li>
					<li class="dropdown">
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
	<div class="profile">
		<div class="col-md-3">
			<?php
			if($user->isLoggedIn()){
			?>
			<div class="profile-sidebar">
				
				<div class="profile-userpic">
				<img src="img/profile.png" alt="" class="img-responsive img-circle">
				</div>

					<?php
						}else{
							echo '<p>Morate se <a href="login.php">ulogovati</a> ili <a href="register.php">registrovati</a> </p>';
						}
						if(!$username = Input::get('user')){
							Redirect::to('index.php');
						}else{
							$user = new User($username);
							if(!$user->exists()){
								Redirect::to(404); 
							}else{
								$data = $user->data();
							}
							?>
					
					<div class="profile-user-name">
					<h3>Korisničko ime: <?php echo escape($data->username); ?></h3>
					</div>
					
					<div class="profile-full-name">
					<h4>Puno ime: <?php echo escape($data->name);?></h4>
					</div>

					<div class="profile-user-menu">
						<ul class="nav navprofile">
							<li><a href="logout.php"><i class="glyphicon glyphicon-user"></i> Odjavi se</a></li>
							<li><a href="changepassword.php"><i class="glyphicon glyphicon-lock"></i> Promeni šifru</a></li>
							<li><a href="liste.php"><i class="glyphicon glyphicon-film"></i> Moji filmovi</a></li>

						</ul>
					</div>


				</div>
					<?php
				}
			?>
		</div>
		</div>
	</div>
</div>
	

</body>

	<footer>
		<p>Maja Ćalić, Copyright &copy, 2017</p>
	</footer>

</body>
</html>



