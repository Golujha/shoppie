<?php include "../include/function.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php include "../include/header.php";?>

    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto mt-4">
                <div class="card shadow-lg">
                    <h4 class="fw-bold text-primary text-center"><u>LOGIN HERE</u></h4>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="">email/contact</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="">password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-success" name="login">
                            </div>
                            <div class="mb-0">
                                <a href="signup.php" class="text-dark p-0 m-0">create an account</a>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST['login'])){
                            $username = $_POST['username'];
                            $password = md5($_POST['password']);


                            $query = mysqli_query($connect,"select * from users where (email='$username' OR contact='$username') AND password='$password'");
                            $count = mysqli_num_rows($query);
                            if($count > 0){
                                $_SESSION['user'] = $username;
                                redirect("../index.php");
                            }
                            else{
                                echo "<script>alert('login details not found try again')</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>