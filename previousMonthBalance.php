<?php
  session_start();
  $dateFromWorkWith = $_POST['dateFromToWorkWith'];
  $dateToWorkWith = $_POST['dateToToWorkWith'];

  unset ($_SESSION['dateTo']);
  unset ($_SESSION['dateFrom']);

  $_SESSION['dateFrom'] = date("Y-(m-1)-01");
	$_SESSION['dateTo'] = 'pipi';
 ?>
