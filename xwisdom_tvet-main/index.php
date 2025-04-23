<?php include 'db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="wd-form m-auto mt-10" method="POST" action="">
        <h2>Login Here</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error'];?></div>
        <?php } ?>
        <input type="text" name="uname" class="p-2 w-full inputs" placeholder="Enter Username">
        <input type="password" name="pass1" class="p-2 w-full inputs" placeholder="Enter Password">
        <div class="flex">
            <a href="register.php" class="link">New Click Here ?</a>
            <button name="btn" class="btn p-3 primary">Login</button>
        </div>
    </form>
</body>
</html>
<?php
if (isset($_POST['btn'])) {
    //validate inputs
    $uname = $_POST['uname'];
    $pass1 = $_POST['pass1'];
    if ($uname == "" || $pass1 == "" ) {
        header("location:index.php?error=Missing inputs");
    }else{
        $query = mysqli_query($con,"SELECT * FROM `user` WHERE `UserName`='$uname'");
        $row = mysqli_fetch_array($query);
        if ($row) {
            if(password_verify($pass1,$row["Password"])) {
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["uname"] = $row["UserName"];
                header("location:homePage.php?success");
            }else{
                header("location:index.php?error=No Account Found!");
            }
        }else{
            header("location:index.php?error=No Account Found!");
        }
    }
}
?>