<?php
$local = "localhost";
$user = "root";
$password = "chinh2003";
$db_name = "ql_ban_smatphon";

$conn = new mysqli($local, $user, $password, $db_name);

if (!isset($conn)) {
    echo "error";
}
?>