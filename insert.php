<?php include "include/function.php";?>
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
<body class="bg-info">
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
                <a href="indexold.php" class="btn btn-success fw-bold float-end text-light d-inline-block mt-2" style="font-size:22px;">INSERT</a>
            </div>
            <div class="col-5 mx-auto shadow-lg">
                <H2 class="fw-bold text-center"><u>FORM insert</u></H2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Category</label>
                        <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        <?php
                        $callingCat = calling("category");
                        foreach($callingCat as $cat){
                            $id = $cat['cat_id'];
                            $title = $cat['cat_title'];
                            echo "<option value='$id'>$title</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Brand</label>
                        <input type="text" class="form-control" name="brand">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Price</label>
                        <input type="text" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Discount_price</label>
                        <input type="text" class="form-control" name="discount_price">
                    </div>
                    <div class="mb-3">
                        <label for="" class="fw-bold" style="font-size:20px;">Decription</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="save" class="btn btn-danger" style="margin-left:220px;font-size:20px;">
                    </div>
                </form>
                <?php
                if(isset($_POST['save'])){
                    // image work 
                    $image = $_FILES['image']['name'];
                    $temp_image = $_FILES['image']['tmp_name'];
                    move_uploaded_file($temp_image,"pimage/$image");
                    $data = [
                        'title' => $_POST['title'],
                        'category' => $_POST['category'],
                        'brand' => $_POST['brand'],
                        'price' => $_POST['price'],
                        'discount_price' => $_POST['discount_price'],
                        'description' => $_POST['description'],
                        'image' => $image,
                        
                    ];

                    $query = insertData("products",$data);

                    
                    if($query){
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                }
                ?>
            </div>
        </div>
    </nav>
    
</body>
</html>
