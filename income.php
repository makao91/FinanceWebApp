<?php
 session_start();
 require_once "connect.php";

$userID = $_SESSION['id'];
$incomeAmount = $_POST['incomeAmount'];
$incomeDate = $_POST['incomeDate'];
$incomeCategory = $_POST['incomeCategory'];
$incomeComment = $_POST['incomeComment'];

mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());  }

  if($incomeCategory!=1)
  {
        if($incomeDate!=0)
          {
            if($incomeAmount!=0)
              {
                $sqlIncome = "
                INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                VALUES ('$userID', '$incomeCategory', '$incomeAmount', '$incomeDate', '$incomeComment')";
                if($connect->query($sqlIncome))
                {
                  echo 4; //OK
                }
                else
                {
                  throw new Exception($connect->error);
                }
              }
            else
              {
                echo 1; //brak kwoty
              }
          }
        else
        {
          echo 2; // brak daty
        }
  }
  else
  {
    echo 3; // brak kategorii
  }
}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>
