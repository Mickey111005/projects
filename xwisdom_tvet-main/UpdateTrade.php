<?php include("db.php"); ?>
<?php include("checkLogin.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("NavBar.php"); ?>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        $delete = mysqli_query($con, "SELECT *  FROM `trade` WHERE `Trade_ID` = '$id' ");
        $data = mysqli_fetch_array($delete);
        if ($data) {
        } else {
            header("location:viewTrades.php?error=Invalid Id");
        }
    } ?>
    <form class="wd-form m-auto mt-10" method="POST" action="">
        <h2>Update Trade</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error']; ?></div>
        <?php } ?>
        <?php
        if (isset($_GET['success'])) { ?>
            <div class="success"><?php echo $_GET['success']; ?></div>
        <?php } ?>
        <label for="trade_name" class="mt-10 flex">Enter Trade Name</label>
        <input type="text" value="<?php echo $data['Trade_Name'];?>" id="trade_name" name="trade_name" class="p-2 w-full inputs" placeholder="Enter Trade Name Here?">
        <div class="flex">
            <a href="viewTrades.php" class="link">View All Trades</a>
            <button name="btn" class="btn p-3 primary">Update</button>
        </div>
    </form>
</body>

</html>
<?php
if (isset($_POST['btn'])) {
    $trade = $_POST['trade_name'];
    if ($trade == "") {
        header("location:trade.php?error=Trade Name Is Required");
    } else {
        $query = mysqli_query($con, "UPDATE `trade` SET `Trade_Name`='$trade' WHERE `Trade_ID` = '$id' ");
        if ($query) {
            header("location:viewTrades.php?success=Your Trade Updated well");
        } else {
            header("location:UpdateTrade.php?error=Error Happened");
        }
    }
}
?>