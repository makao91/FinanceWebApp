<?php
	session_start();

	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/fontello.css" >
	<link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css_style.css" type="text/css"/>
	<script src="customjs.js"></script>
</head>

<body>
	<main>
		<section>
			<button type="button" class="btn btn-lg btn-warning btn-warning-inverse d-inline-block" data-toggle="modal" data-target="#editing-name">Edytuj imię</button>
			<button type="button" class="btn btn-lg btn-warning btn-warning-inverse d-inline-block" data-toggle="modal" data-target="#editing-email">Edytuj e-mail</button>
			<button type="button" class="btn btn-lg btn-warning btn-warning-inverse d-inline-block" data-toggle="modal" data-target="#editing-pass">Zmień hasło</button>
		</section>
		<header>
			<div class="row container mt-5">
				<div class="col-lg-4 ">
					<img class="mt-2" src="img/menu1.jpg" alt="balans1" style="width:100%;">
				</div>
				<div class="col-lg-4 text-center marginY">
					<p class="menuM balanceTitle" >Menu główne</p>
				</div>
				<div class="col-lg-4">
					<img class="mt-2" src="img/menu2.jpg" alt="balans2" style="width:100%;">
				</div>
			</div>
		</header>
		<div class="row">
			<div class="col-lg-6 order-lg-2 text-center ">
				<div class="container mt-5">
					<div class="btn-group-vertical btn-block" role="group" aria-label="First group">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addIncome">Dodaj przychód</button>
						<div class="modal fade" id="addIncome" tabindex="-1" role="dialog" aria-labelledby="addIncome" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="income">Nowy przychód</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>
											<div class="form-group">
												<input type="number" step="0.01" placeholder="kwota" class="form-control" id="amountIN">
											</div>
											<div class="row width-100">
												<div class="col-3">
													<button type="button" onclick='currentDateYMD("dayTarget")' class="btn btn-info">Dzisiaj?</button>
												</div>
												<div class="col-6 ml-0">
													<div class="form-group">
														<input type="date" id="dayTarget">
													</div>
												</div>
												<div class="col-3">
													<button type="button" onclick='previousDateYMD("dayTarget")' class="btn btn-info">Wczoraj?</button>
												</div>
											</div>
											<div class="row">
												<div class="col-8">
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputGroupSelect01">Kategoria</label>
														</div>
														<select class="custom-select-md" id="inputGroupSelect01">
															<option selected>wybierz...</option>
															<option value="1">Wynagrodzenie</option>
															<option value="2">Odsetki bankowe</option>
															<option value="3">Sprzedaż na allegro</option>
															<option value="4">Inne</option>
														</select>
													</div>
												</div>
												<div class="col-1.5">
													<a href=""><p>[Dodaj]</p></a>
												</div>
												<div class="col-1.5">
													<a href=""><p>[Usuń]</p></a>
												</div>
											</div>
											<div class="form-group">
												<textarea class="form-control" placeholder="Komentarz (opcjonalny)" id="commentIN" aria-label="With textarea"></textarea>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
										<button type="button" class="btn btn-primary">Dodaj</button>
									</div>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-danger btn-lg mt-1" data-toggle="modal" data-target="#addExpense">Dodaj wydatek</button>
						<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpense" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="expense">Nowy wydatek</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>
											<div class="row width-100 justify-content-center mb-3">
												<div class="d-inline mx-3">
													<div class="input-group">
													  <div class="input-group-prepend">
													    <div class="input-group-text">
													      <input type="radio" checked aria-label="gotówka">Karta debetowa
													    </div>
													  </div>
													</div>
												</div>
												<div class="d-inline mr-3">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<input type="radio" aria-label="gotówka">Gotówka
															</div>
														</div>
													</div>
												</div>
												<div class="d-inline mr-3">
													<div class="input-group">
														<div class="input-group-prepend">
															<div class="input-group-text">
																<input type="radio" aria-label="gotówka">Karta kredytowa
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<input type="number" step="0.01" placeholder="kwota" class="form-control" id="amountEX">
											</div>
											<div class="row width-100">
												<div class="col-3">
													<button type="button" onclick='currentDateYMD("dayTargetE")' class="btn btn-info">Dzisiaj?</button>
												</div>
												<div class="col-6 ml-0">
													<div class="form-group">
														<input type="date" id="dayTargetE">
													</div>
												</div>
												<div class="col-3">
													<button type="button" onclick='previousDateYMD("dayTargetE")' class="btn btn-info">Wczoraj?</button>
												</div>
											</div>
											<div class="row">
												<div class="col-8">
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<label class="input-group-text" for="inputEX">Kategoria</label>
														</div>
														<select class="custom-select-md" id="inputEX">
															<option selected>wybierz...</option>
															<option value="1">Jedzenie</option>
															<option value="2">Mieszkanie</option>
															<option value="3">Transport</option>
															<option value="4">Telekomunikacja</option>
															<option value="5">Opieka zdrowotna</option>
															<option value="6">Ubranie</option>
															<option value="7">Higiena</option>
															<option value="8">Dzieci</option>
															<option value="9">Rozrywka</option>
															<option value="10">Wycieczka</option>
															<option value="11">Szkolenia</option>
															<option value="12">Książki</option>
															<option value="13">Oszczędności</option>
															<option value="14">Emerytura</option>
															<option value="15">Spłata długów</option>
															<option value="16">Darowizna</option>
															<option value="17">Inne wydatki</option>
														</select>
													</div>
												</div>
												<div class="col-1.5">
													<a href=""><p>[Dodaj]</p></a>
												</div>
												<div class="col-1.5">
													<a href=""><p>[Usuń]</p></a>
												</div>
											</div>
											<div class="form-group">
												<textarea class="form-control" placeholder="Komentarz (opcjonalny)" id="commentEX" aria-label="With textarea"></textarea>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
										<button type="button" class="btn btn-primary">Dodaj</button>
									</div>
								</div>
							</div>
						</div>
						<a href="balance.html"><button type="button" class="btn btn-success btn-lg mt-1">Przeglądaj bilans</button></a>
						<button type="button" id="logout" name="logout" class="btn btn-secondary btn-lg mt-1">Wyloguj się</button>
					</div>
				</div>
			</div>
			<div class="col-lg-3 order-lg-1 container containerLeft mt-5 ">
				<p class="menuM editionMenuL text-center">Edycja przychodów</p>
					<ul class="lista">
						<li>
							<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#addCatIN">Dodaj kategorię</button>
							<div class="modal fade" id="addCatIN" tabindex="-1" role="dialog" aria-labelledby="dodajKategorieIN" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="dodajKategorieIN">Dodaj kategorię</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group">
													<input type="text" placeholder="nazwa nowej kategorii" class="form-control" id="catIN">
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
											<button type="submit" onclick='addCategoryIN()' data-dismiss="modal" class="btn btn-primary">Dodaj</button>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="">
							<button type="button" class="btn btn-primary mb-1" onclick="loadINcategory()" data-toggle="modal" data-target="#delCatIN">Usuń kategorię</button>
							<div class="modal fade" id="delCatIN" tabindex="-1" role="dialog" aria-labelledby="usunKategorieIN" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="usunKategorieIN">Usuń kategorię</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-prepend">
															<label class="input-group-text" for="catINtoDel">Kategoria</label>
														</div>
														<select class="custom-select-md" id="catINtoDel">
															<option selected>wybierz...</option>
														</select>
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
											<button type="submit" onclick='delCategoryIN()' data-dismiss="modal" class="btn btn-primary">Potwierdź</button>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li>
							<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#addCat">Edytuj kategorię</button>
						</li>
						<li>
							<button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#addCat">Usuń ostatni przychód</button>
						</li>
					</ul>
			</div>
			<div class="col-lg-3 order-lg-3 container containerRight mt-5 ">
				<p class="menuM editionMenuR text-center">Edycja wydatków</p>
					<ul class="lista">
						<li>
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#addCatEX">Dodaj kategorię</button>
							<div class="modal fade" id="addCatEX" tabindex="-1" role="dialog" aria-labelledby="dodajKategorieEX" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="dodajKategorieEX">Dodaj kategorię</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group">
													<input type="text" placeholder="nazwa nowej kategorii" class="form-control" id="catEX">
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
											<button type="submit" onclick='addCategoryEX()' data-dismiss="modal" class="btn btn-primary">Dodaj</button>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="">
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#addCat">Usuń kategorię</button>
						</li>
						<li>
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#addCat">Edytuj kategorię</button>
						</li>
						<li>
							<button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#addCat">Usuń ostatni wydatek</button>
						</li>
					</ul>
		</div>
		</div>
	</main>
