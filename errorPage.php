<?php
session_start(); 
$errorline = $_SESSION['errorline'];
?>
<html>
<p><?php  echo $errorline;?></p>
</html>
