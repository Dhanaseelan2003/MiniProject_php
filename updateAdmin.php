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
$employee_id = $_SESSION['employeeId'];
$sql = "SELECT e.first_name, e.last_name, e.gender, e.DOB, e.department,
        s.gross_salary, s.tax_amount, e.phone_no, s.deductions, s.net_salary,
        a.street, a.zipcode, a.country, a.city,
        at.date, at.leave_type,
        p.test_type, p.test_max_score, p.test_secured_score,
        j.job_title, j.start_date, j.end_date, j.job_description,
        d.action_date, d.action_type, d.action_description
        FROM Employee e
        JOIN Salary s ON e.Employee_id = s.Employee_id
        JOIN Address a ON e.Employee_id = a.Employee_id
        JOIN Attendance at ON e.Employee_id = at.Employee_id
        JOIN Performance p ON e.Employee_id = p.Employee_id
        JOIN JobHistory j ON e.Employee_id = j.Employee_id
        JOIN DisciplinaryAction d ON e.Employee_id = d.Employee_id
        WHERE e.Employee_id = ".$employee_id;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Get the values submitted by the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $department = $_POST['department'];
    $gross_salary = $_POST['gross_salary'];
    $tax_amount = $_POST['tax_amount'];
    $phone_no = $_POST['phone_no'];
    $deductions = $_POST['deductions'];
    $net_salary = $_POST['net_salary'];
    $street = $_POST['street'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $date = $_POST['date'];
    $leave_type = $_POST['leave_type'];
    $test_type = $_POST['test_type'];
    $test_max_score = $_POST['test_max_score'];
    $test_secured_score = $_POST['test_secured_score'];
    $job_title = $_POST['job_title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $job_description = $_POST['job_description'];
    $action_date = $_POST['action_date'];
    $action_type = $_POST['action_type'];
    $action_description = $_POST['action_description'];

    // Build the update query
    $sql = "UPDATE Employee e
            JOIN Salary s ON e.Employee_id = s.Employee_id
            JOIN Address a ON e.Employee_id = a.Employee_id
            JOIN Attendance at ON e.Employee_id = at.Employee_id
            JOIN Performance p ON e.Employee_id = p.Employee_id
            JOIN JobHistory j ON e.Employee_id = j.Employee_id
            JOIN DisciplinaryAction d ON e.Employee_id = d.Employee_id
            SET e.first_name = '$first_name', e.last_name = '$last_name', e.gender = '$gender', e.DOB = '$dob',
                e.department = '$department', s.gross_salary = '$gross_salary', s.tax_amount = '$tax_amount',
                e.phone_no = '$phone_no', s.deductions = '$deductions', s.net_salary = '$net_salary',
                a.street = '$street', a.zipcode = '$zipcode', a.city = '$city', a.country = '$country',
                at.date = '$date', at.leave_type = '$leave_type', p.test_type = '$test_type',
                p.test_max_score = '$test_max_score', p.test_secured_score = '$test_secured_score',
                j.job_title = '$job_title', j.start_date = '$start_date', j.end_date = '$end_date',
                j.job_description = '$job_description', d.action_date = '$action_date', d.action_type = '$action_type',
                d.action_description = '$action_description'
            WHERE e.Employee_id = '$employee_id' ";

    if (mysqli_query($conn, $sql)) {
        header('Location: adminhome.php');
    }
    else
    echo "error in uploading";
}
?>
<style>
  form {
    max-width: 600px;
    margin: 0 auto;
  }

  h2 {
    font-size: 1.5em;
    margin-top: 1.5em;
    margin-bottom: 0.5em;
  }

  label {
    display: block;
    margin-bottom: 0.5em;
    font-weight: bold;
  }

  input[type="text"],
  input[type="number"],
  input[type="date"],
  input[type="tel"],
  textarea,
  select {
    width: 100%;
    padding: 0.5em;
    font-size: 1em;
    margin-bottom: 1em;
    border: 2px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type="radio"] {
    display: inline-block;
    margin-right: 1em;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 0.5em 1em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #3e8e41;
  }

  textarea {
    height: 100px;
  }
</style>

<form method="POST" action="">
    <h2>Employee Details</h2>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br>
<label for="last_name">Last Name:</label>
<input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br>

<label for="gender">Gender:</label>
<input type="radio" name="gender" value="M" <?php if($row['gender'] == 'M') echo 'checked'; ?> required>Male
<input type="radio" name="gender" value="F" <?php if($row['gender'] == 'F') echo 'checked'; ?> required>Female
<input type="radio" name="gender" value="Other" <?php if($row['gender'] == 'Other') echo 'checked'; ?> required>Other<br>

<label for="dob">Date of Birth:</label>
<input type="date" name="dob" value="<?php echo $row['DOB']; ?>" required><br>

<label for="department">Department:</label>
<input type="text" name="department" value="<?php echo $row['department']; ?>" required><br>

<h2>Salary</h2>
<label for="gross_salary">Gross Salary:</label>
<input type="number" name="gross_salary" value="<?php echo $row['gross_salary']; ?>" required><br>

<label for="tax_amount">Tax Amount:</label>
<input type="number" name="tax_amount" value="<?php echo $row['tax_amount']; ?>" required><br>

<label for="phone_no">Phone:</label>
<input type="tel" name="phone_no" value="<?php echo $row['phone_no']; ?>" required><br>

<label for="deductions">Deductions:</label>
<input type="number" name="deductions" value="<?php echo $row['deductions']; ?>" required><br>

<label for="net_salary">Net Salary:</label>
<input type="number" name="net_salary" value="<?php echo $row['net_salary']; ?>" required><br>

<h2>Address</h2>
<label for="street">Street:</label>
<input type="text" name="street" value="<?php echo $row['street']; ?>" required><br>

<label for="zipcode">Zip Code:</label>
<input type="text" name="zipcode" value="<?php echo $row['zipcode']; ?>" required><br>

<label for="city">City:</label>
<input type="text" name="city" value="<?php echo $row['city']; ?>" required><br>

<label for="country">Country:</label>
<input type="text" name="country" value="<?php echo $row['country']; ?>" required><br>

<h2>Attendance</h2>
<label for="date">Date:</label>
<input type="date" name="date" value="<?php echo $row['date']; ?>" required><br>

<label for="leave_type">Leave Type:</label>
<input type="text" name="leave_type" value="<?php echo $row['leave_type']; ?>" required><br>

<h2>Performance</h2>
<label for="test_type">Test Type:</label>
<label for="test_type">Test Type:</label>
<input type="text" name="test_type" value="<?php echo $row['test_type']; ?>" required><br>

<label for="test_max_score">Test Maximum Score:</label>
<input type="number" name="test_max_score" value="<?php echo $row['test_max_score']; ?>" required><br>

<label for="test_secured_score">Test Secured Score:</label>
<input type="number" name="test_secured_score" value="<?php echo $row['test_secured_score']; ?>" required><br>

<h2>Job History</h2>
<label for="job_title">Job Title:</label>
<input type="text" name="job_title" value="<?php echo $row['job_title']; ?>" required><br>

<label for="start_date">Start Date:</label>
<input type="date" name="start_date" value="<?php echo $row['start_date']; ?>" required><br>

<label for="end_date">End Date:</label>
<input type="date" name="end_date" value="<?php echo $row['end_date']; ?>" required><br>

<label for="job_description">Job Description:</label>
<textarea name="job_description" required><?php echo $row['job_description']; ?></textarea><br>

<h2>Disciplinary Action</h2>
<label for="action_date">Action Date:</label>
<input type="date" name="action_date" value="<?php echo $row['action_date']; ?>" required><br>

<label for="action_type">Action Type:</label>
<select name="action_type" required>
    <option value="Written Warning" <?php if($row['action_type'] == 'Written Warning') echo 'selected'; ?>>Written Warning</option>
    <option value="Suspension" <?php if($row['action_type'] == 'Suspension') echo 'selected'; ?>>Suspension</option>
    <option value="Termination" <?php if($row['action_type'] == 'Termination') echo 'selected'; ?>>Termination</option>
</select><br>

<label for="action_description">Action Description:</label>
<textarea name="action_description" required><?php echo $row['action_description']; ?></textarea><br>

<input type="submit" value="Update" name = "update">
    </form>
