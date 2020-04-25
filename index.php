<?php
	session_start( );

	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: menu.php');
		exit();
	}
 ?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Tytuł</title>
	<meta name="description" content="Opis strony" />
	<meta name="keywords" content="slowa, klucze" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/fontello.css" >
	<link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css_style.css" type="text/css"/>
	<script src="customjs.js"></script>

</head>

<body>
	<main>
		<header>
			<div class="containerLogo my-5 p-">
				<h1 class="elegantShadow">Reign of money</h1>
			</div>

		</header>
		<div class="container text-center my-5">
			<div class="row">
			<div class="col-lg-8">
					<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleControls" data-slide-to="1"></li>
				  </ol>
				  <div class="carousel-inner">
				    <div class="carousel-item">
				      <div class="row">
				      	<div class="col-md-6 marginY">
									<p class="h4 text-center ">Czy wiesz, że 2.8 mln Polaków posiada przeterminowane długi o łącznej kwocie przekraczającej 76 mld złotych (wg rap. InfoDług)? </p>
				      	</div>
								<div class="col-md-6">
											<img src="img/cat.jpg" class="d-block w-100" alt="cat">
				      	</div>
				      </div>
				    </div>
				    <div class="carousel-item active">
							<div class="row">
				      	<div class="col-md-6 marginY">
									<blockquote class="blockquote">
										<p class="h4 pt-3">Człowiek biedny ceni sobie każdą złotówkę, bogaty każdy grosz.</p>
										<footer class="blockquote-footer">Andrzej Majewski</footer>
									</blockquote>
				      	</div>
								<div class="col-md-6">
									<img src="img/clever.jpg" class="d-block w-100" alt="chess">
				      	</div>
				      </div>
				    </div>
	  			</div>
				  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				  </a>
				</div>
			</div>

			<div class="col-lg-4">
				<p>Przed tobą aplikacja, która pomoże zawładnąć twoimi finansami.</p>
				<p class="h4">Bądź świadom, na co przeznaczasz swoje pieniądze!</p>
				<button type="button" class="btn btn-warning mt-4 btn-shadow btn-lg " data-toggle="modal" data-target="#logging" data-whatever="">Zaloguj się</button>
				<button type="button" class="btn btn-warning mt-4 btn-lg " data-toggle="modal" data-target="#registrating" data-whatever="##">Zarejestruj się</button>
			</div>
		</div>
	</div>
</main>
</body>
</html>
				<div class="modal fade" id="registrating" tabindex="-1" role="dialog" aria-labelledby="panelRejestracji" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="panelRejestracji">Panel rejestracji</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form action="registration.php" method="post">
									<div class="form-group">
								    <i class="icon-user float-left mr-1"></i><input type="text" placeholder="Imię" class="form-control" name="imie" aria-describedby="imie">
								  </div>
									<div class="form-group">
								   <i class="icon-mail float-left mr-1"></i> <input type="email" placeholder="E-mail" class="form-control" name="email" aria-describedby="email">
								  </div>
								  <div class="form-group">
								   <i class="icon-lock float-left mr-1"></i> <input type="passwordLog" placeholder="Hasło" class="form-control" name="passwordLog">
								  </div>
									<div class="form-group">
								    <i class="icon-lock-circled float-left mr-1"></i><input type="passwordLog" placeholder="Powtórz hasło" class="form-control form-control-sm" name="passwordLog2">
								  </div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary btn-lg btn-block">Zarejestruj się</button>
									</div>
				        </form>
				      </div>
				    </div>
				  </div>
				</div>

				<div class="modal fade" id="logging" tabindex="-1" role="dialog" aria-labelledby="panelLogowania" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="panelLogowania">Panel logowania</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="insert_form" method="post">
									<div class="form-group">
										<i class="icon-mail float-left mr-1"></i> <input type="email" placeholder="E-mail" class="form-control" id="emailLog" name="emailLog" aria-describedby="emailLog"/>
									</div>
									<div class="form-group">
									<i class="icon-lock float-left mr-1"></i>	<input type="password" placeholder="Hasło" class="form-control" id="passwordLog" name="passwordLog"/>
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input float-left" id="zapamietajMnie">
										<label class="form-check-label" for="zapamietajMnie">Zapamiętaj mnie</label>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="log-butt" id="log-butt" class="btn btn-primary btn-lg btn-block">Zaloguj się</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
<script>
$(document).ready(function(){
		 $('#log-butt').click(function(){
					var emailLog = $('#emailLog').val();
					var passwordLog = $('#passwordLog').val();
					if(emailLog != '' && passwordLog != '')
					{
							 $.ajax({
										url:"login.php",
										method:"POST",
										data: {emailLog:emailLog, passwordLog:passwordLog},
										success:function(data)
										{
												 if(data == false)
												 {
															alert("Niepoprawny login lub hasło.");
												 }
												 else if (data == true)
												 {
															window.location = "menu.php";
												 }
										}
							 });
					}
					else
					{
							 alert("Oba pola są wymagane");
					}
		 });

});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
