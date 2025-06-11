<?php
$servename = "localhost";
$username = "root";
$password = "";
$database = "shopaoquan";

$conn = new mysqli($servename, $username, $password, $database);

if (!$conn){
    die("fail connection");
}

$sql = "SELECT * FROM taikhoan WHERE tenTK = ?";
$stmt = $conn->prepare($sql);

if(!$stmt){
    die("Loi");
}

$tenTk = $_POST['name'];
$mk = $_POST['pass'];

$stmt->bind_param("s" , $tenTk);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $user = $result->fetch_assoc();
    if(password_verify($mk, $user['MatKhau'])){
        echo 'Success';
    }
    else{
        echo 'Wrong';
    }
}else {
    echo 'fail';
}

$stmt->close();
$conn->close();
?>
