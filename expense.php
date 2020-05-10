<?php
 session_start();
 require_once "connect.php";

$userID = $_SESSION['id'];
$payMethod = $_POST['payMethod'];
$expenseAmount = $_POST['expenseAmount'];
$expenseDate = $_POST['expenseDate'];
$expenseCategory = $_POST['expenseCategory'];
$expenseComment = $_POST['expenseComment'];

mysqli_report(MYSQLI_REPORT_STRICT);
try
{
  $connect = new mysqli($host,$db_user,$db_password,$db_name);
  if($connect->connect_errno!=0)
  {
  	throw new Exception(mysqli_connect_errno());
  }

  if($expenseCategory!="wybierz")
  {
    $expenseCategoryIdSQLquerry = "SELECT id FROM expenses_category_assigned_to_users WHERE user_id = '$userID' AND name = '$expenseCategory'";
    $paymentCategoryIdSQLquerry = "SELECT id FROM payment_methods_assigned_to_users WHERE user_id = '$userID' AND name = '$payMethod'";

    if($expenseCategoryId = $connect->query($expenseCategoryIdSQLquerry))
      {
        $rowExpenseCategory = $expenseCategoryId->fetch_assoc();
        $realIdExpenseCategory = $rowExpenseCategory['id'];
      if($paymentCategoryId = $connect->query($paymentCategoryIdSQLquerry))
        {
          $rowPaymentCategory = $paymentCategoryId->fetch_assoc();
          $realPaymentId = $rowPaymentCategory['id'];
        if($expenseDate!=0)
          {
            if($expenseAmount!=0)
              {
                $sqlExpense = "
                INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment)
                VALUES ('$userID', '$realIdExpenseCategory','$realPaymentId', '$expenseAmount', '$expenseDate', '$expenseComment')";
                if($connect->query($sqlExpense))
                {
                  echo 4;
                }
                else
                {
                  throw new Exception($connect->error);
                }
              }
            else
              {
                echo 1;
              }
          }
        else
        {
          echo 2;
        }
        $expenseCategoryId->free_result();
      }
      else
        {
          throw new Exception($connect->error);
        }
      }
    else
      {
        throw new Exception($connect->error);
      }
  }
  else
  {
    echo 3;
  }

}
catch (Exception $e)
{
  echo 'Błąd serwera! Przepraszamy za niedogodności i prosimy o aktualizację danych w innym terminie. Informacja deweloperska: '.$e;
}
$connect->close();
 ?>