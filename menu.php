<?php
	session_start();

	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	$_SESSION['dateFrom'] = date("Y-m-01");
	$_SESSION['dateTo'] = date("Y-m-t");
 ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Tytuł</title>
	<meta name="description" content="Opis strony" />
	<meta name="keywords" content="slowa, klucze" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="css/fontello.css" >
	<link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css_style.css" type="text/css"/>
	<link rel="stylesheet" href="css_menu.css" type="text/css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src='select2/dist/js/select2.min.js'></script>
	<link rel="stylesheet" href="select2/dist/css/select2.min.css" type="text/css"/>
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
					<p class="menuM menuMain balanceTitle">Menu główne</p>
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
						<button type="button" class="btn btn-danger btn-lg mt-1" data-toggle="modal" data-target="#addExpense">Dodaj wydatek</button>

						<a href="balance.php"><button type="button" class="btn btn-success btn-lg mt-1">Przeglądaj bilans</button></a>
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
													<input type="text" placeholder="nazwa nowej kategorii" class="form-control" id="catIN"/>
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
													<input type="text" placeholder="nazwa nowej kategorii" class="form-control" id="catEX"/>
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
							<input type="number" step="0.01" placeholder="kwota" class="form-control" id="incomeAmount" name="incomeAmount"/>
						</div>
						<div class="row width-100">
							<div class="col-3">
								<button type="button" onclick='currentDateYMD("incomeDate")' class="btn btn-info">Dzisiaj?</button>
							</div>
							<div class="col-6 ml-0">
								<div class="form-group">
									<input type="date" id="incomeDate" name="incomeDate"/>
								</div>
							</div>
							<div class="col-3">
								<button type="button" onclick='previousDateYMD("incomeDate")' class="btn btn-info">Wczoraj?</button>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style='height:28px' for="inputGroupSelect01">Kategoria</label>
									</div>
									<select class="custom-select-md" style='width: 140px;' id="incomeCategory" name="incomeCategory">
										<option value="1">-- Wybierz --</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Komentarz (opcjonalny)" id="incomeComment" name="incomeComment" aria-label="With textarea"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
					<button type="button" name="addIncomeBtn" id="addIncomeBtn" class="btn btn-primary">Dodaj</button>
				</div>
			</div>
		</div>
	</div>

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
											<label class="mb-0"><input type="radio" class="payMethod" value="Karta debetowa" name="payMethod" checked aria-label="gotówka"/>Karta debetowa</label>
										</div>
									</div>
								</div>
							</div>
							<div class="d-inline mr-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="mb-0"><input type="radio" class="payMethod" value="Gotówka" name="payMethod" aria-label="gotówka">Gotówka</label>
										</div>
									</div>
								</div>
							</div>
							<div class="d-inline mr-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<label class="mb-0"><input type="radio" class="payMethod" value="Karta kredytowa" name="payMethod" aria-label="gotówka"/>Karta kredytowa</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="number" step="0.01" placeholder="kwota" class="form-control" id="expenseAmount" name="expenseAmount"/>
						</div>
						<div class="row width-100">
							<div class="col-3">
								<button type="button" onclick='currentDateYMD("expenseDate")' class="btn btn-info">Dzisiaj?</button>
							</div>
							<div class="col-6 ml-0">
								<div class="form-group">
									<input type="date" id="expenseDate" name="expenseDate"/>
								</div>
							</div>
							<div class="col-3">
								<button type="button" onclick='previousDateYMD("expenseDate")' class="btn btn-info">Wczoraj?</button>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<label class="input-group-text" style='height:28px;' for="inputEX">Kategoria</label>
									</div>
									<select class="custom-select-md" style='width: 140px;' id="expenseCategory" name="expenseCategory">
										<option value="1">-- Wybierz --</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Komentarz (opcjonalny)" id="expenseComment" name="expenseComment" aria-label="With textarea"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
					<button type="button" id="addExpenseBtn" name="addExpenseBtn" class="btn btn-primary">Dodaj</button>
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
			$('#addIncomeBtn').click(function(){
									 var incomeAmount = $('#incomeAmount').val();
									 var incomeDate = $('#incomeDate').val();
									 var incomeCategory = $('#incomeCategory').val();
									 var incomeComment = $('#incomeComment').val();
										 				 $.ajax({
														 url:"income.php",
														 method:"POST",
														 data: {incomeAmount:incomeAmount, incomeDate:incomeDate, incomeCategory:incomeCategory, incomeComment:incomeComment},
														 success:function(data)
														 {alert(data);
																	if(data == 1)
																	{
																			 alert("Wpisz kwotę.");
																	}
																	else if(data == 2)
																	{
																		alert("Wpisz datę");
																	}
																	else if(data == 3)
																	{
																		alert("Dodaj nową lub zaznacz kategorię Inny, jeżeli żadna ci nie odpowiada");
																	}
																	else if(data == 4)
																	{
																		alert("Dodano pomyślnie.");
																		window.location = "menu.php";
																	}
														 }
												});
								});
			$('#addExpenseBtn').click(function(){
					 var payMethod = $('.payMethod:checked').val();
					 var expenseAmount = $('#expenseAmount').val();
					 var expenseDate = $('#expenseDate').val();
					 var expenseCategory = $('#expenseCategory').val();
					 var expenseComment = $('#expenseComment').val();
			 				 $.ajax({
							 url:"expense.php",
							 method:"POST",
							 data: {payMethod:payMethod, expenseAmount:expenseAmount, expenseDate:expenseDate, expenseCategory:expenseCategory, expenseComment:expenseComment},
												 success:function(data)
												 {
															if(data == 1)
															{
																	 alert("Wpisz kwotę.");
															}
															else if(data == 2)
															{
																alert("Wpisz datę");
															}
															else if(data == 3)
															{
																alert("Dodaj nową lub zaznacz kategorię Inny, jeżeli żadna ci nie odpowiada");
															}
															else if(data == 4)
															{
																alert("Dodano pomyślnie.")
																window.location = "menu.php";
															}
												 }
									});
								});
			$("#expenseCategory").select2({
			       ajax: {
			         url: "expenseCategory.php",
			         type: "post",
			         dataType: 'json',
			         delay: 250,
							 data: function (params) {
                return {
                  searchTerm: params.term // search term
                };
               },
               processResults: function (response) {
                 return {
                    results: response
                 };
               },
               cache: true
              }
             });
			$("#incomeCategory").select2({
 						       ajax: {
 						         url: "incomeCategory.php",
 						         type: "post",
 						         dataType: 'json',
 						         delay: 250,
 										 data: function (params) {
 			                return {
 			                  searchTerm: params.term // search term
 			                };
 			               },
 			               processResults: function (response) {
 			                 return {
 			                    results: response
 			                 };
 			               },
 			               cache: true
 			              }
 			             });
  });
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
