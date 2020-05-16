<?php
	session_start();
	require_once "connect.php";
	$userID = $_SESSION['id'];
	$summIncome = 0;
	$summExpense = 0;
	$dateFrom = $_SESSION['dateFrom'];
	$dateTo = $_SESSION['dateTo'];
	try
	{
	  $connect = new mysqli($host,$db_user,$db_password,$db_name);
		$connect -> query ('SET NAMES utf8');
		$connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
	  if($connect->connect_errno!=0)
	  {
	  	throw new Exception(mysqli_connect_errno());
	  }
	}
	catch (Exception $e)
	{
	  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie. Informacja deweloperska: '.$e;
	}
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
	<title>Przegląd finansów</title>
	<meta name="description" content="Opis strony" />
	<meta name="keywords" content="slowa, klucze" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link href="https://fonts.googleapis.com/css?family=Baloo+Paaji+2:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/css_style.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" type="text/css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/customjs.js"></script>

</head>
<body>
	<main>
		<nav>
			<a href="menu.php"><button type="button" class="btn btn-lg btn-warning btn-warning-inverse sticky">Powrót do menu głównego</button></a>
		</nav>
		<header>
			<div class="row container mt-5 mb-3">
				<div class="col-lg-4 ">
					<img class="mt-2" src="img/balance1.jpg" alt="balans1" style="width:100%;">
				</div>
				<div class="col-lg-4 text-center marginY">
					<p class="balanceTitle" >Przegląd finansów</p>
				</div>
				<div class="col-lg-4">
					<img class="mt-2" src="img/balance2.jpg" alt="balans2" style="width:100%;">
				</div>
			</div>
		</header>
		<section>
			<div class="container mt-0 mb-3">
				<div class="row" style="border: dashed 3px #b38600;">
					<div class="col-lg-6 text-center">
						<p class="balanceTitleDate my-0">Wybierz okres:</p>
					</div>
					<div class="col-lg-6">
						<div class="dropdown">
						  <button class="btn btn-info btn-block btn-lg dropdown-toggle mt-2 mb-1" data-flip="false" type="button" id="dateFromToWorkWith" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php
									echo $_SESSION['dateFrom'].' do '.$_SESSION['dateTo'];
								 ?>
						  </button>
						  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dateFromToWorkWith">
						    <button type="button" id="actualMonth" name="actualMonth" class="dropdown-item">Aktualny miesiąc</button>
								<button type="button" id="previousMonth" name="previousMonth" class="dropdown-item">Poprzedni miesiąc</button>
						    <button type="button" id="wholeYear" name="wholeYear" class="dropdown-item">Bierzący cały rok</button>
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header text-center ">Niestandardowa data</h6>
								<form class="px-4 py-3 text-center">
							    <div class="form-group ">
										<label for="dateFrom" class="">Wskaż początkową datę</label>
							      <input type="date" class="form-control ml-2" id="dateFromUncommon" name="dateFromUncommon">
							    </div>
							    <div class="form-group ">
										<label for="dateFrom">Wskaż końcową datę</label>
							      <input type="date" class="form-control ml-2" id="dateToUncommon" name="dateToUncommon">
							    </div>
							    <button type="button" id="uncommonDate" name="uncommonDate" class="btn btn-primary btn-block btn-lg">WYSWIETL</button>
							  </form>
						  </div>
						</div>
					</div>
				</div>
				<div id="showResult">
					<div class="row justify-content-start">
						<div class="col-xl-6">
							<div class="chart-cnt">
								<canvas id="myChart2" width="600" height="200"></canvas>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="chart-cnt">
								<canvas id="myChart" width="600" height="200"></canvas>
							</div>
						</div>
					</div>
				<div class="row justify-content-start">
					<div class="col-lg-3">
						<table style=width:100%;>
							<tr style="font-weight:bold;"><td colspan=2>Podsumowanie przychodów:</td></tr>
<?php
	$fetchIncome = mysqli_query($connect, "SELECT income_category_assigned_to_user_id, SUM(amount) FROM incomes WHERE user_id = '$userID' AND date_of_income >= '$dateFrom' AND date_of_income <= '$dateTo' GROUP BY income_category_assigned_to_user_id");
	while ($rowIncome = mysqli_fetch_array($fetchIncome))
	{
		$summIncome+=$rowIncome["SUM(amount)"];
		$categoryIdIncome = $rowIncome["income_category_assigned_to_user_id"];
		$catNameQueryIn = "SELECT name FROM incomes_category_assigned_to_users WHERE id = '$categoryIdIncome'";
		$incomeCategoryNameSQLquerry = $connect->query($catNameQueryIn);
		$rowCatIn = $incomeCategoryNameSQLquerry->fetch_assoc();
		echo '<tr><td>'.$rowCatIn['name'].'</td><td>'.$rowIncome["SUM(amount)"].' zł'.'</td></tr>';
		$incomeCategoryNameSQLquerry->free_result();
	}
	$fetchIncome->free_result();
?>
						</table>
					</div>
					<div class="col-lg-3">
						<table style=width:100%;>
							<tr style="font-weight:bold;"><td colspan=2>Podsumowanie wydatków:</td></tr>
