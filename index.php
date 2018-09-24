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
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="myJavaScript.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  	crossorigin="anonymous"></script>
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
					<li class="active"><a href="index.php">Početna</a></li>
					<li><a href="profile.php?user=<?php echo escape($user->data()->username);?>">Moj profil</a></li>
					</li>
					<li><a href="insert_movie.php">Ubaci film</a></li>
					<li><a href="find.php">Pronađi film</a></li>
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
	
	<div class="container" >
		<div id="showcase">
				<h1>Filmhala</h1>
				<h2>Sajt za sve ljubitelje dobrih filmova</h2>
				<p>Gleda Vam se film, a ponestalo Vam je ideja? Trebaju Vam kvalitetne preporuke? Na pravom ste mestu! Učestvujte i ubacite svoje preporuke.</p>
			</div>
	</div>

	

	<div class="container">
		<div id="movies" class="row">
			
		</div>
	</div>

	<div class="container">
		<div id ="movies" class="row"></div>
	</div>

	<div class="container">
	<div class="row filmovi">
		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt5109784/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Mother! (2017)">
				<img alt="Mother! (2017)" class="img-responsive" src="img/mother.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 6.8</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt5109784/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Mother! </h2></a>
				<p>2017</p>
				
			</div>
		</div> 

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt5715874/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="The killing of a Sacred Deer (2017)">
				<img alt="The killing of a Sacred Deer (2017)" class="img-responsive" src="img/sd.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.3</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt5715874/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>The killing of a Sacred Deer </h2></a>
				<p>2017</p>
			</div>
		</div> 

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt3792960/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="The brand new testament (2015)">
				<img alt="The brand new testament (2015)" class="img-responsive" src="img/the_brand_new_testament.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.1</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt3792960/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>The brand new testament </h2></a>
				<p>2015</p>
			</div>
		</div>

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt4226388/?ref_=nv_sr_8" target="_blank" data-toggle="tooltip" data-placement="top" title="Victoria (2015)">
				<img alt="Victoria (2015)" class="img-responsive" src="img/victoria.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.7</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt4226388/?ref_=nv_sr_8" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Victoria </h2></a>
				<p>2015</p>
			</div>
		</div> 

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt4550098/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Nocturnal animals (2016)">
				<img alt="Nocturnal animals (2016)" class="img-responsive" src="img/Nocturnal_Animals_Poster.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.5</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt4550098/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Nocturnal animals </h2></a>
				<p>2016</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt2562232/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Birdman or (The Unexpected Virtue of Ignorance) (2014)">
				<img alt="Birdman or (The Unexpected Virtue of Ignorance) (2014)" class="img-responsive" src="img/Birdman_poster.png">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.8</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt2562232/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Birdman or (The Unexpected Virtue of Ignorance) </h2></a>
				<p>2014</p>
			</div>
		</div>  
</div>

<div class="row filmovi">
		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt5247022/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Paterson (2016)">
				<img alt="Paterson (2016)" class="img-responsive" src="img/paterson.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.4</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt5247022/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Paterson</h2></a>
				<p>2016</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt1798709/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Her (2013)">
				<img alt="Her (2013)" class="img-responsive" src="img/her.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.0</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt1798709/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Her </h2></a>
				<p>2013</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt2872718/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Nightcrawler (2014)">
				<img alt="Nightcrawler (2014)" class="img-responsive" src="img/nightcrawler.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.9</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt2872718/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Nightcrawler </h2></a>
				<p>2014</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt4698684/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Hunt for the Wilderpeople (2016)">
				<img alt="Hunt for the Wilderpeople (2016)" class="img-responsive" src="img/hunt.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.9</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt4698684/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Hunt for the Wilderpeople </h2></a>
				<p>2016</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt0485947/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Mr. Nobody (2009)">
				<img alt="Mr. Nobody (2009)" class="img-responsive" src="img/mrnobody.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.9</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt0485947/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Mr. Nobody </h2></a>
				<p>2009</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt2084970/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="The Imitation Game (2014)">
				<img alt="The Imitation Game (2014)" class="img-responsive" src="img/imitationgame.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 7.8</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt2084970/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>The Imitation Game </h2></a>
				<p>2014</p>
			</div>
		</div>  
</div>




<div class="row filmovi">
		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt0166924/?ref_=nm_knf_i2" target="_blank" data-toggle="tooltip" data-placement="top" title="Mulholland Drive (2001)">
				<img alt="Mulholland Drive (2001)" class="img-responsive" src="img/mulhollanddrive.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.0</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt0166924/?ref_=nm_knf_i2" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Mulholland Drive </h2></a>
				<p>2001</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt2543164/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="Arrival (2016)">
				<img alt="Arrival (2016)" class="img-responsive" src="img/arrival.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.0</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt2543164/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Arrival </h2></a>
				<p>2016</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt2278388/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="top" title="The Grand Budapest Hotel (2014)">
				<img alt="The Grand Budapest Hotel (2014)" class="img-responsive" src="img/hotel.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.1</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt2278388/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>The Grand Budapest Hotel </h2></a>
				<p>2014</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt3170832/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="top" title="Room (2015)">
				<img alt="Room (2015)" class="img-responsive" src="img/room.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.2</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt3170832/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Room </h2></a>
				<p>2015</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt0482571/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="top" title="The Prestige (2006)">
				<img alt="The Prestige (2006)" class="img-responsive" src="img/prestige.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.5</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt0482571/?ref_=nv_sr_1" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>The Prestige </h2></a>
				<p>2006</p>
			</div>
		</div>  

		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="film">
				<a href="http://www.imdb.com/title/tt0947798/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="top" title="Black Swan (2010)">
				<img alt="Black Swan (2010)" class="img-responsive" src="img/blackswan.jpg">
				</a><span class="ocena"><i class="fa fa-star" aria-hidden="true"></i> 8.0</span>
			</div>
			<div class="opis">
				<a href="http://www.imdb.com/title/tt0947798/?ref_=nv_sr_2" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Vidi opis(IMDB)"><h2>Black Swan </h2></a>
				<p>2016</p>
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


</body>
</html>