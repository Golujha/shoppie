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
<body>
<?php include "include/header.php";?>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <h2 class="fw-bold mt-3 text-primary text-center"><u>Product</u></h2>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <a href="insert.php" class="btn btn-success fw-bold float-end text-light d-inline-block mt-2" style="font-size:22px;">INSERT</a>
            </div>
            <div class="col-12 mt-3 shadow-lg">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">ID</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Title</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Category</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Brand</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Price</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">image</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Discount_price</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Description</th>
                        <th class="text-center fw-bold bg-success text-light" style="font-size:20px;">Action</th>
                    </tr>
                    <?php
                    $calling = calling("products");
                    foreach ($calling as $value) {
                    ?>
                    <tr>
                        <td class="text-center fw-bold"><?= $value['id'];?></td>
                        <td class="text-center fw-bold"><?= $value['title'];?></td>
                        <td class="text-center fw-bold"><?= $value['category'];?></td>
                        <td class="text-center fw-bold"><?= $value['brand'];?></td>
                        <td class="text-center fw-bold"><?= $value['price'];?></td>
                        <td><img src="pimage/<?= $value['image'];?>" width="50px" height="50px" alt=""></td>
                        <td class="text-center fw-bold"><?= $value['discount_price'];?></td>
                        <td class="text-center fw-bold"><?= $value['description'];?></td>
                        <td>
                            <a href="?del=<?= $value['id'];?>" class="btn btn-danger text-center" style="margin-left:100px;"><i class="bi bi-trash3"></i>delete</a>
                            <a href="edit.php?id=<?= $value['id'];?>" class="btn btn-danger text-center" style="margin-left:100px;"><i class="bi bi-pencil-square"></i>Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php
if(isset($_GET['del'])){
    $id = $_GET['del'];

    delete("products", "id='$id'");
    echo "<script>window.open('indexold.php','_self')</script>";
}
?>