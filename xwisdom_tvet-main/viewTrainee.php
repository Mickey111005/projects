<?php include("db.php"); ?>
<?php include("checkLogin.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Trainees</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("NavBar.php"); ?>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>No<sup>o</sup></th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $trainees = mysqli_query($con, "SELECT * FROM `trainees`");
                $i = 1;
                while ($row = mysqli_fetch_array($trainees)) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["FirstName"] ?></td>
                        <td><?php echo $row["LastName"] ?></td>
                        <td><?php echo $row["Gender"] ?></td>
                        <td>
                            <div class="flex gap-3 w-full">
                                <a href='viewTrainee.php?id=<?php echo $row['Trainee_Id']; ?>' class="btn-small bg-red">delete</a>
                                <a href='UpdateTrainee.php?id=<?php echo $row['Trainee_Id']; ?>' class="btn-small bg-green">Update</a>
                        
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
    $delete = mysqli_query($con, "DELETE  FROM `trainee` WHERE `Trainee_ID` = '$id' ");
    if($delete){
        header("location:viewTrainee.php");
    }else{
        header("location:viewTrainee.php?error=Error DEleting");
    }
} ?>
