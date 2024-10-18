<?php
ob_start();
session_start();
$pageTitle = 'Homepage';

include 'init.php';
?>
<div class="container">
        <div class="row">
            <?php
            $allItems = getAllFrom('items' , 'Item_ID');
                foreach($allItems as $item){
                        echo'<div class="col-sm-6 col-md-3">'; 
                            echo'<div class="card item-box">';
                            echo'<span class="price-tag">$' .$item['Price'] . '</span>';
                                echo'<img class=img-fluid" src="avatar.png"  alt=""  />';
                                echo '<div class="caption">';
                                     echo'<h3><a href="items.php?itemid='.$item['Item_ID'] .'">' .$item['Name']. '</a></h3>';
                                     echo'<p>' .$item['Description']. '</p>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                }
            ?>
        </div>
    </div> 
<?
include $tpl .'footer.php';
ob_end_flush();
?>