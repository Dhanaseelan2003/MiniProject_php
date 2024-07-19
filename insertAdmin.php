<?php
session_start();
$host = "localhost"; 
$username = "root"; 
$password = "pradeep jw909";
$database = "payrollSystem";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['first_name']) && isset($_POST['last_name']))
{
$sql = "INSERT INTO Employee (first_name, last_name, gender, DOB, department,phone_no) VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[gender]', '$_POST[dob]', '$_POST[department]' , '$_POST[phone_no]')";
if (mysqli_query($conn, $sql)) {
    $employee_id = mysqli_insert_id($conn);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Salary (Employee_id, Gross_salary, Tax_Amount, Deductions, net_salary) VALUES ('$employee_id', '$_POST[gross_salary]', '$_POST[tax_amount]', '$_POST[deductions]', '$_POST[net_salary]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Address (Employee_id, street, Zipcode, country, city) VALUES ('$employee_id', '$_POST[street]', '$_POST[zipcode]', '$_POST[country]', '$_POST[city]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Attendance (Employee_id, date, leave_type) VALUES ('$employee_id', '$_POST[date]', '$_POST[leave_type]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Performance (Employee_id, date, test_type, test_max_score, test_secured_score) VALUES ('$employee_id', '$_POST[date]', '$_POST[test_type]', '$_POST[test_max_score]', '$_POST[test_secured_score]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Jobhistory (Employee_id, job_title, start_date, end_date, job_description) VALUES ('$employee_id', '$_POST[job_title]', '$_POST[start_date]', '$_POST[end_date]', '$_POST[job_description]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Disciplinaryaction (Employee_id, action_date, action_type, action_description) VALUES ('$employee_id', '$_POST[action_date]', '$_POST[action_type]', '$_POST[action_description]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO Employee_login (Employee_id, employee_username, employee_password ) VALUES ('$employee_id', '$_POST[first_name]', '$_POST[first_name]')";
if (!mysqli_query($conn, $sql)) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
header('Location: adminhome.php');
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
    <style>
    body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

form {
  max-width: 800px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

h1 {
  text-align: center;
  color: #333;
}

h2 {
  font-size: 1.2rem;
  margin-top: 20px;
  margin-bottom: 10px;
  color: #333;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #666;
}

input[type="text"],
input[type="date"],
input[type="number"],
textarea {
  border: none;
  border-radius: 5px;
  padding: 10px;
  width: 100%;
  font-size: 1rem;
  margin-bottom: 10px;
  background-color: #f2f2f2;
  color: #666;
  box-sizing: border-box;
}

input[type="radio"] {
  margin-right: 10px;
}

input[type="submit"] {
  background-color: #008CBA;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 1.2rem;
  cursor: pointer;
  width:100%;
  margin-top: 20px;
}

input[type="submit"]:hover {
  background-color: #005f6b;
  
}
</style>
</head>
<body>
	<h1>Add Employee</h1>
	<form method="POST" action="">
		<h2>Employee Details</h2>
		<label for="first_name">First Name:</label>
		<input type="text" name="first_name" required><br>

		<label for="last_name">Last Name:</label>
		<input type="text" name="last_name" required><br>

		<label for="gender">Gender:</label>
		<input type="radio" name="gender" value="M" required>Male
		<input type="radio" name="gender" value="F" required>Female
		<input type="radio" name="gender" value="Other" required>Other<br>

		<label for="dob">Date of Birth:</label>
		<input type="date" name="dob" required><br>

		<label for="department">Department:</label>
		<input type="text" name="department" required><br>

		<h2>Salary</h2>
		<label for="gross_salary">Gross Salary:</label>
		<input type="number" name="gross_salary" required><br>

		<label for="tax_amount">Tax Amount:</label>
		<input type="number" name="tax_amount" required><br>

        <label for="tax_amount">Phone</label>
		<input type="number" name="phone_no" required><br>

		<label for="deductions">Deductions:</label>
		<input type="number" name="deductions" required><br>

		<label for="net_salary">Net Salary:</label>
		<input type="number" name="net_salary" required><br>

		<h2>Address</h2>
		<label for="street">Street:</label>
		<input type="text" name="street" required><br>

		<label for="zipcode">Zipcode:</label>
		<input type="text" name="zipcode" required><br>

		<label for="country">Country:</label>
		<input type="text" name="country" required><br>

		<label for="city">City:</label>
		<input type="text" name="city" required><br>

		<h2>Attendance</h2>
		<label for="date">Date:</label>
		<input type="date" name="date" required><br>

		<label for="leave_type">Leave Type:</label>
		<input type="text" name="leave_type" required><br>

		<h2>Performance</h2>
		<label for="test_type">Test Type:</label>
		<input type="text" name="test_type" required><br>

		<label for="test_max_score">Test Maximum Score:</label>
		<input type="number" name="test_max_score" required><br>

		<label for="test_secured_score">Test Secured Score:</label>
		<input type="number" name="test_secured_score" required><br>

		<h2>Job History</h2>
		<label for="job_title">Job Title:</label>
		<input type="text" name="job_title" required><br>

		<label for="start_date">Start Date:</label>
		<input type="date" name="start_date" required><br>

		<label for="end_date">End Date:</label>
		<input type="date" name="end_date" required><br>
        <label for="job_description">Job Description
	<textarea name="job_description"></textarea><br>

	<h2>Disciplinary Action</h2>
	<label for="action_date">Action Date:</label>
	<input type="date" name="action_date"><br>

	<label for="action_type">Action Type:</label>
	<input type="text" name="action_type"><br>

	<label for="action_description">Action Description:</label>
	<textarea name="action_description"></textarea><br>

	<input type="submit" value="Submit">
</form>
</body>
</html>
