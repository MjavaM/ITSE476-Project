<?php 
require_once 'include/db_conn.php';
 session_start();
 unset($_SESSION['include/db_conn.php'][$_GET['pid']]);
 header('location:viewcart.php');

?>