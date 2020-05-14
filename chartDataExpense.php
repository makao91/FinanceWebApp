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

  $sqlQuery = "SELECT expense_category_assigned_to_user_id, SUM(amount) FROM expenses WHERE user_id = '$userID' AND date_of_expense >= '$dateFrom' AND date_of_expense <= '$dateTo' GROUP BY expense_category_assigned_to_user_id";
  $result = mysqli_query($conn,$sqlQuery);

  $data = array();
  foreach ($result as $row)
  {
    $categoryIdExpense = $row["expense_category_assigned_to_user_id"];
		$catNameQueryEx = "SELECT name FROM expenses_category_assigned_to_users WHERE id = '$categoryIdExpense'";
		$expenseCategoryNameSQLquerry = $conn->query($catNameQueryEx);
		$rowCatEx = $expenseCategoryNameSQLquerry->fetch_assoc();
  	$data[] = array('name'=>$rowCatEx['name'], 'amount'=>$row['SUM(amount)']);
  }
  $result->free_result();
  $expenseCategoryNameSQLquerry->free_result();
  mysqli_close($conn);
  echo json_encode($data);
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie. Informacja deweloperska: '.$e;
}
?>
