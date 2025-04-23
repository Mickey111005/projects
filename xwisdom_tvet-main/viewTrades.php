<?php include("db.php"); ?>
<?php include("checkLogin.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Trades</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("NavBar.php"); ?>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>No<sup>o</sup></th>
                    <th>Trade Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $trades = mysqli_query($con, "SELECT * FROM `trade`");
                $i = 1;
                while ($row = mysqli_fetch_array($trades)) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["Trade_Name"] ?></td>
                        <td>
                            <div class="flex gap-3 w-full">
                                <!-- <button onclick="window.location.href='viewTrades.php?id=<?php echo $row['Trade_Id']; ?>'" class="btn-small bg-red">delete</button> -->
                                <a href='viewTrades.php?id=<?php echo $row['Trade_Id']; ?>' class="btn-small bg-red">delete</a>
                                <a href='UpdateTrade.php?id=<?php echo $row['Trade_Id']; ?>' class="btn-small bg-green">Update</a>
                        
                            </div>
                        </td>
                    </tr>
                <?php $i += 1;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $delete = mysqli_query($con, "DELETE  FROM `trade` WHERE `Trade_ID` = '$id' ");
    if($delete){
        header("location:viewTrades.php");
    }else{
        header("location:viewTrades.php?error=Error DEleting");
    }
} ?>