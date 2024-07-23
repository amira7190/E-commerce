<?php
ob_start();

session_start();

$pageTitle = 'Items';

  if(isset($_SESSION['Username'])){
      
          include 'init.php';

          $do = isset($_GET['do'])  ?  $_GET['do'] : 'Manage';

          if($do == 'Manage'){
            echo 'welcome to items';

          }
          elseif($do == 'add'){ ?>
            <h1 class = "text-center  "> Add New Items</h1>
              <div class="container">
                    <form class="form-horizontal" action ="?do=Insert" method ="POST">
                                     
                                     <!-- Start name filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Name</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="name" 
                                              class="form-control" 
                                              required = "required" 
                                              placeholder="Name Of The Item"/>
                                      </div>
                                 </div>
                                      <!-- end name filed -->
                                      
                                       <!-- Start description filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Description</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="description" 
                                              class="form-control" 
                                              required = "required" 
                                              placeholder="Description Of The Item"/>
                                      </div>
                                 </div>
                                       <!-- end description filed -->

                                         <!-- Start Price filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label"> Price</label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="price" 
                                              class="form-control" 
                                              required = "required" 
                                              placeholder="Price Of The Item"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->
                                        <!-- Start Country filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">country </label>
                                     <div class="col-sm-10">
                                         <input 
                                              type="text" 
                                              name="price" 
                                              class="form-control" 
                                              required = "required" 
                                              placeholder="country of made"/>
                                      </div>
                                 </div>
                                       <!-- end price filed -->

                                       <!-- Start status filed -->
                                <div class="form-group form-group-lg">
                                    <label class = "col-sm-2 control-label">Status</label>
                                     <div class="col-sm-10">
                                         <select class = "form-control" name="status">
                                         <option value="0">...</option>
                                         <option value="1">NEW</option>
                                         <option value="2"> LIKE NEW</option>
                                         <option value="3">USED</option>
                                         <option value="4">VERY OLD</option>
                                         
                                         </select>
                                      </div>
                                 </div>
                                       <!-- end status filed -->


                                       



                    
                                        <!-- Start submit filed -->
                                   <div class="form-group form-group-lg">
                                        <div class=" col-sm-offset-2 col-sm-10">
                                               <input type="submit" value="Add Item" class="btn btn-primary btn-sm" />
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
          

         }elseif($do == 'Approve'){
          

         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>