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
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        $delete = mysqli_query($con, "SELECT *  FROM `trainee` WHERE `Trainee_ID` = '$id' ");
        $data = mysqli_fetch_array($delete);
        if ($data) {
        } else {
            header("location:viewTrainee.php?error=Invalid Id");
        }
    } ?>
    <form class="wd-form m-auto mt-10" method="POST" action="">
        <h2>Update Trainee</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error']; ?></div>
        <?php } ?>
        <?php
        if (isset($_GET['success'])) { ?>
            <div class="success"><?php echo $_GET['success']; ?></div>
        <?php } ?>
        <label for="trainee_name" class="mt-10 flex">Enter Trainee Name</label>
        <input type="text" value="<?php echo $data['Trainee_Name'];?>" id="trainee_name" name="trainee_name" class="p-2 w-full inputs" placeholder="Enter Trainee Name Here?">
        <div class="flex">
            <a href="viewTrainee.php" class="link">View All Trainees</a>
            <button name="btn" class="btn p-3 primary">Update</button>
        </div>
    </form>
</body>

</html>
<?php
if (isset($_POST['btn'])) {
    $trainee = $_POST['trainee_name'];
    if ($trainee == "") {
        header("location:trainee.php?error=Trainee Name Is Required");
    } else {
        $query = mysqli_query($con, "UPDATE `trainee` SET `Trainee_Name`='$trainee' WHERE `Trainee_ID` = '$id' ");
        if ($query) {
            header("location:viewTrainee.php?success=Your Trainee Updated well");
        } else {
            header("location:UpdateTrainee.php?error=Error Happened");
        }
    }
}
?>