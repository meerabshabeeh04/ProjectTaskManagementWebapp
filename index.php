<?php
include("db_con.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="css/index.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
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

                        <h1 style="font-size: 80px;color: black;font-family: 'Times New Roman', Times, serif;text-decoration: underline;font-weight: bolder;">Login Here</h1>

                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>
                        <hr style="opacity:0;"/>

                        <form method="post">
                            <input type="email" name="email" placeholder="Enter Email" style="background-color:transparent;height:50px;width:300px;padding:0px 5px 0px 5px;border-color:black;"/>
                            <hr style="opacity:0;"/>
                            <input type="password" name="password" placeholder="Enter Password" style="background-color:transparent;height:50px;width:300px;padding:0px 5px 0px 5px;border-color:black;"/>
                            <hr style="opacity:0;"/>
                            <input type="submit" name="submit" style="width: 250px; background-color: darkorchid; font-size:25px; color:black; border-radius:10px; padding:5px;"/>
                            <hr style="opacity:0;"/>
                            <p>Don't have an account?<a href="signup.php" style="color: darkorchid;">Sign Up</a></p>
                        </form>

                        <?php
                        if(isset($_POST["submit"])){
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $query1="SELECT * FROM `user_` WHERE `EMAIL`='$email'";
                            $result1 = mysqli_query($con,$query1);
                            $row1 = mysqli_fetch_assoc($result1);
                            if($row1["PASSWORD_"]===$password){
                                $id = $row1["USER_ID"];
                                $url = "dashboard.php?id=".$id;
                                header("Location:".$url);
                            }else{
                                ?>
                                <div class="alert alert-danger" role="alert">
                                Enter Correct Email/Password
                                </div>
                                <?php
                            }
                        }
                        ?>

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