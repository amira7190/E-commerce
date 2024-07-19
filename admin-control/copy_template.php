<?php


    /*
    ===================
    ==Template Page
 
              <h1 class = "text-center  "> Add New Category</h1>
              <div class="container">
                     <form class="form-horizontal" action ="?do=Insert" method ="POST">
                               zled -->
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
                           
                                          tegory" class="btn btn-primary btn-lg" />
                                         </div>
                                   </div>
                                        <!-- end submit filed -->
                 </div>

              </form>

        </div> 
        **************************************
        *******************
        **********************
        *********************
        echo "<h1 class = 'text-center'> update Member</h1>";
                    echo "<div class = 'container'> ";
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                         //Get variable from the form
                        $id       = $_POST['catid'];
                        $name     = $_POST['name'];
                        $desc     = $_POST['description'];
                        $order    = $_POST['ordering'];
                        $visible  = $_POST['visibility'];
                        $comment  = $_POST['commenting'];
                        $ads      = $_POST['ads'];
                    
                              //UPdate  the database with this info//
 
                               $stmt = $con->prepare("UPDATE 
                                                          categories
                                                      SET  
                                                           Name = ?, 
                                                           Description = ?, 
                                                           Ordering_View = ?, 
                                                           Visibility = ?,
                                                           Allow_Comment = ? ,
                                                           Allow_Ads = ?
                                                       WHERE 
                                                           ID = ? ");
                               $stmt->execute(array($name , $desc , $order ,  $visible , $comment , $ads , $id));

                               //Echo success message
                                $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';
                                redirectHome ($theMsg , 'back');

                        

                     }else{
                              $theMsg= '<div class = "alert alert-danger">you cant Browse this page directly</div>';
                              redirectHome($theMsg);
                          } 
               echo "</div>";


?>




