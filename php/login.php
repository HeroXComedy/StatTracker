<?php
//Dumb check for origin
if (!isset($_POST["login"])) {
    header("Location: ../index.php");
    exit();
}
else {
    require 'config.php';
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $usercheck = mysqli_query($conn, "SELECT * FROM Users WHERE username=\"$user\"");
    $sql = "SELECT userID, password FROM Users WHERE username=\"$user\"";
    $userCheck = mysqli_query($conn, $sql);
    if (!empty($userRow = $userCheck->fetch_assoc())) {
        if (password_verify($pass, $userRow["password"])) {
            echo "all good";
            exit();
        }
        else {
            mysqli_close($conn);
            header("Location: ../index.php?origin=log&err=1");
            exit();
        }
    }
    else {
        mysqli_close($conn);
        header("Location: ../index.php?origin=log");
        exit();
    }
    mysqli_close($conn);
}
?>
