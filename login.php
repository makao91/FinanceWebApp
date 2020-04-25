<?php
 session_start();
 require_once "connect.php";

 $connect = @new mysqli($host,$db_user,$db_password,$db_name);

if($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
}
$user_login = $_POST["emailLog"];
$user_password = $_POST["passwordLog"];

$user_login = htmlentities($user_login, ENT_QUOTES, "UTF-8");
$user_password = htmlentities($user_password, ENT_QUOTES, "UTF-8");

 if(isset($_POST["emailLog"]))
 {
      $sql = "
      SELECT * FROM users
      WHERE email = '".$_POST["emailLog"]."'
      AND password = '".$_POST["passwordLog"]."'
      ";

      if($result = @$connect->query(
				sprintf("SELECT * FROM users WHERE email='%s' AND password='%s'",
				mysqli_real_escape_string($connect,$user_login),
				mysqli_real_escape_string($connect,$user_password))))
      {
				$how_many_users = $result->num_rows;
				if($how_many_users > 0)
				{
					$_SESSION['zalogowany'] = true;
					$row = $result->fetch_assoc();
           $_SESSION['emailLog'] = $row['email'];
           $_SESSION['id'] = $row['id'];
           $_SESSION['username'] = $row['username'];

					 $connect->close();
					 $result->free_result();
					  echo true;
				}
	      else
	      {
	           echo false;
	      }
 			}
	}
 ?>
