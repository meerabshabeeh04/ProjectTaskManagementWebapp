<?php
include("db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        $project_url = "my_projects.php?id=".$id;
        $task_url = "my_task.php?id=".$id;
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
                <a class="nav-link active" aria-current="page" href="#" style="font-size:25%; color: darkorchid;">Notifications</a>
            </li>
            <li class="nav-item" style="height:100px; width:10%;">
                <a class="nav-link" href="<?= $project_url?>" style="font-size:25%; color: darkorchid;">My Projects</a>
            </li>
            <li class="nav-item" style="height:100px; width:10%;">
                <a class="nav-link" href="<?= $task_url?>" style="font-size:25%; color: darkorchid;">My Taks</a>
            </li>
        </ul>
    </header>

    <div style="margin:6% 6% 0 6%;">
        <h1 style="color:black; font-size:300%; font-weight:bolder;">Notifications</h1>
    </div>

    <div>
        <ul class="list-group" style="margin:2% 5% 2% 5%">

        <?php
        $query2 = "SELECT `TASK_NO` FROM `user_task` WHERE `USER_ID`='$id'";
        $result2 = mysqli_query($con, $query2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $task = $row2["TASK_NO"];
            $query3 = "SELECT `FIRST_NAME`, `LAST_NAME` FROM `user_` WHERE `USER_ID`=(SELECT `OWNER_ID` FROM `project` WHERE `PROJECT_ID`=(SELECT `PROJECT_ID` FROM `tasks` WHERE `TASK_NO`='$task'))";
            $result3 = mysqli_fetch_assoc(mysqli_query($con, $query3));
            $fname = $result3["FIRST_NAME"];
            $lname = $result3["LAST_NAME"];
            ?>

            <li class="list-group-item d-flex justify-content-between align-items-center" style="margin:2%; background-color: darkorchid;">
                <button style="border:none; text-decoration:none; padding:0%; background-color: darkorchid;">
                    <a href="<?= $task_url?>" style="background-color: darkorchid; text-decoration:none;padding:0%; color:white"><?=$fname." ".$lname." "?>assigned you a Task</a>
                </button>
            </li>

        <?php
        }
        $query4 = "SELECT `TASK_NO`,`STATUS` FROM `tasks` WHERE `PROJECT_ID`=(SELECT `PROJECT_ID` FROM `project` WHERE `OWNER_ID`='$id')";
        $result4 = mysqli_query($con, $query4);
        while ($row4 = mysqli_fetch_assoc($result4)) {
            if ($row4["STATUS"] == "Completed") {
                $taskno = $row4["TASK_NO"];
                $query5 = "SELECT `FIRST_NAME`, `LAST_NAME` FROM `user_` WHERE `USER_ID`=(SELECT `USER_ID` FROM `user_task` WHERE `TASK_NO`='$taskno')";
                $result5 = mysqli_fetch_assoc(mysqli_query($con, $query5));
                $fname = $result5["FIRST_NAME"];
                $lname = $result5["LAST_NAME"];
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="margin:2%; background-color: darkorchid;">
                    <button style="border:none; text-decoration:none; padding:0%; background-color: darkorchid;">
                        <?php
                        $url ="my_projects.php?id=".$id;
                        ?>
                        <a href="<?= $url?>" style="background-color: darkorchid; text-decoration:none;padding:0%; color:white"><?=$fname." ".$lname." "?>completed her task of your project</a>
                    </button>
                </li>
                <?php
            }
        }

        $query5 = "SELECT `TASK_NO`  FROM `user_task` WHERE `USER_ID`='$id'";
        $result5 = mysqli_query($con, $query5);
        while ($row5 = mysqli_fetch_assoc($result5)) {
            $taskno = $row5["TASK_NO"];
            $query6 = "SELECT DATEDIFF(`DEADLINE`, CURDATE()) AS `DIFF` FROM `tasks` WHERE `TASK_NO`='$taskno'";
            $result6 = mysqli_fetch_assoc(mysqli_query($con, $query6));
            $diff = $result6["DIFF"];
            if($diff<50){
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="margin:2%; background-color: darkorchid;">
                    <button style="border:none; text-decoration:none; padding:0%; background-color: darkorchid;">
                        <?php
                        $url ="my_task.php?id=".$taskno;
                        ?>
                        <a href="<?= $url?>" style="background-color: darkorchid; text-decoration:none;padding:0%; color:white">A tasks deadline is approaching!</a>
                    </button>
                </li>
                <?php
            }
        }
        ?>
        
    </ul>
    </div>

    <footer></footer>
    
</body>
</html>