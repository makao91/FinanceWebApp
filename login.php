<?php

 session_start();
 require_once "connect.php";

 $connect = @new mysqli($host,$db_user,$db_password,$db_name);

if($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno." Opis: ".$connect->connect_error;
}

 if(isset($_POST["emailLog"]))
 {
      $sql = "
      SELECT * FROM users
      WHERE email = '".$_POST["emailLog"]."'
      AND password = '".$_POST["passwordLog"]."'
      ";
      if($result = @$connect->query($sql))
      {
				$how_many_users = $result->num_rows;
				if($how_many_users > 0)
				{
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
 if(isset($_POST["action"]))
 {
      unset($_SESSION["emailLog"]);
 }
 ?>
