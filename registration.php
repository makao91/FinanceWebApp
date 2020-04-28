<?php
 session_start();
 require_once "connect.php";

$user_nameReg = $_POST["nameReg"];
$user_emailReg = $_POST["emailReg"];
$user_passwordReg_hash = password_hash($_POST["passwordReg"], PASSWORD_DEFAULT);

$emailSafe = filter_var($user_emailReg, FILTER_SANITIZE_EMAIL);

mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }
  if(isset($_POST["emailReg"]))
   {
        $sqlReg = "
        INSERT INTO users (username, password, email)
        VALUES ('$user_nameReg', '$user_passwordReg_hash', '$user_emailReg')";
        if($connect->query("SELECT email FROM users WHERE email='$user_emailReg'"))
        {
          $isEmailExist = $connect->query("SELECT email FROM users WHERE email='$user_emailReg'");
        }
        else {
          throw new Exception($connect->error);     
        }
  			$how_much_of_this = $isEmailExist->num_rows;
  			if($how_much_of_this>0)
  			{
  				echo 1;//no records in DB
  			}
  			else if(filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false || ($emailSafe!=$user_emailReg))
  			{
  				echo 2; //wrong email
  			}
        else
        {
  				 if($connect->query($sqlReg))
           {
             echo 3; //everything is fine ;)
           }
  				 else {
             throw new Exception($connect->error);
           }
  			}
  			unset($_POST["emailReg"]);
   	}
  	else
    {
  		header('Location: index.php');
  	}
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>
