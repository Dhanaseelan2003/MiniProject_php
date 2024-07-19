<?php
session_start();
$host = "localhost"; 
$username = "root";
$password = "pradeep jw909"; 
$database = "payrollSystem"; 
$connection = mysqli_connect($host, $username, $password, $database);
    
if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
}

$employee_id = $_SESSION['employeeId'];
$query = "SELECT * FROM Employee WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$employee = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Salary WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$salary = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Address WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$address = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Attendance WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$attendance = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Performance WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$performance = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Jobhistory WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$job_history = mysqli_fetch_assoc($result);

$query = "SELECT * FROM Disciplinaryaction WHERE Employee_id = $employee_id ";
$result = mysqli_query($connection, $query);
$disciplinary_action = mysqli_fetch_assoc($result);
?>
<style>
body {
  background-color: #f0c2ca;
}

table {
  margin: 0 auto;
  border-collapse: collapse;
  width: 80%;
  background-color: #ebbb78;
  box-shadow: 0 0 2px rgba(0, 0, 0, 0.15);
  font-family: Arial, sans-serif;
  border-radius: 10px;
  overflow: hidden;
}

table th,
table td {
  padding: 15px;
  text-align: left;
}

table th {
  background-color: #071952;
  color: #ebbb78;
  text-transform: uppercase;
  font-size: 14px;
  font-weight: bold;  
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #ddd;
}

table tr:hover td {
  color: #000;
}

table td {
  font-size: 14px; 
  border-bottom: 1px solid #ddd; 
}
</style>
<body>
<table>
  <tr>
    <th>Employee ID</th>
    <td><?php echo $employee['Employee_id']; ?></td>
  </tr>
  <tr>
    <th>First Name</th>
    <td><?php echo $employee['first_name']; ?></td>
  </tr>
  <tr>
    <th>Last Name</th>
    <td><?php echo $employee['last_name']; ?></td>
  </tr>
  <tr>
    <th>Gender</th>
    <td><?php echo $employee['gender']; ?></td>
  </tr>
  <tr>
    <th>Phone Number</th>
    <td><?php echo $employee['phone_no']; ?></td>
  </tr>
  <tr>
    <th>Date of Birth</th>
    <td><?php echo $employee['DOB']; ?></td>
  </tr>
  <tr>
    <th>Department</th>
    <td><?php echo $employee['department']; ?></td>
  </tr>
  <tr>
    <th>Gross Salary</th>
    <td><?php echo $salary['Gross_salary']; ?></td>
  </tr>
  <tr>
    <th>Tax Amount</th>
    <td><?php echo $salary['Tax_Amount']; ?></td>
  </tr>
  <tr>
    <th>Deductions</th>
    <td><?php echo $salary['Deductions']; ?></td>
  </tr>
  <tr>
    <th>Net Salary</th>
    <td><?php echo $salary['net_salary']; ?></td>
  </tr>
  <tr>
    <th>Street</th>
    <td><?php echo $address['street']; ?></td>
  </tr>
  <tr>
    <th>Zipcode</th>
    <td><?php echo $address['Zipcode']; ?></td>
  </tr>
  <tr>
    <th>Country</th>
    <td><?php echo $address['country']; ?></td>

</tr>
<tr>
  <th>City</th>
  <td><?php echo $address['city']; ?></td>
</tr>
</table>
<h2>Attendance</h2>
<table>
<tr>
  <th>Date</th>
  <th>Leave Type</th>
</tr>
<?php foreach($attendance as $att): ?>
<tr>
  <td><?php echo $attendance['date']; ?></td>
  <td><?php echo $attendance['leave_type'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Performance</h2>
<table>
<tr>
  <th>Date</th>
  <th>Test Type</th>
  <th>Test Max Score</th>
  <th>Test Secured Score</th>
</tr>
<?php 
if(gettype( array_keys($performance)[0])=="string") { ?>
    <tr>
        <td><?php echo $performance['date']; ?></td>
        <td><?php echo $performance['test_type']; ?></td>
        <td><?php echo $performance['test_max_score']; ?></td>
        <td><?php echo $performance['test_secured_score']; ?></td>
    </tr>
<?php }
else
foreach($performance as $perf): ?>
    <tr>
      <td><?php echo $perf['date']; ?></td>
      <td><?php echo $perf['test_type']; ?></td>
      <td><?php echo $perf['test_max_score']; ?></td>
      <td><?php echo $perf['test_secured_score']; ?></td>
    </tr>
    <?php endforeach; ?> 


</table>
<h2>Job History</h2>
<table>
<tr>
  <th>Job Title</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>Job Description</th>
</tr>
<?php
if(gettype( array_keys($job_history)[0])==="string") { ?>
    <tr>
        <td><?php echo $job_history['job_title']; ?></td>
        <td><?php echo $job_history['start_date']; ?></td>
        <td><?php echo $job_history['end_date']; ?></td>
        <td><?php echo $job_history['job_description']; ?></td>
    </tr>
<?php }
else
foreach($job_history as $job): ?>
<tr>
  <td><?php echo $job['job_title']; ?></td>
  <td><?php echo $job['start_date']; ?></td>
  <td><?php echo $job['end_date']; ?></td>
  <td><?php echo $job['job_description']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Disciplinary Action</h2>
<table>
<tr>
  <th>Action Date</th>
  <th>Action Type</th>
  <th>Action Description</th>
</tr>
<?php 
if(gettype( array_keys($disciplinary_action)[0])==="string") { ?>
    <tr>
        <td><?php echo $disciplinary_action['action_date']; ?></td>
        <td><?php echo $disciplinary_action['action_type']; ?></td>
        <td><?php echo $disciplinary_action['action_description']; ?></td>
    </tr>
<?php }
else
foreach($disciplinary_action as $da): ?>
<tr>
  <td><?php echo $da['action_date']; ?></td>
  <td><?php echo $da['action_type']; ?></td>
  <td><?php echo $da['action_description']; ?></td>
</tr>
<?php endforeach; ?>
</table>
</body>
