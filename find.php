<?php
require_once 'login_register/core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('index.php');
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
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="myJavaScript.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  	crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Filmhala</title>

	<script src="suggest.js" type="text/javascript"></script> 
	<script type="text/javascript" src="find_movie_name.js"></script> 

	<script type="text/javascript">
	function place(ele){
	    document.getElementById('txt').value = ele.innerHTML;
		document.getElementById("livesearch").style.display = "none";
	}
	</script>

	<style type="text/css"> 
	#livesearch{ 
	  margin:5px;
	  width:220px;
	  }
	#txt{
	  border: solid #d8d59c;
	  margin:5px;
	  } 
	</style>
</head>
<body onload="document.getElementById('txt').focus()">
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
					<li class="active"><a href="find.php">Pronađi film</a></li>
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
	<div class="col-md-6 col-md-offset-3" align="center">
		<div class="jumbotron">
			<div class="form">
				<div class="form-group">
					<h1 class="text-center">Pronađite film </h1>
					<form class method="post" action="delete_movie.php">
					<input type="text" id="txt" size="32" onkeyup="suggestion(this.value)"/><br>
					<div id="livesearch"></div>
					<input type="button" class="btn-primary" id="sub" value="Pronađi" onclick="ShowMovie(document.getElementById('txt').value)">
					<input type="submit" class="btn-primary" value="Obriši">
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="container" id="newsletter">
	<h1>Budite obaveštavani putem email-a</h1>
	<form>
		<input type="email" name="email" placeholder="Unesite email">
		<button type="submit" class="btn-primary">Pretplati se</button>
	</form>
</div>


	<footer>
		<p>Maja Ćalić, Copyright &copy, 2017</p>
	</footer>

<?php
include "conn.php";
$sql="SELECT * FROM movies";
$result = $mysqli->query($sql);
$mysqli->close();
?>


</body>
</html>