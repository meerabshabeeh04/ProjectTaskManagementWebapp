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
        $id = $_GET["id"];
        $dashboard_url = "dashboard.php?id=".$id;
        $task_url = "my_task.php?id=".$id;
        $add_project_url = "add_project.php?id=".$id;
        $user_url = "user.php?id=".$id;
        ?>

        <ul class="nav nav-tabs">
            <li class="nav-item" style="height:50px; width:10%; margin-top:-25px;">
            <a class="navbar-brand" href="index.php">
                <img src="images/logout-icon.jpg" alt="Logo" width="60" height="50" class="d-inline-block align-text-top">
            </a>
            </li>
            <li class="nav-item" style="height:50px; width:10%; margin-top:-28px;">
            <a class="navbar-brand" href="<?= $user_url?>">
                <img src="images/user-icon.png" alt="Logo" width="60" height="50" class="d-inline-block align-text-top">
            </a>
            </li>
            <li class="nav-item" style="height:50px; width:10%; margin-left:50%;">
                <a class="nav-link" aria-current="page" href="<?= $dashboard_url?>" style="font-size:25%; color: darkorchid;">Notifications</a>
            </li>
            <li class="nav-item" style="height:100px; width:10%;">
                <a class="nav-link active" href="#" style="font-size:25%; color: darkorchid;">My Projects</a>
            </li>
            <li class="nav-item" style="height:100px; width:10%;">
                <a class="nav-link" href="<?= $task_url?>" style="font-size:25%; color: darkorchid;">My Taks</a>
            </li>
        </ul>
    </header>

    <div class="position-relative" style="margin:6% 6% 6% 6%;">
        <div class="position-absolute top-0 start-0">
            <h1 style="color:black; font-size:300%; font-weight:bolder;">My Projects</h1>
        </div>
        <div class="position-absolute top-0 end-0">
        <button style=" justify-content:flex-end; background-color: darkorchid; border:none; border-radius:10px; padding:5px 10px 5px 10px;"><a href="<?= $add_project_url?>" style=" color:white; text-decoration:none;">Add Project</a></button>
        </div>
    </div>

    <?php
    $testquery = "SELECT * FROM `project` WHERE `OWNER_ID`='$id'";
    $testresult = mysqli_query($con, $testquery);
    $test = mysqli_fetch_assoc($testresult);
    if($test){
        $query7 = "SELECT * FROM `project` WHERE `OWNER_ID`='$id'";
        $result7 = mysqli_query($con, $query7);
        while ($row7 = mysqli_fetch_assoc($result7)){
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
                <div class="position-absolute top-0 end-0">
                <?php
                $add_task_url = "add_task.php?id=".$id."&proid=".$row7["PROJECT_ID"];
                ?>
                <button style=" justify-content:flex-end; background-color: darkorchid; border:none; border-radius:10px; padding:5px 10px 5px 10px;"><a href="<?= $add_task_url?>" style=" color:white; text-decoration:none;">Add Task</a></button>
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
        }
    }else{
        ?>
        <h1 style=" margin:15% 6% 6% 6%; color:black;">You have no Projects Owned</h1>
        <?php
    }
    ?>
    <?php
    ?>

    <footer></footer>
    
</body>
</html>