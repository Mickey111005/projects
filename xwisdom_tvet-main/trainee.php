<?php include("db.php"); ?>
<?php include("checkLogin.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("NavBar.php"); ?>
<form class="wd-form m-auto mt-10" method="POST" action="">
        <h2>Register New Trainee</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error'];?></div>
        <?php } ?>
        <?php
        if (isset($_GET['success'])) { ?>
            <div class="success"><?php echo $_GET['success'];?></div>
        <?php } ?>
        <label for="firstname" class="mt-10 flex">Enter First Name</label>
        <input type="text" id="firstname" name="firstname" class="p-2 w-full inputs" placeholder="Enter First Name Here?">

        <label for="lastname" class="mt-10 flex">Enter Last Name</label>
        <input type="text" id="lastname" name="lastname" class="p-2 w-full inputs" placeholder="Enter Last Name Here?">

        <label for="trainee_name" class="mt-10 flex">Enter gender</label>
        <input type="text" id="gender" name="gender" class="p-2 w-full inputs" placeholder="Enter Gender Here?"></div>

        <div class="flex">
            <a href="viewTrainee.php" class="link">View All Trainee</a>
            <button name="btn" class="btn p-3 primary">Register</button>
        </div>
    </form>
</body>
</html>
<?php 
if (isset($_POST['btn'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $gender = $_POST['gender'];
    if($first == "" || $last == "" || $gender == ""){
        header("location:trainee.php?error=Something is missing");
    }else{
        $query = mysqli_query($con,"INSERT INTO `trainees`('$first','$last','$gender')");
        if($query) {
            header("location:trainee.php?success=Your Trainee Recorded well");
        }else{
            header("location:trainee.php?error=Error Happened");
        }
    }
}
?>