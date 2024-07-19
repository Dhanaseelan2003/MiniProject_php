<?php
session_start();
if(isset($_SESSION['employeeId'])) {
    $employee_id = $_SESSION['employeeId'];
    $host = "localhost"; 
    $username = "root"; 
    $password = "pradeep jw909"; 
    $database = "payrollSystem"; 

    $conn = mysqli_connect($host, $username, $password, $database);
    
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete from related tables
    $sql1 = "DELETE FROM salary WHERE Employee_id = '$employee_id'";
    $sql2 = "DELETE FROM address WHERE Employee_id = '$employee_id'";
    $sql3 = "DELETE FROM attendance WHERE Employee_id = '$employee_id'";
    $sql4 = "DELETE FROM performance WHERE Employee_id = '$employee_id'";
    $sql5 = "DELETE FROM jobhistory WHERE Employee_id = '$employee_id'";
    $sql6 = "DELETE FROM disciplinaryaction WHERE Employee_id = '$employee_id'";

    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);
    mysqli_query($conn, $sql4);
    mysqli_query($conn, $sql5);
    mysqli_query($conn, $sql6);
    $sql7 = "DELETE FROM employee WHERE employee_id = '$employee_id'";

    if(mysqli_query($conn, $sql7)) {
        echo "Employee deleted successfully.";
    } else {
        echo "Error deleting employee: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: adminhome.php');
    unset($_SESSION['employeeId']);
}
?>
