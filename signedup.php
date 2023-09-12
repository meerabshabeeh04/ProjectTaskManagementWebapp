<?php
include("db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signed Up</title>
    <link href="css/index.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
      <?php
            $fname = $_GET["fname"];
            $lname = $_GET["lname"];
            $email = $_GET["email"];
            $password = $_GET["password"];
            $phno = $_GET["phno"];
            $gender = $_GET["gender"];
            $query2 ="INSERT INTO `user_`(`FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD_`, `PH_NO`, `GENDER`) VALUES ('$fname','$lname','$email','$password','$phno','$gender')";
            $result2 = mysqli_query($con, $query2);
            $query3 = "SELECT `USER_ID` FROM `user_` WHERE `FIRST_NAME`='$fname' AND `LAST_NAME`='$lname' AND `EMAIL`='$email' AND `PASSWORD_`='$password' AND `PH_NO`='$phno' AND `GENDER`='$gender'";
            $result3 = mysqli_query($con, $query3);
            $row2 = mysqli_fetch_assoc($result3);
            $id = $row2["USER_ID"];
        ?>

    <header>
        <i><b>Manage Your Projects here Efficiently</b></i>
    </header>

    <div class="page-body" style="background-image: url('images/ProjectManagement.jpg');">

        <hr style="margin:0;opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>

        <div class="container px-4 text-center">
            <div class="row gx-5">
                <div class="col border border-black border-5 rounded log-box">
                    <div class="p-3">

                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>

                        <div class="text-center">
                            <img src="images/tick.webp" class="rounded img-thumbnail" alt="image" style="width: 80px;height: 80px;">
                        </div>

                        <hr style="opacity:0;"/>

                        <h3>You have Successfully Signed Up!</h3>

                        <a href="index.php" style="color: darkorchid;">Login</a>
                    </div>
                </div>
            </div>
        </div>

        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="opacity:0;"/>
        <hr style="margin:0;opacity:0;"/>

    </div>
    
    <footer></footer>
</body>
</html>