         
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

               $sort = 'ASC';
               $sort_array = array('ASC','DESC');
               if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
                    $sort=$_GET['sort'];
               };

               $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY Ordering_View $sort");
               $stmt2->execute();
               $cats = $stmt2->fetchAll(); ?>
               <h1 class="text-center">Manage Categories</h1>
               <div class="container categories">
                    <div class="card">
                         <div class="card-header">Manage categories
                              <div class="option pull-right">
                                   ordering:
                                   <a class="<?php if($sort == 'ASC'){
                                        echo'active';
                                   } ?>"  href="?sort=ASC">Asc</a>
                                   <a class="<?php if($sort == 'DESC'){
                                        echo'active';
                                   } ?>" href="?sort=DESC">Desc</a>
                                   view:
                                   <span class="active" data-view="full">Full</span>
                                   <span data-view="classic">Classic</span>

                              </div>
                         </div>
                         <div class="panel-body">
                              <?php
                                  foreach($cats as $cat){
                                   echo "<div class='cat'>";
                                        echo "<div class='hidden buttons'>";
                                            echo"<a href='categories.php?do=Edit&catid=" .$cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'>Edit</i></a>";
                                            echo"<a href='categories.php?do=Delete&catid=" .$cat['ID'] . "' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'>Delete</i></a>";                                       echo"</div>";
                                        echo "<h3>". $cat['Name'] . "</h3>";
                                        echo "<div class='full-view'>";
                                            echo "<p>" ; if($cat['Description'] == '') {echo 'This category has no description ';} else {echo $cat['Description'] ;} echo"</p>";
                                            if($cat['Visibility'] == 1) { echo '<span class="visibility">Hidden<span/>';}
                                            if($cat['Allow_Comment'] == 1) { echo '<span class="commenting">Comment Disabled<span/>';}
                                            if($cat['Allow_Ads'] == 1) { echo '<span class="advertises">Ads Disabled<span/>';}
                                        echo "</div>";    
                                   echo "</div>";
                                   echo "<hr>";





                                  }
                              ?>
                                      
                         </div>
                    </div>
                    <a class =" add-category btn btn-primary" href="categories.php?do=add"><i class="fa fa-plus"></i>Add New Category</a>
               </div>



          <?php
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
                                  $visible = $_POST['visibility'];
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
          //Edit Page
              // echo 'welcome to edit your id is' . $_GET['userid'];
                       
                         //check if Get Request catid Is Numeric & Get The Integer Value Of It
                         $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0 ;

                         //echo $userid;

                         //Select All Data Depend On Thid ID 
                        $stmt = $con->prepare("SELECT * FROM categories WHERE  ID = ? ");
                         
                        //Execute Query
                      $stmt->execute(array($catid));
                        //FetCH THe Data
                      $cat = $stmt->fetch();
                      //The Row Count
                     $count=$stmt->rowCount();
                      //If There Such Id Show The Form
                     if($count > 0){ ?>

                         <h1 class = "text-center  "> Edit Category</h1>
                         <div class="container">
                              <form class="form-horizontal" action ="?do=update" method ="POST">
                              <input type="hidden" name="catid" value="<?php echo $catid ?>"/>
                                                 <!-- Start name filed -->
                                        <div class="form-group form-group-lg">
                                             <label class = "col-sm-2 control-label"> Name</label>
                                             <div class="col-sm-10">
                                                  <input type="text" name="name" class="form-control" required = "required" placeholder="Name Of The Category" value="<?php echo $cat['Name'] ?>"/>
                                             </div>
                                        </div>
                                                   <!-- end name filed -->

                                                  <!-- Start Description filed -->
                                        <div class="form-group form-group-lg">
                                              <label class = "col-sm-2 control-label"> Description</label>
                                             <div class="col-sm-10">
                                                  <input type="text" name="description" class="form-control"  placeholder = "Describe the category" value="<?php echo $cat['Description'] ?>"/>
                                             </div>
                                        </div>
                                                   <!-- end Description filed -->


                                                   <!-- Start ordering filed -->
                                        <div class="form-group form-group-lg">
                                             <label class = "col-sm-2 control-label"> Ordering_View</label>
                                             <div class="col-sm-10">
                                                  <input type="text" name="ordering"  class="form-control"   placeholder = "Number to arrange the category" value="<?php echo $cat['Ordering'] ?>"/>
                                             </div>
                                        </div>
                                                     <!-- end ordering filed -->


                                                    <!-- Start visibility filed -->
                                        <div class="form-group form-group-lg">
                                             <label class = "col-sm-2 control-label">  visible</label>
                                             <div class="col-sm-10 col-md-6">
                                                  <div>
                                                    <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility'] == 0){ echo 'checked';} ?>/>
                                                    <label for="vis-yes">Yes</label>

                                                  </div>
                                                  <div>
                                                     <input id="vis-no" type="radio" name="visibility" value="1"   <?php if($cat['Visibility'] == 1){ echo 'checked';} ?>/>
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
                                                    <input id="com-yes" type="radio" name="commenting" value="0"  <?php if($cat['Allow_Comment'] == 0){ echo 'checked';} ?>/>
                                                    <label for="com-yes">Yes</label>
                                                  </div>
                                                  <div>
                                                   <input id="com-no" type="radio" name="commenting" value="1"  <?php if($cat['Allow_Comment'] == 1){ echo 'checked';} ?>/>
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
                                                    <input id="ads-yes" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads'] == 0){ echo 'checked';} ?>/>
                                                    <label for="ads-yes">Yes</label>

                                                   </div>
                                                   <div>
                                                      <input id="ads-no" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads'] == 1){ echo 'checked';} ?>/>
                                                     <label for="ads-no">No</label>
   
                                                   </div>
                                             </div>
                                        </div>
                                                        <!-- end ads filed -->
     

                                                         <!-- Start submit filed -->
                                        <div class="form-group form-group-lg">
                                              <div class=" col-sm-offset-2 col-sm-10">
                                                  <input type="submit" value="save" class="btn btn-primary btn-lg" />
                                             </div>
                                        </div>
                                                         <!-- end submit filed -->
                                    </div>  

                              </form>
     
                         </div> 
                     
          <?php  
          }
                                      //If There is No Such ID Show Error Message 
                       else {
                            echo "<div class = 'container'>";
                                 $theMsg = '<div class = "alert alert-danger">Theres Is No Such ID </div>';
                                 redirectHome($theMsg ,);
                            echo "</div>";
                            }       
          



         }elseif($do == 'Update'){
          echo "<h1 class='text-center'>Update Category</h1>";
			echo "<div class='container'>";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Get Variables From The Form

				$id 		= $_POST['catid'];
				$name 		= $_POST['name'];
				$desc 		= $_POST['description'];
				$order 		= $_POST['ordering'];

				$visible 	= $_POST['visibility'];
				$comment 	= $_POST['commenting'];
				$ads 		= $_POST['ads'];

				// Update The Database With This Info

				$stmt = $con->prepare("UPDATE 
											categories 
										SET 
											Name = ?, 
											Description = ?, 
											Ordering = ?, 
											Visibility = ?,
											Allow_Comment = ?,
											Allow_Ads = ? 
										WHERE 
											ID = ?");

				$stmt->execute(array($name, $desc, $order, $visible, $comment, $ads, $id));

				// Echo Success Message

				$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

				redirectHome($theMsg, 'back');
               } else {

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

			}

			echo "</div>";



         }elseif($do == 'Delete'){
          echo "<h1 class='text-center'>Delete Category</h1>";
          echo "<div class='container'>";

               // Check If Get Request Catid Is Numeric & Get The Integer Value Of It

               $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

               // Select All Data Depend On This ID

               $check = checkItem('ID', 'categories', $catid);

               // If There's Such ID Show The Form

               if ($check > 0) {

                    $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");

                    $stmt->bindParam(":zid", $catid);

                    $stmt->execute();

                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

                    redirectHome($theMsg, 'back');

               } else {

                    $theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

                    redirectHome($theMsg);

               }

          echo '</div>';


         }
          include $tbl . 'footer.php';
    
    }else{

        header("Location : index.php");
        exit();
    }

ob_end_flush();
?>