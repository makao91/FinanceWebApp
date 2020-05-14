<?php
header('Content-Type: application/json');

require_once('connect.php');

session_start();

$userID = $_SESSION['id'];
$dateFrom = $_SESSION['dateFrom'];
$dateTo = $_SESSION['dateTo'];

$sqlQuery = "SELECT * FROM expenses WHERE user_id = 34 AND date_of_expense >= '2020-05-01' AND date_of_expense <= '2020-05-30'";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
