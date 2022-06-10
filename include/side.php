<div class="list-group">
<div class="list-group-item list-group-item-action action text-danger">Category</div>

<?php
$callingCat = calling("category");
foreach($callingCat as $cat){
    $id = $cat['cat_id'];
    $title = $cat['cat_title'];
    echo "<a href='index.php?cat=$id' class='list-group-item list-group-item-action'>$title</a>";
}
?>
 </div>