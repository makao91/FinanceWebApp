<?php
 session_start();
 require_once "connect.php";

$user_email = $_SESSION['emailLog'];
$user_id = $_SESSION['id'];
$new_email = $_POST['emailEdit'];

$newEmailSafe = filter_var($new_email, FILTER_SANITIZE_EMAIL);
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }
  if(filter_var($newEmailSafe, FILTER_VALIDATE_EMAIL)==false || ($newEmailSafe!=$new_email))
  {
    echo false;
  }
  else  if(isset($_SESSION['id']))
   {
        $sqlUpdateEmail = "
        UPDATE users SET email = '$newEmailSafe'
        WHERE id = '$user_id'";
        if($connect->query($sqlUpdateEmail))
        {
          $_SESSION['email'] = $newEmailSafe;
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
