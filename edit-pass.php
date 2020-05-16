<?php
 session_start();
 require_once "connect.php";

$user_pass = $_SESSION['password'];
$old_implemented_pass = $_POST['passOldEdit'];
$new_pass = $_POST['passEdit'];
$new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);
$user_id = $_SESSION['id'];

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

  if(password_verify($new_pass, $_SESSION['password'])==false)
    {
      if(password_verify($old_implemented_pass, $_SESSION['password']))
      {
          $sqlUpdatePass = "
          UPDATE users SET password = '$new_pass_hash'
          WHERE id = '$user_id'";
          if($connect->query($sqlUpdatePass))
          {
            $_SESSION['password'] = $new_pass_hash;
            echo 1;
          }
          else
          {
            throw new Exception($connect->error);
          }
     	}
      else {
        echo 2; //your implemented old pass is wrong
      }
    }
    else {
      echo 3;  //old and new pass cannot be the same
    }
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>
