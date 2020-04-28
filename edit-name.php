<?php
 session_start();
 require_once "connect.php";

$user_name = $_SESSION['username'];
$user_id = $_SESSION['id'];
$new_name = $_POST['nameEdit'];
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }
  if(isset($_SESSION['id']))
   {
        $sqlUpdateName = "
        UPDATE users SET username = '$new_name'
        WHERE id = '$user_id'";
        if($connect->query($sqlUpdateName))
        {
          $_SESSION['username'] = $new_name;
          echo true;
        }
        else
        {
          throw new Exception($connect->error);
        }
   	}
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>
