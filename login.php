<?php
 session_start();
 require_once "connect.php";

 $connect = @new mysqli($host,$db_user,$db_password,$db_name);

if($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
  exit();
}
$user_login = $_POST["emailLog"];
$user_password = $_POST["passwordLog"];

$user_login = htmlentities($user_login, ENT_QUOTES, "UTF-8");

 if(isset($_POST["emailLog"]))
 {
      $sql = "
      SELECT * FROM users
      WHERE email = '".$_POST["emailLog"]."'
      AND password = '".$_POST["passwordLog"]."'
      ";

      if($result = @$connect->query(
				sprintf("SELECT * FROM users WHERE email='%s'",
				mysqli_real_escape_string($connect,$user_login))))
      {
				$how_many_users = $result->num_rows;
				if($how_many_users > 0)
				{
				 	 $row = $result->fetch_assoc();

					 if(password_verify($user_password, $row['password']))
					 {
						 $_SESSION['zalogowany'] = true;

	           $_SESSION['emailLog'] = $row['email'];
	           $_SESSION['id'] = $row['id'];
	           $_SESSION['username'] = $row['username'];
						 $result->free_result();
						 echo true;
					 }
					 else
					 {
					 	echo 3; //wrong password
					 }
				}
	      else
	      {
	           echo false; //wrong login
	      }
 			}
      else {
        echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
      }
	}
  $connect->close();
 ?>
