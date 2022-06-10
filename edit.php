<?php 
$connect = mysqli_connect("localhost","root","","shoppie");

$id = $_GET['id'];
$calling = mysqli_query($connect,"select * from products where id='$id'");
$row = mysqli_fetch_array($calling);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body class="bg-secondary">
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a href="" class="navbar-brand" style="font-size:25px;">Shoppie</a>
        <form action="" method="post" class="d-flex">
            <input type="search" class="form-control">
            <button class="btn btn-info">Search</button>
        </form>
    </div>
</nav>
    <div class="container">
        <div class="row">
        <div class="col-8"></div>
            <div class="col-4">
                <a href="index.php" class="btn btn-success fw-bold float-end text-light d-inline-block mt-4" style="font-size:22px;">INSERT</a>
            </div>
            <div class="col-5 mx-auto">
                <h2 class="fw-bold text-center"><u>FORM Edit</u></h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Title</label>
                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Category</label>
                        <input type="text" class="form-control" name="category"   value="<?php echo $row['category'];?>">                    
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Brand</label>
                        <input type="text" class="form-control" name="brand" value="<?php echo $row['brand'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Price</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Discount_price</label>
                        <input type="text" class="form-control" name="discount_price" value="<?php echo $row['discount_price'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold text-dark" style="font-size:20px;">Decription</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="save" class="btn btn-danger" style="margin-left:220px;font-size:20px;">
                    </div>
                </form>
                <?php
                if(isset($_POST['save'])){
                    $data = [
                        'title' => $_POST['title'],
                        'category' => $_POST['category'],
                        'brand' => $_POST['brand'],
                        'price' => $_POST['price'],
                        'discount_price' => $_POST['discount_price'],
                        'description' => $_POST['description'],

                        //get
                        $id = $_GET['id'],
                        
                    ];

                    $query = insertData("products",$data);

                    if($query){
                        echo "<script>window.open('indexold.php','_self')</script>";
                    }
                }
                ?>
            </div>
        </div>
    </nav>
    
</body>
</html>
