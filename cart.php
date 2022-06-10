<?php include "include/function.php";

if(!isset($_SESSION['user'])){
    redirect("auth/login.php");
}
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
        <div class="col-8">
           <div class="card shadow-lg border-0">
               <?php
               $log = $_SESSION['user'];
               //variable initilization
               $total_amount = 0;
               $total_discount = 0;
               $product_discount = 0;
               $total_tax = 0;
               $payable_amount = 0;
               $coupon_amount = 0;

               $callinguser = callingOne("users where email='$log' OR contact='$log'");
               $user_id = $callinguser['user_id'];

               $callingOrder = callingOne("orders LEFT JOIN coupons ON orders.coupon_id=coupons.coupon_id  where user_id='$user_id' and ordered='0'");
               $order_id = $callingOrder['id'];
               $callingOrderitem = calling("order_item JOIN products ON order_item.product_id = products.id where user_id='$user_id' AND 
               order_id='$order_id' AND ordered='0'");
               foreach ($callingOrderitem as $value) {
                   // total amount
                   $total_amount += $value['price'] * $value['qty'];
                   $total_discount += $value['discount_price'] * $value['qty'];
                   $product_discount += $total_amount - $total_discount;
                   $total_tax = 0.18*$total_discount;
                   $payable_amount = $total_discount + $total_tax;

                   $coupon_amount = $callingOrder['coupon_amount'];

                   if($coupon_amount > 0){
                       $payable_amount -= $coupon_amount;
                   }
                ?>

                <div class="row">
                    <div class="col-3">
                        <img src="pimage/<?= $value['image'];?>" alt="" class="w-100">
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                            <h5><?= $value['title'];?></h5>
                            <h4>Rs. <?= $value['discount_price'] * $value['qty'];?>/- <del><?= $value['price'] * $value['qty'];?>/-</del></h4>
                            <a href="cart.php?p_id=<?= $value['id'];?>" class="btn btn-danger">-</a>
                            <span class="lead px-2"><?= $value['qty'];?></span>
                            <a href="view.php?p_id=<?= $value['id'];?>&id=<?= $value['id'];?>" class="btn btn-success">+</a>

                            <a href="cart.php?remove_id=<?= $value['id'];?>" class="btn btn-dark float-end"><i class="bi bi-trash"></i>Remove</a>
                        </div>
                    </div>
                </div>
                 <?php } ?>
           </div>
        </div>
        <div class="col-4">
            <ul class="list-group">
                <li class="list-group-item">Total Amount : <span class="float-end">₹<?= $total_amount;?></span></li>
                <li class="list-group-item bg-success text-white">Total Discount : <span class="float-end">₹<?= $product_discount;?></span></li>
                <li class="list-group-item">Total Final Amount : <span class="float-end">₹<?= $total_amount- $product_discount;?></span></li>
                <li class="list-group-item ">Total Tax : <span class="float-end">₹<?= $total_tax;?></span></li>

                <?php if($callingOrder['coupon_id'] != 0){?>
                    <li class="list-group-item bg-warning text-light">Coupon Discount : <span class="float-end">₹<?= $coupon_amount;?>/-</span></li>
                <?php } ?>

                <li class="list-group-item ">Payable Amount : <span class="float-end">₹<?= $payable_amount;?>/-</span></li>
            </ul>
            <div class="row g-2 mt-2">
                <div class="col"><a href="" class="btn btn-danger w-100">Conting shopping</a></div>
                <div class="col"><a href="" class="btn btn-success w-100">place Order</a></div>
            </div>
            <!-- coupon work-->
            <?php
            if($callingOrder['coupon_id'] == 0){ ?>
            
            <div class="row mt-3">
                <div class="card">
                    <div class="card-body">
                        <form action="cart.php" method="post" class="d-flex">
                            <input type="text" placeholder="enter code" class="form-control" name="coupon_code">
                            <input type="submit" value="Apply" class="btn btn-success" name="apply_coupon">
                        </form>
                        <?php
                        if(isset($_POST['apply_coupon'])){
                            $code = $_POST['coupon_code'];

                            $callingcoupon = mysqli_query($connect,"select * from coupons where coupon_code='$code'");
                            $count = mysqli_num_rows($callingcoupon);
                            $row = mysqli_fetch_row($callingcoupon);

                            if($count > 0){
                                $coupon_id = $row[0];
                                $updateOrder = mysqli_query($connect,"update orders SET coupon_id='$coupon_id' WHERE user_id='$user_id'
                                 AND ordered='0'");
                                redirect("cart.php");
                            }
                            else{
                                echo "<script>alert('invalid coupon code')</script>";
                            }

                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- coupon work-->
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

                if($orderitem['qty'] > 1){
                $updateQuery = mysqli_query($connect,"update order_item SET qty=qty-1 where orderitem_id='$orderitem_id'");
                }
                else{
                    removecart($product_id);
                }
            }
           
        }
    }
    redirect("cart.php");
}

function removecart($id){
    global $connect;
    $product = callingOne("products where id='$id'");

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
            $orderitem = callingOne("order_item where user_id='$user_id' AND product_id='$product_id'");

            if($orderitem){
                $orderitem_id = $orderitem['orderitem_id'];
                $removeQuery = mysqli_query($connect,"delete from order_item where orderitem_id = '$orderitem_id'");
            }
        }
    }
}

if(isset($_GET['remove_id'])){
    $id = $_GET['remove_id'];
    removecart($id);
    redirect("cart.php");
}
?>