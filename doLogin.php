<?php   
session_start();

require("connectdb.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: home.php"); // Redirect to a welcome page after successful login
        } else {
            echo "Incorrect password. <a href='login.php'>Try again</a>.";
        }
    } else {
        echo "Username not found. <a href='register.php'>Register here</a>.";
    }
}

mysqli_close($conn);
?>
