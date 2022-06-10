<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a href="" class="navbar-brand" style="font-size:25px;"><u>Shoppie</u></a>

        <form action="" class="d-flex mx-auto">
            <input type="search" name="search" class="form-control" size="50" autofocus>
            <input type="submit" name="Find" class="btn btn-danger">
            <span class="input-group-text"><i class="bi bi-search fw-bold text-dark" style="width:50px;"></i></span>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="indexold.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b>Home</b></a></li>

            <?php if(isset($_SESSION['user'])){ ?>
            <li class="nav-item"><a href="auth/logout.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b>Logout</b></a></li>
            <li class="nav-item"><a href="auth/login.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b>
                <?php
                    $log = $_SESSION['user'];
                    $data = calling("users where email='$log' OR contact='$log'");
                    echo $fullname = $data[0]['fullname'];
                ?>
            </b></a></li>
            <li class="nav-item"><a href="insert.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b>Insert</b></a></li>
                
                <?php } else { ?>
            <li class="nav-item"><a href="auth/login.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b><u>Login</u></b></a></li>
            <li class="nav-item"><a href="auth/signup.php" class="nav-link text-info text-light" style="margin-right:30px;font-size:18px;"><b><u>Signup</u></b></a></li>

            <?php } ?>
            <li class="nav-item"><a href="cart.php" class="btn btn-danger btn-sm mt-1 position-relative" style="margin-right:30px;font-size:18px;">
                <i class="bi bi-cart"></i>cart
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2

                    </span>
                </a>
            </li>
        </ul>

    </div>
</nav>
</body>
</html>