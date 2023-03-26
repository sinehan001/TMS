<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['managerid']);
unset($_SESSION['adminid']);
unset($_SESSION['userid']);
session_destroy();
header("Location: signin.php");
?>