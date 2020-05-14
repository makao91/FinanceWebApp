<?php
header('Content-Type: application/json');
session_start();

$userID = $_SESSION['id'];
$dateFrom = $_SESSION['dateFrom'];
$dateTo = $_SESSION['dateTo'];

try
{
  $conn = mysqli_connect("localhost","root","","finance_app");
  if($conn->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }
  $sqlQuery = "SELECT income_category_assigned_to_user_id, SUM(amount) FROM incomes WHERE user_id = '$userID' AND date_of_income >= '$dateFrom' AND date_of_income <= '$dateTo' GROUP BY income_category_assigned_to_user_id";
  $result = mysqli_query($conn,$sqlQuery);

  $data = array();
  foreach ($result as $row)
  {
    $categoryIdIncome = $row["income_category_assigned_to_user_id"];
		$catNameQueryIn = "SELECT name FROM incomes_category_assigned_to_users WHERE id = '$categoryIdIncome'";
		$incomeCategoryNameSQLquerry = $conn->query($catNameQueryIn);
		$rowCatIn = $incomeCategoryNameSQLquerry->fetch_assoc();
  	$data[] = array('name'=>$rowCatIn['name'], 'amount'=>$row['SUM(amount)']);
  }
  $result->free_result();
  $incomeCategoryNameSQLquerry->free_result();
  mysqli_close($conn);
  echo json_encode($data);
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie. Informacja deweloperska: '.$e;
}
?>
