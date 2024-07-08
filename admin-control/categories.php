<?php
 /*
 =====================

 === Category Page

 =====================
 */
ob_start();

session_start();

$pageTitle = 'Categories';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){
        
               echo 'welcome';
          }
          elseif($do == 'add'){ ?>
              
              <h1 class = "text-center  "> Add New Category</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Insert" method ="POST">
                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10">
                                         <input type="text" name="name" class="form-control" autocomplete="off"  required = "required" placeholder="Name Of The Category"/>
                                      </div>
                                 </div>
                                      <!-- end name filed -->


                                     <!-- Start Description filed -->
                                 <div class="form-group form-group-lg">
                                     <label class = "col-sm-2 control-label"> Description</label>
                                     <div class="col-sm-10">
                                          <input type="text" name="description" class="form-control"  placeholder = "Describe the category"/>
                                     </div>
                                  </div>
                                        <!-- end Description filed -->


                                        <!-- Start ordering filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> Ordering_View</label>
                                      <div class="col-sm-10">
                                         <input type="text" name="ordering"  class="form-control"   placeholder = "Number to arrange the category"/>
                                      </div>
                                  </div>
                                       <!-- end ordering filed -->


                                        <!-- Start visibility filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label">  visible</label>
                                      <div class="col-sm-10 col-md-6">
                                          <div>
                                               <input id="vis-yes" type="radio" name="visibility" value="0" checked/>
                                               <label for="vis-yes">Yes</label>

                                          </div>
                                          <div>
                                               <input id="vis-no" type="radio" name="visibility" value="1" />
                                               <label for="vis-no">No</label>

                                          </div>
                                      </div>
                                  </div>
                                        <!-- end visibility filed -->

                                        <!-- Start commenting filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label">  Allow Commenting</label>
                                      <div class="col-sm-10 col-md-6">
                                          <div>
                                               <input id="com-yes" type="radio" name="commenting" value="0" checked/>
                                               <label for="com-yes">Yes</label>

                                          </div>
                                          <div>
                                               <input id="com-no" type="radio" name="commenting" value="1" />
                                               <label for="com-no">No</label>

                                          </div>
                                      </div>
                                  </div>
                                        <!-- end commenting filed -->
                                    
                                    <!-- Start ads filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label">  Allow Ads</label>
                                      <div class="col-sm-10 col-md-6">
                                          <div>
                                               <input id="ads-yes" type="radio" name="ads" value="0" checked/>
                                               <label for="ads-yes">Yes</label>

                                          </div>
                                          <div>
                                               <input id="ads-no" type="radio" name="ads" value="1" />
                                               <label for="ads-no">No</label>

                                          </div>
                                      </div>
                                  </div>
                                        <!-- end ads filed -->
    
    


                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Add Category" class="btn btn-primary btn-lg" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 </div>

              </form>

        </div> 


          <?php
         }elseif($do == 'Insert'){

            //Insert category Page//
        
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){

                              echo "<h1 class = 'text-center'> insert category</h1>";
                              echo "<div class = 'container'> ";
                                  //Get variable from the form
                                  $name   = $_POST['name'];
                                  $desc  = $_POST['description'];
                                  $order  = $_POST['ordering'];
                                  $visible = $_POST['visbilityil'];
                                  $comment = $_POST['commenting'];
                                  $ads = $_POST['ads'];

                                        //check if categories exist in database

                                        $check= checkItem("Name" , "categories", $name);
                                        if($check == 1){

                                             $theMsg ="<div class = 'alert alert-danger'>Sorry This category Is Exist</div>";
                                             redirectHome($theMsg , 'back');
                                        }else{
                                                    //Insert category info in database

                                                         $stmt = $con->prepare("INSERT INTO 
                                                                                 categories(Name, Description, Ordering_View, Visibility ,Allow_Comment, Allow_Ads)
                                                                                 VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)");
                                                         $stmt->execute(array(
                                                                    'zname'    => $name,
                                                                    'zdesc'    => $desc,
                                                                    'zorder'   => $order,
                                                                    'zvisible' => $visible,
                                                                    'zcomment' => $comment,
                                                                    'zads'     => $ads
             

                                                          ));
                 
                                                          //Echo success messag
                                                                 $theMsg = "<div class = 'alert alert-success'>". $stmt->rowCount() . 'Inserted Updated </div>';
                                                                 redirectHome($theMsg , 'back');
                                             }
                                        

                              }else{
                                   echo '<div class ="container">';
                                        $theMsg = '<div class = "alert alert-danger">Sorry you cant Browse this page directly</div>';
                                        redirectHome($theMsg , 'back');
                                   echo '</div>';
                              } 
                               echo "</div>";


         }elseif($do == 'Edit'){


         }elseif($do == 'Update'){


         }elseif($do == 'Delete'){


         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>