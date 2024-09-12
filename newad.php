<?php
session_start();
$pageTitle = 'Create New Ad';
include 'init.php';
if(isset($_SESSION['user'])){
   
?>
<h1 class="text-center">Create New Ad</h1>
<div class="create-ad block">
    <div class="container">
        <div class="card">
            <div class="card-header">Create New Ad</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                    <form class="form-horizontal" action =" <?php  echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <input type="hidden" name="itemid" value="<?php echo $itemid ?>"/>

                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control live-name" 
                                              placeholder="Name Of The Item"
                                              value="<?php echo $item['Name'] ?>"/>
                                      </div>
                                 </div>
                                      <!-- end name filed -->
                                      
                                       <!-- Start description filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Description</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="description" 
                                              class="form-control live-desc" 
                                              placeholder="Description Of The Item"
                                              value="<?php echo $item['Description'] ?>"/>
                                      </div>
                                 </div>
                                       <!-- end description filed -->

                                         <!-- Start Price filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Price</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="price" 
                                              class="form-control live-price" 
                                              placeholder="Price Of The Item"
                                              value="<?php echo $item['Price'] ?>"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->
                                        <!-- Start Country filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">country </label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="country" 
                                              class="form-control" 
     
                                              placeholder="country of made"
                                              value="<?php echo $item['Country_Made'] ?>"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->

                                       <!-- Start status filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Status</label>
                                     <div class="col-sm-10 col-md-9">
                                         <select class = "form-control" name="status">
                                         
                                         <option value="1"<?php if($item['Status'] == 1 ){ echo 'selected';} ?>   >NEW</option>
                                         <option value="2" <?php if($item['Status'] == 2 ){ echo 'selected';} ?> > LIKE NEW</option>
                                         <option value="3" <?php if($item['Status'] == 3 ){ echo 'selected';} ?> >USED</option>
                                         <option value="4" <?php if($item['Status'] == 4 ){ echo 'selected';} ?> >VERY OLD</option>
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end status filed -->
                                        <!-- Start category filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">category</label>
                                     <div class="col-sm-10 col-md-9">
                                         <select class = "form-control" name="category">
                                         <?php

                                          $stmt2= $con->prepare("SELECT * FROM categories");
                                          $stmt2->execute();
                                          $cats= $stmt2->fetchAll();
                                          foreach($cats as $cat){
                                             echo "<option value='" .$cat['ID']."'";
                                             if($item['Cat_ID'] == $cat['ID'] ){ echo 'selected';}
                                             echo">" .$cat['Name']."</option> ";
                                          }

                                         ?>
                                         
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end category filed -->
                                        
                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Save Item" class="btn btn-primary btn-sm" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 

              </form> 
                    </div>
                    <div class="col-md-4">
                        <div class="card item-box live-preview">
                                <span class="price-tag">$0</span>
                                <img class="img-fluid" src="avatar.png"  alt=""  >
                                <div class="caption">
                                     <h3> title</h3>
                                     <p> description</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else {
    header('Location: login.php');
    exit();
}
include $tpl .'footer.php';

?>