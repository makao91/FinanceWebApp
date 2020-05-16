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
  $connect -> query ('SET NAMES utf8');
  $connect -> query ('SET CHARACTER_SET utf8_unicode_ci');
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
            if($result = $connect->query("SELECT name FROM incomes_category_default"))
              {
                $resultID = $connect->query("SELECT * FROM users WHERE email='$user_emailReg'");
                $rowID = $resultID->fetch_assoc();
                $realID = $rowID['id'];
                while($row = mysqli_fetch_array($result))
                {
                  $catNameIn = $row['name'];
                  $connect->query("INSERT INTO incomes_category_assigned_to_users (`user_id`, `name`) VALUES ('$realID', '$catNameIn')");
                }
              }
              else
              {
                throw new Exception($connect->error);
              }

              if($result2 = $connect->query("SELECT name FROM expenses_category_default"))
                {
                  while($row2 = mysqli_fetch_array($result2))
                  {
                    $catNameEX = $row2['name'];
                    $connect->query("INSERT INTO expenses_category_assigned_to_users (`user_id`, `name`)
                    VALUES ('$realID', '$catNameEX')");
                  }
                }
                else
                {
                  throw new Exception($connect->error);
                }

                if($result3 = $connect->query("SELECT name FROM payment_methods_default"))
                  {
                    while($row3 = mysqli_fetch_array($result3))
                    {
                      $payName = $row3['name'];
                      $connect->query("INSERT INTO payment_methods_assigned_to_users (`user_id`, `name`) VALUES ('$realID', '$payName')");
                    }
                  }
                  else
                  {
                    throw new Exception($connect->error);
                  }
              $isEmailExist->free_result();
              $result->free_result();
              $result2->free_result();
              $result3->free_result();
              $resultID->free_result();
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
