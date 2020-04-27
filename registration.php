<?php
 session_start();
 require_once "connect.php";

 $connect = @new mysqli($host,$db_user,$db_password,$db_name);

if($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
}
$user_nameReg = $_POST["nameReg"];
$user_emailReg = $_POST["emailReg"];
$user_passwordReg_hash = password_hash($_POST["passwordReg"], PASSWORD_DEFAULT);

$secret_captcha_code = "6LdTuu4UAAAAAMVWsG3JuH_yCcsBolwaHMvneRx1";
$check_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_captcha_code.'&response='.$_SESSION['recaptcha']);
$captcha_result = json_decode($check_captcha);
if($captcha_result->success == true)
{
	$_SESSION['captcha'] = true;
}
else {
	$_SESSION['captcha'] = false;
}

$emailSafe = filter_var($user_emailReg, FILTER_SANITIZE_EMAIL);
if($_SESSION['captcha'] == true)
{
	 if(isset($_POST["emailReg"]))
 {
      $sqlReg = "
      INSERT INTO users (username, password, email)
      VALUES ('$user_nameReg', '$user_passwordReg_hash', '$user_emailReg');
      ";

			$isEmailExist = $connect->query("SELECT email FROM users WHERE email='$user_emailReg'");
			$how_much_of_this = $isEmailExist->num_rows;
			if($how_much_of_this>0)
			{
				$connect->close();
				echo 1;//no records in DB
			}
			else if(filter_var($emailSafe, FILTER_VALIDATE_EMAIL)==false || ($emailSafe!=$user_emailReg))
			{
				echo 2; //wrong email
			}
      else
      {
				 $connect->query($sqlReg);
				 $connect->close();
				 echo 3; //everything is fine ;)
			}
			unset($_POST["emailReg"]);
 	}
	else {
		$connect->close();
		header('Location: index.php');
	}
}
else
{
	$connect->close();
	echo 4; //captcha failed
}

 ?>
