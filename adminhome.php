<?php
session_start();
if(isset($_POST['employeeId'])===null && isset($_SESSION['employeeId']))
unset($_POST['employeeId']);
if(isset($_POST['employeeId']))
{$_SESSION['employeeId'] = $_POST['employeeId'];
    if(isset($_POST['new_employee']))
    {    
    header("Location: insertAdmin.php");
    }
    else if(isset($_POST['modify_employee']) && $_POST['employeeId']!='')
    header("Location: updateAdmin.php");
    else if(isset($_POST['View_employee']) && $_POST['employeeId']!='')
    header("Location: viewAdmin.php");
    else if(isset($_POST['Delete_employee']) && $_POST['employeeId']!='')
    header("Location: DeleteAdmin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Employee Management System</title>
  <style>
    html {
      background-color: rgba(255, 255, 155, 0.8);
    }

    .container {
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background-color: rgba(255, 255, 155, 0.8);
      color: rgba(255, 255, 155, 0.8);
      font-family: Arial, sans-serif;
      width: 100%;
      height: 100%;
    }

    .background {
      background-color: #f1f1f1;
      height: 400px;
      width: 600px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .button-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
    }

    .button {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      flex: 1 1 50%;
      height: 50%;
      color: white;
      text-decoration: none;
      transition: background-color 0.3s ease;
      border:none;
    }

    .blue-button {
      background-color: #4A90E2;
    }

    .red-button {
      background-color: #F44336;
    }

    .green-button {
      background-color: #8BC34A;
    }

    .yellow-button {
      background-color: #FFC107;
    }

    .button-content {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 70%;
      width: 70%;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .button:hover .button-content {
      transform: scale(1);
      background-color: rgba(232, 103, 16, 0.8)
    }

    .button:hover {
      background-color: rgba(222, 150, 101, 0.8)
    }

    .button-content {
      font-size: 18px;
      transition: font-size 0.3s ease;
    }

    .button-content:hover {
      font-size: 20px;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      outline: none;
      font-size: 16px;
      transition: box-shadow 0.2s ease-in-out;
      margin-bottom:20px;
      margin-top:30px;
    }

    input[type="text"]:hover,
    input[type="text"]:focus {
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    }

    .input-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 20%;
    }

    .button.disabled {
      opacity: 0.5;
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action=""method = "post">
        <div class="input-wrapper">
            <input type="text" id="employee-id-input" name="employeeId" >
        </div>
        <div class="background">
            <div class="button-container">
                <button class="button blue-button" name = "new_employee" value = "1">
                    <div class="button-content">
                        New Employee
                    </div>
                </button>
                <button class="button red-button" name = "modify_employee" value = "1">
                    <div class="button-content">
                        Modify user
                    </div>
                </button>
                <button class="button green-button" name = "View_employee" value = "1">
                    <div class="button-content">
                        View Employee
                    </div>
                </button>
                <button class="button yellow-button" name = "Delete_employee" value = "1">
                    <div class="button-content">
                        Delete Employee
                    </div>
                </button>
            </div>
        </div>
    </form>
  </div>
</body>
</html>
















<!-- <html>
    <head>
        <style>
html{
    background-color: rgba(255, 255, 155, 0.8);
}
.container {
  margin: 0 auto;
  display:flex;
  align-items:center;
  justify-content:center;
  flex-direction:column;
  background-color: rgba(255, 255, 155, 0.8);
  color: rgba(255, 255, 155, 0.8);
  font-family: Arial, sans-serif;
  width:100%;
  height:100%;
}
.background {
  background-color: #f1f1f1;
  height: 400px;
  width: 600px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.button-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

.button {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex: 1 1 50%;
  height: 50%;
  color: white;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.blue-button {
  background-color: #4A90E2;
}

.red-button {
  background-color: #F44336;
}

.green-button {
  background-color: #8BC34A;
}

.yellow-button {
  background-color: #FFC107;
}

.button-content {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 70%;
  width: 70%;
  transition: transform 0.3s ease, background-color 0.3s ease;
}

.button:hover .button-content {
  transform: scale(1);
  background-color: rgba(232, 103, 16, 0.8)
}

.button:hover {
    background-color: rgba(222, 150, 101, 0.8)
}
.button-content {
  font-size: 18px;
  transition: font-size 0.3s ease;
}

.button-content:hover {
  font-size: 20px;
}
input[type="text"] {
  width: 70%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  font-size: 16px;
  transition: box-shadow 0.2s ease-in-out;
}

input[type="text"]:hover,
input[type="text"]:focus {
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
}

.input-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 20%;
}
</style>
</head>
    <body>
    <div class="container">
    <form>
  <div class="input-wrapper">
    <input type="text" placeholder="Enter employee id">
  </div>

  <div class="background">
    <div class="button-container">
      <a href="#" class="button blue-button">
        <div class="button-content">
          View Employee
        </div>
      </a>
      <a href="#" class="button red-button">
        <div class="button-content">
          Add a Employee
        </div>
      </a>
      <a href="#" class="button green-button">
        <div class="button-content">
          Update Employee Data
        </div>
      </a>
      <a href="#" class="button yellow-button">
        <div class="button-content">
          Remove employee
        </div>
      </a>
    </div>
  </div>
  </form>
</div>


    </body>
</html> -->
