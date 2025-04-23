<?php include 'db.php'; ?>
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
        <h2>Register Here</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error'];?></div>
        <?php } ?>
        <input type="text" name="uname" class="p-2 w-full inputs" placeholder="Enter Username">
        <input type="password" name="pass1" class="p-2 w-full inputs" placeholder="Enter Password">
        <input type="password" name="pass2" class="p-2 w-full inputs" placeholder="Confrim Password">
        <div class="flex">
            <a href="index.php" class="link">Already Have Account?</a>
            <button name="btn" class="btn p-3 primary">Register</button>
        </div>
    </form>
</body>

</html>
<?php
if (isset($_POST['btn'])) {
    //validate inputs
    $uname = $_POST['uname'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if ($uname == "" || $pass1 == "" || $pass2 == "") {
        header("location:register.php?error=Missing inputs");
    }elseif ($pass1 != $pass2) {
        header("location:register.php?error=Passwords Dont Match");
    }else{
        $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
        $query = mysqli_query($con,"SELECT * FROM `user` WHERE `UserName`='$uname'");
        $row = mysqli_fetch_array($query);
        if($row){
            header("location:register.php?error=Username Is Taken");

        }else{
            $query = mysqli_query($con,"INSERT INTO `user`(`UserName`, `Password`) VALUES ('$uname','$hashed_password')");
            if ($query) {
                header("location:index.php?success");
            }else{
                header("location:register.php?error=Error During Registration");
            }
        }
    }
}
?>