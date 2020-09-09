
  <?php
  error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  $pagetitle="student data";
  // include "includes/header2.php";
  include "includes/header.php"; ?>
  <?php $db = new db(); ?>
  
  <style> 
#search[type=text] {
    width: 130px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

#search[type=text]:focus {
    width: 100%;
}
</style>

<form method="get" action="student.php?student_name="<?php $_GET['search']; ?>">
  <input type="text" name="search" id="search" placeholder="Search..">
</form>
  <script>
 function confirm_delete_resource(id)
{
    msg = "Are you sure you want to delete resource?";
    if (confirm(msg))
    {
        location = "student.php?student_id="+id;
    }
}
 </script>
 
<div class="container">
<?php     
         
		  
		  
		  
		  
          if (isset($_GET['student_id'])) {
             $id = $_GET['student_id'];

            if($db->delete_std($conn,'student_table',$id)){
              echo "Record was Deleted";
            }
			else{
				echo "Unable to delete";
			}
          }
?>
            
              <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Students Records</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
        <!--   <p><a href="student_entry.php" class="ui blue tiny button "><i class="glyphicon glyphicon-plus"> </i>Insert</a></p>  -->
                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
                     <!--  <th>Std Id</th> -->
                      <th>Student Name</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Year</th>
                      <th>Class</th>
                   <th>Action</th> 
                    </tr>
                  </thead>
     <tbody>
          <?php 
             	   if(isset($_GET['search'])){
			  $veiw = $db->get_search_std($conn,'student_table',10,$_GET['search']);
            foreach ($veiw as $post) {
				$id=$post['student_id'];
            $std_id = $post['std_roll_no'];
  
          echo '<tr>';

            // echo '<td>'. $post['student_id'] . '</td>';          
            echo '<td>'. $post['student_name'] . '</td>';
            echo '<td>'. $post['dob'] . '</td>';
            echo '<td>'. $post['gender'] . '</td>';
            echo '<td>'. $post['email'] . '</td>';
            echo '<td>'. $post['phone'] . '</td>';
            echo '<td>'. $post['address'] . '</td>';
            echo '<td>'. $post['Status'] . '</td>';
            echo '<td>'. $post['Year'] . '</td>';
            echo '<td>'. $post['class'] . '</td>';
            
            echo '<td width=250>';
            echo "<div class='ui mini buttons'>";
           echo '<a class="ui mini positive button"  href="student_update.php?student_id='.$post['student_id'].'"> <i class="glyphicon glyphicon-pencil"></i>Update</a>';
            echo "<div class='or'></div>";    
			
            echo '<a class="ui mini red button" href="student.php?student_id='.$post['student_id'].'"><i class="glyphicon glyphicon-remove"> </i>Delete</a>';
            echo "</div>";
            echo '</td>';    
           echo '</tr>';  
			
            }
		  }
		  else{
				  
				  
				  
				  
            $veiw = $db->get_all_std($conn,'student_table',10);
            foreach ($veiw as $post) {
				$id=$post['student_id'];
            $std_id = $post['std_roll_no'];
  
          echo '<tr>';

            // echo '<td>'. $post['student_id'] . '</td>';          
            echo '<td>'. $post['student_name'] . '</td>';
            echo '<td>'. $post['dob'] . '</td>';
            echo '<td>'. $post['gender'] . '</td>';
            echo '<td>'. $post['email'] . '</td>';
            echo '<td>'. $post['phone'] . '</td>';
            echo '<td>'. $post['address'] . '</td>';
            echo '<td>'. $post['Status'] . '</td>';
            echo '<td>'. $post['Year'] . '</td>';
            echo '<td>'. $post['class'] . '</td>';
            
            echo '<td width=250>';
            echo "<div class='ui mini buttons'>";
           echo '<a class="ui mini positive button"  href="student_update.php?student_id='.$post['student_id'].'"> <i class="glyphicon glyphicon-pencil"></i>Update</a>';
            echo "<div class='or'></div>";    
            echo '<a class="ui mini red button" href="student.php?student_id='.$post['student_id'].'"><i class="glyphicon glyphicon-remove"> </i>Delete</a>';
            echo "</div>";
            echo '</td>';    
           echo '</tr>';  
			
            }
		  }
           ?>
      </tbody>     
            </table>
            </div><!--table-responsive-->   
           </div><!--container-->
<?php include "includes/footer.php"; ?>