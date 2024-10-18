<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
$pageTitle = 'Create New Item';
include 'init.php';
if(isset($_SESSION['user'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $formErrors  =  array();

        $name      = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $desc      = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $price     = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
        $country   = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
        $status    = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
        $category  = filter_var($_POST['category'], FILTER_SANITIZE_STRING);

    

        


    if(strlen($name) < 4){
        $formErrors[] = ' item title must be at least 4 character';
    }
    if(strlen($desc) < 10){
        $formErrors[] = 'item description must be at least 10 character';
    }
    if(strlen($country) < 2){
        $formErrors[] = ' item country must be at least 2 character';
    }
    if(empty($price)){
        $formErrors[] = ' item price must be not empty';
    }
    if(empty($status)){
        $formErrors[] = ' item status must be not empty';
    }
    if(empty($category)){
        $formErrors[] = ' item category must be not empty';
    }
     
 //check if theres no error proceed the update operation 
 if (empty ($formErrors)){

    $stmt = $con->prepare("INSERT INTO 
                            items(Name, Description, Price, Add_Date, Country_Made  ,Status ,Cat_ID, Member_ID )
                            VALUES(:zname, :zdesc, :zprice , now(), :zcountry  ,:zstatus ,:zcat, :zmember)");
    $stmt->execute(array(
               'zname'      => $name,
               'zdesc'      => $desc,
               'zprice'     => $price,
               'zcountry'   => $country,
               'zstatus'    => $status,
               'zcat'		=> $category,
               'zmember'	=> $_SESSION['uid']
       


     ));

     //Echo success messag
            if($stmt->rowcount() > 0){
                $succesMsg = 'Item Has Been Added';
            }

  }
} 
?>
<h1 class="text-center"><?php echo $pageTitle ?></h1>
<div class="create-ad block">
    <div class="container">
        <div class="card">
            <div class="card-header"> <?php echo $pageTitle ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                    <form class="form-horizontal" action =" <?php  echo $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <input type="hidden" name="itemid" value="<?php echo $itemid ?>"/>

                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label"> Name</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              pattern=".{4,}"
                                              type="text" 
                                              name="name" 
                                              class="form-control live-name" 
                                              placeholder="Name Of The Item"
                                              required
                                              />
                                      </div>
                                 </div>
                                      <!-- end name filed -->
                                      
                                       <!-- Start description filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label"> Description</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              pattern=".{10,}"
                                              type="text" 
                                              name="description" 
                                              class="form-control live-desc" 
                                              placeholder="Description Of The Item"
                                              required
                                              />
                                      </div>
                                 </div>
                                       <!-- end description filed -->

                                         <!-- Start Price filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label"> Price</label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="price" 
                                              class="form-control live-price" 
                                              placeholder="Price Of The Item"
                                              />
                                      </div>
                                 </div>
                                       <!-- end price filed -->
                                        <!-- Start Country filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label">country </label>
                                     <div class="col-sm-10 col-md-9">
                                         <input 
                                              type="text" 
                                              name="country" 
                                              class="form-control" 
                                              placeholder="country of made"
                                              />
                                      </div>
                                 </div>
                                       <!-- end price filed -->

                                       <!-- Start status filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label">Status</label>
                                     <div class="col-sm-10 col-md-9">
                                         <select class = "form-control" name="status">
                                         <option value="0" >...</option>
                                         <option value="1" >NEW</option>
                                         <option value="2"  > LIKE NEW</option>
                                         <option value="3"  >USED</option>
                                         <option value="4" >VERY OLD</option>
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end status filed -->
                                        <!-- Start category filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-3 control-label">category</label>
                                     <div class="col-sm-10 col-md-9">
                                         <select class = "form-control" name="category">
                                         <?php

                                          $cats= getAllFrom('*','categories','' , '','ID');
                                          
                                          foreach($cats as $cat){
                                            echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                             
                                          }

                                         ?>
                                         
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end category filed -->
                                        
                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-3 col-sm-10">
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
                <!-- start looping through errors-->
                <?php
                if( ! empty($formErrors)){
                   foreach($formErrors as $error){
                      echo'<div class ="alert alert-danger">' . $error . '</div>';
                   }
                }
                if(isset($succesMsg)){
                    echo '<div class="alert alert-success">' .$succesMsg. '</div>';
               }
                ?>
                <!-- end looping through errors-->

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