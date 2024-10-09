<?php 
/**
 * manage comment page
 * you can approve |edit | delete comments from here
 */

 ob_start(); //Output Buffering Start

 session_start();

$pageTitle = 'comments';
      

 if (isset($_SESSION['Username'])){
            include 'init.php';

            $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
            
            if($do == 'Manage'){ //manage page 
               

               //Select All Users Execept Admin//
               $stmt = $con->prepare("SELECT 
                                          comments.*, items.Name AS Item_Name, users.Username AS Member 
                                      FROM 
                                          comments
                                      INNER JOIN 
                                          items
                                      ON
                                          items.Item_ID = comments.item_id
                                      INNER JOIN
                                          users
                                      ON
                                          users.UserID = comments.user_id
                                      ORDER BY
                                          c_id DESC
                                      ");
               //Execute The Statement
               $stmt ->execute();
               //Assign To Variable
               $comments =$stmt->fetchAll();
            
            
            
            
            ?> 
                     
                     <h1 class = "text-center  "> Manage comments</h1>
                     <div class="container">
                                <div class="table-responsive">
                                      <table class=" main-table text-center  table table-bordered">
                                        <tr class="bg-secondary text-light">
                                             <td>ID</td>
                                             <td>Comment</td>
                                             <td>Item Name</td>
                                             <td>User Name</td>
                                             <td>Added Date</td>
                                             <td>Control</td>
                                        </tr>
                                        <?php
                                            foreach($comments as $comment){
                                             echo "<tr>";
                                                  echo "<td>" . $comment['c_id'] . "</td>";
                                                  echo "<td>" . $comment['comment'] . "</td>";
                                                  echo "<td>" . $comment['Item_Name'] . "</td>";
                                                  echo "<td>" . $comment['Member'] . "</td>";
                                                  echo "<td>" . $comment['comment_date'] . "</td>";
                                                  echo "<td>
                                                       <a href='comments.php?do=Edit&comid= " .$comment['c_id'] ." 'class='btn btn-success'><i class='fa fa-edit'></i>Edit</a>
                                                       <a href= 'comments.php?do=Delete&comid= " .$comment['c_id']. " 'class='btn btn-danger confirm'><i class='fa fa-close'></i>Delete</a>";
                                        
                                                       if($comment['status'] == 0){
                                                             echo" <a 
                                                             href= 'comments.php?do=Approve&comid= " .$comment['c_id']. " '
                                                             class='btn btn-info activate '>
                                                             <i class='fa fa-check'></i>Approve</a>";
                                                       }
                                                   echo "</td>";
                                                  
                                             echo "</tr>";

                                            }
                                        ?>
                                        <tr>
                                      </table>

                              </div>
                     </div>                 
                          
          <?php  
                    

     } elseif ($do == 'Edit'){//Edit Page
              // echo 'welcome to edit your id is' . $_GET['userid'];
                       
                         //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0 ;

                           //echo $userid;

                           //Select All Data Depend On Thid ID 
                          $stmt = $con->prepare("SELECT * FROM comments WHERE  c_id = ?  ");
                           
                          //Execute Query
                        $stmt->execute(array($comid));
                          //FetCH THe Data
                        $row = $stmt->fetch();
                        //The Row Count
                       $count=$stmt->rowCount();
                        //If There Such Id Show The Form
                       if($count > 0){ ?>
                    <h1 class = "text-center  "> Edit Comment</h1>
                    <div class="container">
                          <form class="form-horizontal" action ="?do=update" method ="POST">
                                      <input type="hidden" name="comid" value="<?php echo $comid ?>"/>
                                           <!-- Start Comment filed -->
                                      <div class="form-group form-group-lg">
                                          <label class = "col-sm-2 control-label"> Comments</label>
                                           <div class="col-sm-10">
                                               <textarea class="form-control" name="comment"><?php echo $row['comment'] ?></textarea>
                                            </div>
                                       </div>
                                            <!-- end Comment filed -->
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
                                   redirectHome($theMsg ,'back');
                              echo "</div>";
                              }       
            

      } elseif ( $do == 'update'){ //update page

          echo "<h1 class = 'text-center'> Update Comment</h1>";
          echo "<div class = 'container'> ";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
               //Get variable from the form
              $comid       = $_POST['comid'];
              $comment     = $_POST['comment'];
                  
                    //UPdate  the database with this info//

                     $stmt = $con->prepare("UPDATE comments SET comment = ?  WHERE c_id = ? ");
                     $stmt->execute(array($comment ,  $comid));

                     //Echo success message
                      $theMsg = "<div class = 'alert alert-success'>" . $stmt->rowCount() . 'Record Updated </div>';
                      redirectHome ($theMsg , 'back');

              

           }else{
                    $theMsg= '<div class = "alert alert-danger">you cant Browse this page directly</div>';
                    redirectHome($theMsg , 'back');
                } 
            echo "</div>";          




          }elseif ($do == 'Delete'){
               // Delete member page 
               echo "<h1 class = 'text-center'> Delete comment</h1>";
               echo "<div class = 'container'> ";
                       //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0 ;

                           //echo $userid;
                       $check = checkItem('c_id' , 'comments' , $comid);

                              //Select All Data Depend On Thid ID 
                              //  $stmt = $con->prepare("SELECT * FROM `users` WHERE  `UserID` = ?  LIMIT 1 ");
                           
                             //Execute Query
                             // $stmt->execute(array($userid));
                             //The Row Count
                             // $count=$stmt->rowCount();
                        //If There Such Id Show The Form
                       if($check > 0){ 

                         $stmt = $con-> prepare("DELETE FROM comments WHERE c_id = :zid ");
                         $stmt->bindparam(":zid" , $comid);
                         $stmt->execute();


                         $theMsg = "<div class = 'alert alert-success container'>" . $stmt->rowCount() . 'Record Deleted </div>';
                         redirectHome ($theMsg);




                       }else{
                         echo '<div class = "container">';
                         $theMsg ='<div class = "alert alert-danger">This Id isnot Exist</div>';
                         redirectHome($theMsg);
                         echo '</div>';
                       }
                       echo '</div>';

          } elseif ($do == 'Approve'){
               echo "<h1 class = 'text-center'> Approve comments</h1>";
               echo "<div class = 'container'> ";
                       //check if Get Request Userid Is Numeric & Get The Integer Value Of It
                       $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0 ;

                           //echo $userid;
                       $check = checkItem('c_id' , 'comments' , $comid);

                              //if check > 0
                       if($check > 0){ 

                         $stmt = $con-> prepare("UPDATE comments SET status = 1 WHERE c_id = ?  ");
                         $stmt->execute(array($comid));


                         $theMsg = "<div class = 'alert alert-success container'>" . $stmt->rowCount() . 'Record Approve </div>';
                         redirectHome ($theMsg);




                       }else{
                         echo '<div class = "container">';
                         $theMsg ='<div class = "alert alert-danger">This Id isnot Exist</div>';
                         redirectHome($theMsg);
                         echo '</div>';
                       }
                       echo '</div>';



          }


          include $tpl . 'footer.php'; 

     }else {

          header("Location: index.php");

    exit();


}
ob_end_flush();



            
  