<?php
include '../includes/dbh.inc.php';


if(isset($_GET['user']))
{
	$filename = "users.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='loginsystem' AND TABLE_NAME='user'";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT * FROM `user`";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
}

else if(isset($_GET['rec']))
{
	$filename = "recruiters.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='loginsystem' AND TABLE_NAME='recruiter'";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT * FROM `recruiter`";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
}

else if(isset($_GET['job']))
{
	$filename = "joblist.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='loginsystem' AND TABLE_NAME='joblist'";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT * FROM `joblist`";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
}

else if(isset($_GET['app']))
{
	$filename = "applications.csv";
	$fp = fopen('php://output', 'w');

	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='loginsystem' AND TABLE_NAME='applications'";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT * FROM `applications`";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	exit;
}