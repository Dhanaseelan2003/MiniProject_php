<?php
session_start();
$host = "localhost"; 
$username = "root"; 
$password = "pradeep jw909"; 
$database = "payrollSystem"; 

$conn = mysqli_connect($host, $username, $password, $database);
    
if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
}
$employee_id = $_SESSION['employee_id'];
$sql_about = "SELECT * FROM employee WHERE Employee_id = $employee_id";
$sql_address = "SELECT * FROM address WHERE Employee_id = $employee_id";
$about_result = mysqli_query($conn, $sql_about);
$address_result = mysqli_query($conn,$sql_address);
$address_array = array();
$about_array = array(); 
while ($row = mysqli_fetch_assoc($about_result)) {
  $about_row = array(); 
  foreach ($row as $column1 => $column2) {
    if($column1==='Employee_id' )continue;
      $about_row[$column1] = $column2;
  }
  $about_array[] = $about_row; 
}
while ($row = mysqli_fetch_assoc($address_result)) {
  $address_row = array(); 
  foreach ($row as $column1 => $column2) {
    if($column1==='Employee_id' or $column1 ==='id')
    continue;
      $address_row[$column1] = $column2;
  }
  $address_array[] = $address_row; 
}
//  if(mysqli_num_rows($address_result)==1)
//  {
//   $address_row = mysqli_fetch_assoc($address_result);
//   $street = $address_row['street'];
//   $zipcode = $address_row['Zipcode'];
//   $country = $address_row['country'];
//   $city = $address_row['city'];
//   $addressLine = $street.','.$city.','.$country.','.$zipcode;  
//  }
 mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Cool Title Navbar</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        text-align: center;
      }
      .header {
        background-color: #fdb9a1;
        margin-bottom: 30px;
      }

      .header h1 {
        color: #3c0808;
        font-size: 40px;
        font-weight: bold;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
      }

      .header h1:hover {
        transform: scale(1.2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #f5532f, #ef2d2d);
      }

      /* .header h1:before {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        right: 0;
        height: 10px;
        background: linear-gradient(135deg, #ff4704, #ff9933);
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.3s ease;
      } */

      /* .header h1:hover:before {
        transform: scaleX(1);
      } */
      .logout-button {
        position: absolute;
        top: 35px;
        left: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, #570f0f, #370c0c);
      }

      .logout-button:hover {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(to right, rgb(189, 90, 8), #e11e1e);
      }

      .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: rgb(207, 207, 207);
      }

      .navbar {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #6e4f41;
        color: #fff;
        padding: 10px;
      }

      .navbar a {
        color: #fff;
        text-decoration: none;
        margin: 0 20px;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        transition: all 0.3s ease;
      }

      .navbar a:before {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        height: 5px;
        background-color: #ff7f50;
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.3s ease;
      }

      .navbar a:hover:before {
        transform: scaleX(1);
      }

      .navbar a:hover {
        color: #ff7f50;
      }
      .details-container {
        display: grid;
        grid-template-columns: auto 1fr;
        grid-gap: 5px;
      }

      .detail-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
      }

      .detail-value {
        display: flex;
        align-items: center;
        font-weight: normal;
      }

      .details-container .detail-label::after {
        margin-left: 2px;
      }

      .detail-item {
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        transition: opacity 0.3s ease;
      }

      .detail-item:hover {
        opacity: 0.7;
      }
    </style>
  </head>
  <body>
    <header class="header">
      <a href="./loginPage.php">
        <button class="logout-button">Logout</button>
      </a>
      <h1>Payroll Management System</h1>
    </header>
    <div class="container">
      <div class="navbar">
        <a href="./about.php">About</a>
        <a href="./salary.php">Salary</a>
        <a href="./attendance.php">Attendance</a>
        <a href="./performance.php">Performance</a>
        <a href="./jobHistory.php">Job History</a>
      </div>
      <div class="details-container">
        <?php 

      foreach ($about_array as $about_row) {
        foreach ($about_row as $key => $value) {
          echo '<div class="detail-item">
          <span class="detail-label">'.$key.'</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">'.$value .'</span>
        </div>';
        }
      }
      foreach ($address_array as $about_row) {
        foreach ($about_row as $key => $value) {
          echo '<div class="detail-item">
          <span class="detail-label">'.$key.'</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">'.$value .'</span>
        </div>';
        }
      }
        ?>
      </div>
    </div>
  </body>
</html>
