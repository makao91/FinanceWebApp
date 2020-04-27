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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="panelRejestracji">Panel rejestracji</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form id="registration" method="post">
									<div class="form-group">
								    <i class="icon-user float-left mr-1"></i><input type="text" placeholder="Imię" class="form-control" id="nameReg" name="nameReg" aria-describedby="imie"/>
								  </div>
									<div class="form-group">
								   <i class="icon-mail float-left mr-1"></i> <input type="email" placeholder="E-mail" class="form-control" name="emailReg" id="emailReg" aria-describedby="email"/>
								  </div>
								  <div class="form-group">
								   <i class="icon-lock float-left mr-1"></i> <input type="password" placeholder="Hasło" class="form-control" id="passwordReg" name="passwordReg"/>
								  </div>
									<div class="form-group">
								    <i class="icon-lock-circled float-left mr-1"></i><input type="password" placeholder="Powtórz hasło" class="form-control form-control-sm" id="passwordReg2" name="passwordReg2"/>
								  </div>
									<div class="form-group">
								    <div class="g-recaptcha" data-sitekey="6LdTuu4UAAAAAHuRmUPnRoKcpf7QQWrgHvemRSeA"></div>
								  </div>
									<div class="modal-footer">
										<label class="regulamin">
											<input  type="checkbox" name="statute" id="statute">Akceptuję regulamin</input>
										</label>
										<button type="submit" name="reg-butt" id="reg-butt" class="btn btn-primary btn-lg btn-block">Zarejestruj się</button>
									</div>
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
															alert("Takie konto nie istnieje. Wprowadz poprawnie adres email.");
												 }
												 else if(data == 3)
												 {
													 alert("Niepoprawne hasło.");
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

		 		 $('#reg-butt').click(function(){
					var nameReg = $('#nameReg').val();
					var emailReg = $('#emailReg').val();
					var passwordReg = $('#passwordReg').val();
					var passwordReg2 = $('#passwordReg2').val();
					var statute = document.getElementById('statute');
					<?php
					$_SESSION['recaptcha'] = $_POST['g-recaptcha-response'];
					?>
					if(emailReg != '' && passwordReg != '' && passwordReg2 != '' && nameReg != '')
					{
						if(passwordReg==passwordReg2)
						{
							if(nameReg.length>=3 && nameReg.length<=20)
							{
								if(passwordReg.length>=5 && passwordReg.length<=20)
								{
									if(statute.checked == true)
									{
										$.ajax({
										url:"registration.php",
										method:"POST",
										data: {nameReg:nameReg, emailReg:emailReg, passwordReg:passwordReg, passwordReg2:passwordReg2},
										success:function(data)
										{alert(data);
												 if(data == 1)
												 {
															alert("Uzytkownik o wskazanym adresie email już istnieje. Spróbuj się zalogować lub wprowadzić inny adres email.");
												 }
												 else if(data == 2)
												 {
													 alert("Podaj poprawny adres email.");
												 }
												 else if (data == 3)
												 {
															window.location = "index.php";
															alert("Uzytkownik zarejestrowany pomyślnie. Można się zalogować.");
												 }
												 else if (data == 4)
												 {
													 alert("Botom podziękujemy.");
												 }
										}
							 		});
									}
									else
									{
										alert("Zaakceptuj regulamin.");
									}
								}
								else
								{
									alert("Hasło musi zawierać od 5 do 20 znaków.");
								}
							}
							else
							{
								alert("Imię musi mieć od 3 do 20 znaków.");
							}
						}
						else
						{
							alert("Wprowadzone hasła są różne.");
						}
					}
					else
					{
							 alert("Wszystkie pola są wymagane.");
					}
		 });

});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