<?php
	$fetchExpense = mysqli_query($connect, "SELECT expense_category_assigned_to_user_id, SUM(amount) FROM expenses WHERE user_id = '$userID' AND date_of_expense >= '$dateFrom' AND date_of_expense <= '$dateTo' GROUP BY expense_category_assigned_to_user_id");
	while ($rowExpense = mysqli_fetch_array($fetchExpense))
	{
		$summExpense+=$rowExpense["SUM(amount)"];
		$categoryIdExpense = $rowExpense["expense_category_assigned_to_user_id"];
		$catNameQueryEx = "SELECT name FROM expenses_category_assigned_to_users WHERE id = '$categoryIdExpense'";
		$expenseCategoryNameSQLquerry = $connect->query($catNameQueryEx);
		$rowCatEx = $expenseCategoryNameSQLquerry->fetch_assoc();
		echo '<tr><td>'.$rowCatEx['name'].'</td><td>'.$rowExpense["SUM(amount)"].' zł'.'</td></tr>';
		$expenseCategoryNameSQLquerry->free_result();
	}
	$connect->close();
	$fetchExpense->free_result();
?>
						</table>
					</div>
					<div class="col-lg-6 text-center">
						<span style="font-weight:bold;" class="h1">PODSUMOWANIE</span>
						<p class="h5">Wydatki: <?php echo $summExpense.' zł';?></p>
						<p class="h5">Przychody: <?php echo $summIncome.' zł';?></p>
						<p class="h3">SALDO</p>
						<p><?php echo $summIncome-$summExpense.' zł';?></p>
					</div>
				</div>
			</div>
			</div>
		</section>
	</main>
</body>
</html>

<script>
$(document).ready(function(){
	$('#showBalance').click(function(){
			 var dateFromToWorkWith = "<?php echo $dateFrom; ?>";
			 var dateToToWorkWith = "<?php echo $dateTo; ?>";
			 $.ajax({
						url:"updateDate.php",
						method:"POST",
						data:{dateFromToWorkWith:dateFromToWorkWith, dateToToWorkWith:dateToToWorkWith},
						success:function(data)
						{
							 window.location = "balance.php";
						}
			 });
	});
	$('#previousMonth').click(function(){
			 var dateFromToWorkWith = "<?php echo date('Y-m-d', strtotime("first day of -1 month")); ?>";
			 var dateToToWorkWith = "<?php echo date('Y-m-d', strtotime("last day of -1 month")); ?>";
			 $.ajax({
						url:"updateDate.php",
						method:"POST",
						data:{dateFromToWorkWith:dateFromToWorkWith, dateToToWorkWith:dateToToWorkWith},
						success:function(data)
						{
							 window.location = "balance.php";
						}
			 });
	});
	$('#actualMonth').click(function(){
			 var dateFromToWorkWith = "<?php echo date("Y-m-01"); ?>";
			 var dateToToWorkWith = "<?php echo  date("Y-m-t"); ?>";
			 $.ajax({
						url:"updateDate.php",
						method:"POST",
						data:{dateFromToWorkWith:dateFromToWorkWith, dateToToWorkWith:dateToToWorkWith},
						success:function(data)
						{
							 window.location = "balance.php";
						}
			 });
	});
	$('#wholeYear').click(function(){
			 var dateFromToWorkWith = "<?php echo date('Y-01-31'); ?>";
			 var dateToToWorkWith = "<?php echo date('Y-12-31'); ?>";
			 $.ajax({
						url:"updateDate.php",
						method:"POST",
						data:{dateFromToWorkWith:dateFromToWorkWith, dateToToWorkWith:dateToToWorkWith},
						success:function(data)
						{
							 window.location = "balance.php";
						}
			 });
	});
	$('#uncommonDate').click(function(){
			 var dateFromToWorkWith = $('#dateFromUncommon').val();
			 var dateToToWorkWith = $('#dateToUncommon').val();
			 $.ajax({
						url:"updateDate.php",
						method:"POST",
						data:{dateFromToWorkWith:dateFromToWorkWith, dateToToWorkWith:dateToToWorkWith},
						success:function(data)
						{
							 window.location = "balance.php";
						}
			 });
	});
	showGraphEx();
	showGraphIn();
});
function showGraphEx()
{
    {
        $.post("chartDataExpense.php",
        function (data)
        {
            console.log(data);
             var name = [];
            var amount = [];
            for (var i in data) {
                name.push(data[i].name);
                amount.push(data[i].amount);
            }
            var chartdata = {
                labels: name,
                datasets: [
                    {
                        backgroundColor: ["#92a8d1", "#034f84","#3cba9f","#e8c3b9","#c45850", "#f7786b", "#c94c4c", "#50394c", "#618685", "#4040a1", "#36486b", "#d64161", "#ff7b25", "#feb236", "#6b5b95", "#e3eaa7", "#b5e7a0", "#86af49", "#405d27", "#dac292", "#b9936c"],
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: amount
                    }
                ]
            };
            var graphTarget = $("#myChart");
            var barGraph = new Chart(graphTarget, {
                type: 'doughnut',
                data: chartdata,
								options: {
											title:
													{
														display: true,
														text: 'Procentowy udział wydatków'
													}
												}
            });
        });
    }
}
function showGraphIn()
{
    {
        $.post("chartDataIncome.php",
        function (data)
        {
            console.log(data);
             var name = [];
            var amount = [];
            for (var i in data) {
                name.push(data[i].name);
                amount.push(data[i].amount);
            }
            var chartdata = {
                labels: name,
                datasets: [
                    {
                        backgroundColor: ["#d64161", "#ff7b25", "#feb236", "#6b5b95", "#e3eaa7", "#b5e7a0", "#86af49", "#405d27", "#dac292", "#b9936c", "#92a8d1", "#034f84","#3cba9f","#e8c3b9","#c45850", "#f7786b", "#c94c4c", "#50394c", "#618685", "#4040a1", "#36486b"],
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: amount
                    }
                ]
            };
            var graphTarget = $("#myChart2");
            var barGraph = new Chart(graphTarget, {
                type: 'doughnut',
                data: chartdata,
								options: {
											title:
													{
														display: true,
														text: 'Procentowy udział przychodów'
													}
												}
            });
        });
    }
}
</script>
