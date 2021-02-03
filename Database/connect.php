<?php 
$host = "localhost";
$user = "root";
$password = "";
$dataTable = "bamr";
$conn = mysqli_connect($host, $user, $password, $dataTable);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}else{
    // echo "connected!!";
}

?>