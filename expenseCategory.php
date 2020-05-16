<?php
require_once "connect.php";
session_start();
$userID = $_SESSION['id'];
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  $connect -> query ('SET NAMES utf8');
  $connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }
    if(!isset($_POST['searchTerm']))
    {
      $fetchData = mysqli_query($connect, "SELECT * FROM expenses_category_assigned_to_users WHERE user_id = '$userID' ORDER BY name");
    }
    else
    {
      $search = $_POST['searchTerm'];
      $fetchData = mysqli_query($connect, "SELECT * FROM expenses_category_assigned_to_users WHERE name LIKE '%".$search."%' AND user_id = '$userID'");
    }
  $data = array();
  while ($row = mysqli_fetch_array($fetchData))
  {
    $data[] = array('id'=>$row['id'], 'text'=>$row['name']);
  }
  $fetchData->free_result();
  echo json_encode($data);
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
?>
