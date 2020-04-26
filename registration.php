<?php

 require_once "connect.php";

 $connect = @new mysqli($host,$db_user,$db_password,$db_name);

if($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
}
$user_nameReg = $_POST["nameReg"];
$user_emailReg = $_POST["emailReg"];
$user_passwordReg = $_POST["passwordReg"];

 if(isset($_POST["emailReg"]))
 {
      $sqlReg = "
      INSERT INTO users (username, password, email)
      VALUES ('$user_nameReg', '$user_passwordReg', '$user_emailReg');
      ";

			$isEmailExist = $connect->query("SELECT email FROM users WHERE email='$user_emailReg'");
			$how_much_of_this = $isEmailExist->num_rows;
			if($how_much_of_this>0)
			{
				$connect->close();
				echo false;
			}
      else
      {
				 $connect->query($sqlReg);
				 $connect->close();
				 echo true;
			}
 	}
 ?>
