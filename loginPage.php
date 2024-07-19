<?php
session_start(); 
$host = "localhost";
$username = "root";
$password = "pradeep jw909"; 
$database = "payrollSystem"; 
if(isset($_POST['submit'])) {
    
    $employee_username = $_POST['username'];
    $employee_password = $_POST['password'];
    $conn = mysqli_connect($host, $username, $password, $database);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST['flipswitch']))
    {
    $sql = "SELECT * FROM employee_login WHERE employee_username='$employee_username' AND employee_password='$employee_password'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
    $employee_id = mysqli_fetch_assoc($result)['employee_id'];
    if(mysqli_num_rows($result) == 1) {
        $_SESSION['employee_id'] = $employee_id;
        header('Location: about.php');
    } else {
      $_SESSION['errorline'] = "Invalid user Credentials";
      header("Location: errorPage.php");
    }}
    else{
      $_SESSION['errorline'] = "Invalid user Credentials";
      header("Location: errorPage.php");
    }
  }
    else{
      if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
      
        $sql = "SELECT admin_id FROM admin_login WHERE admin_username = '$username' AND admin_password = '$password'";
        $result = mysqli_query($conn, $sql);
      
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['admin_id'] = $row['admin_id'];
          if(isset($_SESSION['employeeId'])) unset($_SESSION['employeeId']);
          header("Location: adminhome.php");
          exit;
        } else {
          echo "Invalid username or password.";
        }
    }
    mysqli_close($conn);
}}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
        background-color: #f5a623;
      }

      .login-container {
        width: 400px;
        height: 300px;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-top: 100px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }

      h1 {
        text-align: center;
        color: #f5a623;
        margin-bottom: 30px;
      }

      form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .form-group {
        margin-bottom: 20px;
      }

      input[type="text"],
      input[type="password"] {
        padding: 10px;
        border-radius: 5px;
        border: none;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease-in-out;
        width: 100%;
      }

      .floating-label {
        position: absolute;
        top: 0;
        left: 10px;
        font-size: 12px;
        color: #999;
        transition: all 0.2s ease-in-out;
      }

      input[type="text"]:focus + .floating-label,
      input[type="password"]:focus + .floating-label {
        top: -12px;
        left: 5px;
        font-size: 10px;
      }

      .flipswitch {
        position: relative;
        width: 107px;
      }
      .flipswitch input[type="checkbox"] {
        display: none;
      }
      .flipswitch-label {
        display: block;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid #991111;
        border-radius: 8px;
      }
      .flipswitch-inner {
        width: 200%;
        margin-left: -100%;
        transition: margin 0.3s ease-in 0s;
      }
      .flipswitch-inner:before,
      .flipswitch-inner:after {
        float: left;
        width: 50%;
        height: 24px;
        padding: 0;
        line-height: 24px;
        font-size: 18px;
        color: white;
        font-family: Trebuchet, Arial, sans-serif;
        font-weight: bold;
        box-sizing: border-box;
      }
      .flipswitch-inner:before {
        content: "USER";
        padding-left: 12px;
        background-color: #ad85ff;
        color: #ffffff;
      }
      .flipswitch-inner:after {
        content: "ADMIN";
        padding-right: 12px;
        background-color: #ebacac;
        color: #000000;
        text-align: right;
      }
      .flipswitch-switch {
        width: 29px;
        margin: -2.5px;
        background: #96cbff;
        border: 1px solid #991111;
        border-radius: 8px;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 80px;
        transition: all 0.3s ease-in 0s;
      }
      .flipswitch-cb:checked + .flipswitch-label .flipswitch-inner {
        margin-left: 0;
      }
      .flipswitch-cb:checked + .flipswitch-label .flipswitch-switch {
        right: 0;
      }

      button {
        position: relative;
        background: #444;
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        border: none;
        letter-spacing: 0.1rem;
        font-size: 1rem;
        padding: 1rem 3rem;
        transition: 0.2s;
        margin-top: 30px;
        margin-bottom: 30px;
      }

      button:hover {
        letter-spacing: 0.2rem;
        padding: 1.1rem 3.1rem;
        background: var(--clr);
        color: var(--clr);
        /* box-shadow: 0 0 35px var(--clr); */
        animation: box 3s infinite;
      }

      button::before {
        content: "";
        position: absolute;
        inset: 2px;
        background: #272822;
      }

      button span {
        position: relative;
        z-index: 1;
      }
      button i {
        position: absolute;
        inset: 0;
        display: block;
      }

      button i::before {
        content: "";
        position: absolute;
        width: 10px;
        height: 2px;
        left: 80%;
        top: -2px;
        border: 2px solid var(--clr);
        background: #272822;
        transition: 0.2s;
      }

      button:hover i::before {
        width: 15px;
        left: 20%;
        animation: move 3s infinite;
      }

      button i::after {
        content: "";
        position: absolute;
        width: 10px;
        height: 2px;
        left: 20%;
        bottom: -2px;
        border: 2px solid var(--clr);
        background: #272822;
        transition: 0.2s;
      }

      button:hover i::after {
        width: 15px;
        left: 80%;
        animation: move 3s infinite;
      }

      @keyframes move {
        0% {
          transform: translateX(0);
        }
        50% {
          transform: translateX(5px);
        }
        100% {
          transform: translateX(0);
        }
      }

      @keyframes box {
        0% {
          box-shadow: #27272c;
        }
        50% {
          box-shadow: 0 0 25px var(--clr);
        }
        100% {
          box-shadow: #27272c;
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <h1>Login</h1>
      <form action="" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <div class="flipswitch">
          <input
            type="checkbox"
            name="flipswitch"
            class="flipswitch-cb"
            id="fs"
            checked
          />
          <label class="flipswitch-label" for="fs">
            <div class="flipswitch-inner"></div>
            <div class="flipswitch-switch"></div>
          </label>
        </div>
        <button style="--clr: #8a2be2" type='submit' name="submit" value="submit"><span>Login</span><i></i></button>
      </form>
    </div>
  </body>
</html>
