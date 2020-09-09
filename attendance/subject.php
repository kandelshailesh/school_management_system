
<?php
session_start();
 $pagetitle="Subjects Information";
 include "includes/header.php"; ?>
 <?php $db = new db(); ?>
 <script>
 function confirm_delete_resource(id)
{
    msg = "Are you sure you want to delete resource?";
    if (confirm(msg))
    {
        location = "editres.php?delete="+id;
    }
}
 </script>

<div class="container">
<?php
          if (isset($_GET['subject_no'])) {
            $id = $_GET['subject_no'];

            if($db->delete_sub($conn,'subject_table',$id)){
              echo "Record was Deleted";
            }
			else 
			{
				echo "Unable to delete or unauthorized access";
			}
          }
?>

              <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Subjects Details</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
              <p><a href="subject_entry.php" class="ui blue tiny button "><i class="glyphicon glyphicon-plus"> </i>Insert</a></p> 
                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>          
                      <th>Subject No</th>
                      <th>Subject Name</th>
                      <th>Teacher Name</th>
                      <th>Comp/Opt</th>
                      <th>Class</th>
					  <th>Operation</th>
                    </tr>
					
                  </thead>
      <tbody>
          <?php        
            $veiw = $db->get_all_subject($conn,'subject_table',10);
            foreach ($veiw as $post) {
            $sub_no = $post['subject_no'];
  
            echo '<tr>';        
            echo '<td>'. $post['subject_no'] . '</td>';
            echo '<td>'. $post['subject_name'] . '</td>';
            echo '<td>'. $post['teacher_name'] . '</td>';
            echo '<td>'. $post['COpt'] . '</td>';
            echo '<td>'. $post['class'] . '</td>';
			
			
			echo	'<td>';
					 echo "<div class='ui mini buttons'>";
           echo '<a class="ui mini positive button" href="subject_update.php?subject_no='.$post['subject_no'].'"> <i class="glyphicon glyphicon-pencil"></i>Update</a>';
            echo "<div class='or'></div>";    
            echo '<a class="ui mini red button" href="subject.php?subject_no='.$post['subject_no'].'"><i class="glyphicon glyphicon-remove"> </i>Delete</a>';
            echo "</div>";
			echo '</td>';
              echo '</tr>';
            }
			
			 
				
           ?>
      </tbody>     
             </table>



</div> <!--table-responsive-->
</div><!--container-->
<?php include "includes/footer.php"; ?>
