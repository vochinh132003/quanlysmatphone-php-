<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['username'])) {

    // Unset all of the session variables
    $_SESSION = array();

    // Xóa tất cả các biến phiên
    session_unset();

    // Hủy bỏ phiên làm việc
    session_destroy();
}

// Redirect to the login page or any other desired page
header("Location: http://localhost/DOANPHPMYSQL_2023/account/login.php");
exit;
?>