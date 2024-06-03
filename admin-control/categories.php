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
          elseif($do == 'Add'){ ?>
              <h1 class = "text-center  "> Add New Category</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Insert" method ="POST">
                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10">
                                         <input type="text" name="Name" class="form-control" autocomplete="off"  required = "required" placeholder = "Name Of The Category"/>
                                      </div>
                                 </div>
                                      <!-- end name filed -->


                                     <!-- Start description filed -->
                                 <div class="form-group form-group-lg">
                                     <label class = "col-sm-2 control-label"> Description</label>
                                     <div class="col-sm-10">
                                          <input type="text" name="description" class="form-control" placeholder = "Describe The Category"/>
                                     </div>
                                  </div>
                                        <!-- end description filed -->


                                        <!-- Start ordering filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label">Ordering</label>
                                      <div class="col-sm-10">
                                         <input type="text" name="ordering"  class="form-control" placeholder = "number to arrange the category"/>
                                      </div>
                                  </div>
                                       <!-- end ordering filed -->


                                        <!-- Start visibility filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> visible</label>
                                      <div class="col-sm-10 col-md-6">
                                             <div>
                                                <input id="vis-yes" type="radio" name="visibility" value = "0" chacked>
                                                <label for="vis-yes">Yes</label>  
                                             </div>
                                             <div>
                                                <input id="vis-no" type="radio" name="visibility" value = "1" >
                                                <label for="vis-no">No</label>  
                                             </div>
                                      </div>
                                  </div>
                                        <!-- end visibility filed -->
                                        <!-- Start commenting filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> Allow Commenting</label>
                                      <div class="col-sm-10 col-md-6">
                                             <div>
                                                <input id="com-yes" type="radio" name="commenting" value = "0" chacked>
                                                <label for="com-yes">Yes</label>  
                                             </div>
                                             <div>
                                                <input id="com-no" type="radio" name="commenting" value = "1" >
                                                <label for="com-no">No</label>  
                                             </div>
                                      </div>
                                  </div>
                                        <!-- end commenting filed -->
                                        <!-- Start allow ads filed -->
                                  <div class="form-group form-group-lg">
                                      <label class = "col-sm-2 control-label"> Allow Ads</label>
                                      <div class="col-sm-10 col-md-6">
                                             <div>
                                                <input id="ads-yes" type="radio" name="ads" value = "0" chacked>
                                                <label for="ads-yes">Yes</label>  
                                             </div>
                                             <div>
                                                <input id="ads-no" type="radio" name="ads" value = "1" >
                                                <label for="ads-no">No</label>  
                                             </div>
                                      </div>
                                  </div>
                                        <!-- end allow ads filed -->



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