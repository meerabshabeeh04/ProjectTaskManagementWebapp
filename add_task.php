<?php
include("db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link href="css/index.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <header></header>

    <?php
        $id = $_GET["id"];
        $proid = $_GET["proid"];
        if(isset($_POST["submit"])){
            $description = $_POST["desc"];
            $deadline = $_POST["deadline"];
            $user = $_POST["user"];
            $query9 ="INSERT INTO `tasks`(`PROJECT_ID`, `DESCRIPTION`, `DEADLINE`, `STATUS`) VALUES ('$proid','$description','$deadline','Not Completed')";
            $result9 = mysqli_query($con, $query9);
            $query12 = "SELECT `TASK_NO` FROM `tasks` WHERE `PROJECT_ID`='$proid' AND `DESCRIPTION`='$description' AND `DEADLINE`='$deadline' AND `STATUS`='Not Completed'";
            $result12 = mysqli_fetch_assoc(mysqli_query($con, $query12));
            $task = $result12["TASK_NO"];
            $query13 = "INSERT INTO `user_task`(`TASK_NO`, `USER_ID`) VALUES ('$task','$user')";
            $result13 = mysqli_query($con, $query13);
            ?>
            <div class="text-center" style=" margin-top:2%;">
                <img src="images/tick.webp" class="rounded img-thumbnail" alt="image" style="width: 80px;height: 80px;">
            </div>
            <hr style="opacity:0;"/>
            <h3 style=" text-align:center; margin-bottom:0%;">Task Successfully Assigned!</h3>
            <?php
        }
        ?>
        
        <hr style="margin:0;opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>

        <div class="container px-4 text-center">
            <div class="row gx-5">
                <div class="col border border-black border-5 rounded log-box">
                    <div class="p-3">

                        <h1 style="font-size: 80px;color: black;font-family: 'Times New Roman', Times, serif;text-decoration: underline;font-weight: bolder;">Add a New Task</h1>

                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>

                        <form method="post">
                            <input type="text" name="desc" placeholder="Enter Description" style="background-color:transparent;height:150px;width:300px;padding:0px 5px 0px 5px;border-color:black; margin:5px;" required/>
                            <hr style="opacity:0;"/>
                            <input type="date" name="deadline" placeholder="Enter Deadline" style="background-color:transparent;height:50px;width:300px;padding:0px 5px 0px 5px;border-color:black; margin:5px;" required/>
                            <hr style="opacity:0;"/>
                            <select name="user" required>
                                <option value="">Select User to Assign this Task</option>

                                <?php
                                $query11 = "SELECT * FROM `user_`";
                                $result11 = mysqli_query($con, $query11);
                                while($row11 = mysqli_fetch_assoc($result11)){
                                    ?>
                                    <option value="<?= $row11["USER_ID"]?>"><?= $row11["FIRST_NAME"]." ".$row11["LAST_NAME"]?></option>
                                    <?php
                                }
                                ?>

                            </select>
                            <hr style="opacity:0;"/>
                            <input type="submit" name="submit" style="width: 250px; background-color: darkorchid; font-size:25px; color:black; border-radius:10px; padding:5px;"/>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="margin:0;opacity:0;"/>

    
    <footer></footer>
    
</body>
</html>