</body>
</html>

	<div class="modal fade" id="editing-name" tabindex="-1" role="dialog" aria-labelledby="zmianaImienia" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="panelLogowania">Zmień imię</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="edit-name-form" method="post">
						<div class="form-group">
						 <input type="text" placeholder="nowe imię" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="zmieńImię"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" name="editNameButt" id="editNameButt" class="btn btn-primary btn-lg btn-block">Zmień</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editing-email" tabindex="-1" role="dialog" aria-labelledby="zmianaEmaila" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="panelLogowania">Zmień email</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="edit-email-form" method="post">
						<div class="form-group">
						 <input type="email" placeholder="nowy email" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="zmieńImię"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" name="editEmailButt" id="editEmailButt" class="btn btn-primary btn-lg btn-block">Zmień</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editing-pass" tabindex="-1" role="dialog" aria-labelledby="zmianaHasła" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="panelLogowania">Zmień hasło</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="edit-pass-form" method="post">
						<div class="form-group">
						 <input type="password" placeholder="stare hasło" class="form-control mb-2" id="passOldEdit" name="passOldEdit" aria-describedby="zmieńStareHasło"/>
						 <input type="password" placeholder="nowe hasło" class="form-control" id="passEdit" name="passEdit" aria-describedby="zmieńHasło"/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" name="editPassButt" id="editPassButt" class="btn btn-primary btn-lg btn-block">Zmień</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
	$(document).ready(function(){
			$('#logout').click(function(){
					 var action = "logout";
					 $.ajax({
								url:"logout.php",
								method:"POST",
								data:{action:action},
								success:function()
								{
										 window.location = "index.php";
								}
					 });
			});
			$('#editNameButt').click(function(){
					 var nameEdit = $('#nameEdit').val();

						if(nameEdit.length>=3 && nameEdit.length<=20)
						{
							 $.ajax({
										 url:"edit-name.php",
										 method:"POST",
										 data: {nameEdit:nameEdit},
										 success:function(data)
										 {
													if(data == true)
													{
															 alert("Operacja wykonana pomyślnie.");
															 $('#nameEdit').val('');
															 $('#editing-name').modal('hide');
													}
													else
													{
													 alert(data);
													}
										 }
								});
							}
							else
							{
								alert("Imię musi mieć od 3 do 20 znaków.");
							}
					 });
					 $('#editEmailButt').click(function(){
		 					 var emailEdit = $('#emailEdit').val();
		 							 $.ajax({
		 										 url:"edit-email.php",
		 										 method:"POST",
		 										 data: {emailEdit:emailEdit},
		 										 success:function(data)
		 										 {
		 													if(data == true)
		 													{
		 															 alert("Operacja wykonana pomyślnie.");
																	 $('#emailEdit').val('');
		 															 $('#editing-email').modal('hide');
		 													}
															else if(data == false)
															{
																alert("Podano nieprawidłowy format email. Nie wolno stosować polskich znaków i znaków specjalnych. Przykładowy email: twoja@gmail.com.");
															}
		 													else
		 													{
		 													 alert(data);
		 													}
		 										 }
		 								});
		 					 });
							 $('#editPassButt').click(function(){
									 var passEdit = $('#passEdit').val();
									 var passOldEdit = $('#passOldEdit').val();
									 if(passEdit.length>=5 && passEdit.length<=20)
									 {
										 				 $.ajax({
														 url:"edit-pass.php",
														 method:"POST",
														 data: {passEdit:passEdit, passOldEdit:passOldEdit},
														 success:function(data)
														 {
																	if(data == 1)
																	{
																			 alert("Operacja wykonana pomyślnie.");
																			 $('#passEdit').val('');
																			 $('#passOldEdit').val('');
																			 $('#editing-pass').modal('hide');
																	}
																	else if(data == 2)
																	{
																		alert("Wpisz poprawnie stare hasło");
																	}
																	else if(data == 3)
																	{
																		alert("Stare i nowe hasło nie mogą być takie same");
																	}
																	else
																	{
																	 alert(data);
																	}
														 }
												});
									 }
									 else
									 {
									 	alert("Hasło musi zawierać od 5 do 20 znaków.");
									 }

								});
	});

	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
