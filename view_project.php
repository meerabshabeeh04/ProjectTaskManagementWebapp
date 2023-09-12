<?php
include("db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>
    <link href="css/index.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <header style="height: 110px;">
        <hr style="margin:0;opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>

        <?php
        $task = $_GET["tskno"];
        ?>

    </header>

    <?php
    $query14 = "SELECT `PROJECT_ID` FROM `tasks` WHERE `TASK_NO`='$task'";
    $result14 = mysqli_fetch_assoc(mysqli_query($con, $query14));
    $project_id = $result14["PROJECT_ID"];
    $query7 = "SELECT * FROM `project` WHERE `PROJECT_ID`='$project_id'";
    $row7 = mysqli_fetch_assoc(mysqli_query($con, $query7));
            $title = $row7["TITLE"];
            $description = $row7["DESCRIPTION"];
            ?><div style="display:flex; justify-content:center;">
            <h1 style="background-color: darkorchid; text-align:center; width:fit-content; margin:100px 20px 20px 20px; padding:20px; border-radius:10px; color:black;"><?= $title?></h1>
            </div>
            <hr style="opacity:0;"/>
            <p style="margin: 0 10% 6% 10%;"><?= $description?></p>

            <div class="position-relative" style=" margin:0 6% 10% 6%;">
                <div class="position-absolute top-50 start-50">
                <h2 style="text-align:center; color:black; text-decoration:underline; font-size: 30px;"><i>Tasks</i></h1>
                </div>
            </div>

            <?php
            $project = $row7["PROJECT_ID"];
            $query8 = "SELECT * FROM `tasks` WHERE `PROJECT_ID`='$project'";
            $result8 = mysqli_query($con, $query8);
            while ($row8 = mysqli_fetch_assoc($result8)){
                ?>
                <div style="margin: 5% 10% 5% 10%;">
                <h3 style=" color:black; font-size:25px;"><?= $row8["DESCRIPTION"]?></h3>
                <p><b>Status :</b><?= " ".$row8["STATUS"]?></p>
                <?php
                $task = $row8["TASK_NO"];
                $query10 = "SELECT `FIRST_NAME`, `LAST_NAME` FROM `user_` WHERE `USER_ID`=(SELECT `USER_ID` FROM `user_task` WHERE `TASK_NO`='$task')";
                $result10 = mysqli_fetch_assoc(mysqli_query($con, $query10));
                ?>
                <p><b>Assigned To :</b><?= " ".$result10["FIRST_NAME"]." ".$result10["LAST_NAME"]?></p>
                </div>
                <?php
            }
    ?>
    <?php
    ?>

    <footer></footer>
    
</body>
</html>