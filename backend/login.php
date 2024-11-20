<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM technician WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $technician = mysqli_fetch_assoc($result);
    if($result){

    if ($technician && password_verify($password, $technician['password'])) {
        $_SESSION['technician_id'] = $technician['technician_id'];
        $_SESSION['email'] = $technician['email'];
        $_SESSION['password'] = $technician['password'];
        header("Location: dashboard.php");
    } else {

        echo "Invalid email or password.";
    }
}else{
    echo "no user found with this email";
}
}

mysqli_close($conn);
?>

<form action="login.php" method="POST">
<label for="id">Id:</label><br>
        <input type="text"  name="technician_id" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit" name="login">Login</button>
    </form>