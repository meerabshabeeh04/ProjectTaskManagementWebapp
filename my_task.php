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
        $project_url = "my_projects.php?id=".$id;
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
                <a class="nav-link" href="<?= $project_url?>" style="font-size:25%; color: darkorchid;">My Projects</a>
            </li>
            <li class="nav-item" style="height:100px; width:10%;">
                <a class="nav-link active" href="#" style="font-size:25%; color: darkorchid;">My Taks</a>
            </li>
        </ul>
    </header>

    <div class="position-relative" style="margin:6% 6% 15% 6%;">
        <div class="position-absolute top-0 start-0">
            <h1 style="color:black; font-size:300%; font-weight:bolder;">My Tasks</h1>
        </div>
    </div>

    <?php
    $testquery = "SELECT `TASK_NO` FROM `user_task` WHERE `USER_ID`='$id'";
    $testresult = mysqli_fetch_assoc(mysqli_query($con, $testquery));
    if($testresult){
        $query7 = "SELECT `TASK_NO` FROM `user_task` WHERE `USER_ID`='$id'";
    $result7 = mysqli_query($con, $query7);
    while ($row7 = mysqli_fetch_assoc($result7)) {
        $task = $row7["TASK_NO"];
        $query8 = "SELECT * FROM `tasks` WHERE `TASK_NO`='$task'";
        $result8 = mysqli_fetch_assoc(mysqli_query($con, $query8));
        ?>
        <div style="margin: 0% 6% 6% 6%;">
            <div class="position-relative">
                <div class="position-absolute top-0 start-0">
                    <h3 style=" color:black;"><b><?= $result8["DESCRIPTION"]?></b></h3>
                </div>
                <div class="position-absolute top-0 end-0">

                    <?php
                    $viewprourl = "view_project.php?tskno=".$task;
                    ?>

                    <button style=" justify-content:flex-end; background-color: darkorchid; border:none; border-radius:10px; padding:5px 10px 5px 10px;"><a href="<?= $viewprourl?>" style=" color:white; text-decoration:none;">See Project</a></button>
                </div>
            </div>

        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        
        <p style=" color:black;"><b>Deadline :</b><?=" ".$result8["DEADLINE"]?></p>

        <?php
        if( $result8["STATUS"] == "Not Completed") {
            ?>
            <form method="post">
                <input type="submit" name="submit" value="Mark as Completed" style=" background-color: darkorchid; border:none; border-radius:10px; padding:5px 10px 5px 10px; color:white;" />
            </form>
            <?php
            if(isset($_POST["submit"])){
                $query10 = "UPDATE `tasks` SET `STATUS`='Completed' WHERE `TASK_NO`='$task'";
                $result10 = mysqli_query($con, $query10);
                header("Location: my_task.php?id=".$id);
            }
        }else{
            ?>
            <p><b>Task Completed</b></p>
            <?php
        }
        ?>
        </div>        
        <?php
    }
    
    

    }else{
        ?>
        <h1 style=" margin:15% 6% 6% 6%; color:black;">You have no Tasks Assigned</h1>
        <?php
        

    }

    ?>
    

    <footer></footer>
    
</body>
</html>