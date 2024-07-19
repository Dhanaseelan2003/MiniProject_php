<?php 
$host = "localhost";
$username = "root"; 
$password = "pradeep jw909";
$database = "payrollSystem";

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM employee_login";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['employee_id'] . " " . $row['employee_username'] . " " . $row['employee_password'] . "<br>";
  }
?>
