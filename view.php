<?php include "include/function.php";

if(!isset($_GET['id'])){
    redirect("index.php");
}
$id = $_GET['id'];
$callingrecord = calling("products JOIN category ON products.category=category.cat_id where id='$id'");
$row = $callingrecord[0];
?>
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
<div class="container mt-4">
    <div class="row">
        <div class="col-3">
            <?php include "include/side.php";?>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-4">
                    <img src="pimage/<?= $row['image'];?>" class="card-img-top" alt="">
                </div>
                <div class="col-8">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?= $row['title'];?></th>
                        </tr>
                        <tr>
                            <th>MRP.</th>
                            <td><del><?= $row['price'];?></del></td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td><?= $row['brand'];?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><?= $row['cat_title'];?></td>
                        </tr>
                        <tr>
                            <th>Offer price</th>
                            <td><h4>Rs. <?= $row['discount_price'];?></h4></td>
                        </tr>
                    </table>
                    <a href="view.php?p_id=<?= $row['id'];?>&id=<?= $_GET['id'];?>" class="btn btn-success fw-bold text-light mt-3" style="margin-left:160px;font-size:20px"><i class="bi bi-cart"></i>Add to cart</a>
                    <a href="" class="btn btn-primary mt-3" style="margin-left:60px;font-size:20px"><i class="bi bi-bag"></i>Buy now</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
if(isset($_GET['p_id'])){
    $p_id =$_GET['p_id'];
    $product = callingOne("products where id='$p_id'");

    //retrieve user data
    $log = $_SESSION['user'];
    $user = callingOne("users where email='$log' OR contact='$log'");

    if($product){
        //retrieve order
        $user_id = $user['user_id'];
        $order = callingOne("orders where ordered=0 AND user_id='$user_id'");
        $product_id = $product['id'];
        if($order){
            // retrieve orderitem
            $product_id = $product['id'];
            $orderitem = callingOne("order_item where user_id='$user_id' AND product_id='$product_id' AND ordered='0'");

            if($orderitem){
                $orderitem_id = $orderitem['orderitem_id'];
                $updateQuery = mysqli_query($connect,"update order_item SET qty=qty+1 where orderitem_id='$orderitem_id'");
                //retrieve to cart page
            }
            else{
                $insertData= [
                    'ordered' => 0,
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'order_id' => $order['id'],
                    'qty' => 1,
                ];
                // print_r($insertData);
                insertData("order_item",$insertData);
            }
        }
        else{
            $insertOrder = [
                'ordered' => 0,
                'user_id' => $user_id,
            ];
            insertData("orders",$insertOrder);

            $lastid = mysqli_insert_id($connect);
            $insertData= [
                'ordered' => 0,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'order_id' => $lastid,
                'qty' => 1,
            ];
            insertData("order_item",$insertData);
        }
    }
    redirect("cart.php");


}
?>