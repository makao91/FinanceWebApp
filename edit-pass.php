<?php
 session_start();
 require_once "connect.php";

$user_pass = $_SESSION['password'];
$old_implemented_pass = $_POST['passOldEdit'];
$new_pass = $_POST['passEdit'];
$new_pass_hash = password_hash($_POST['passEdit'], PASSWORD_DEFAULT);
$user_id = $_SESSION['id'];

mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }

  if(password_verify($new_pass, $_SESSION['password']))
    {
      echo 1;
    }
  else if(password_verify($old_implemented_pass, $_SESSION['password']))
    {
        $sqlUpdatePass = "
        UPDATE users SET password = '$new_pass_hash'
        WHERE id = '$user_id'";
        if($connect->query($sqlUpdatePass))
        {
          $_SESSION['password'] = $new_pass_hash;
          echo true;
        }
        else
        {
          throw new Exception($connect->error);
        }
   	}
  else
    {
      echo false; //eneven old and implemented old pass
    }  
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>
