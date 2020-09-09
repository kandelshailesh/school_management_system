<?php
error_reporting(E_ALL & ~E_NOTICE);
  $pagetitle="student Report";
  include "includes/header.php"; ?>
  <div class="container">
  <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Attendance Report</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
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
<form method="get" action="AttendenceReport.php?student_name="<?php $_GET['search']; ?>">
  <input type="text" name="search" id="search" placeholder="Search..">
</form>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$connect=mysql_connect("localhost","root","");
if(!$connect)
{
	echo "Error".mysql_error();
	}
	
	
	$db=mysql_select_db("sms");
	if(!$db)
	{
		echo "Error".mysql_error();
		}
		 
?>
	<div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>
                  
                      <th>StudentRollNumber</th>
                      <th>StudentName</th>
                      <th>Subject</th>
                      <th>Year</th>
                      <th>Class</th>
                      <th>Date</th>
                      <th>Percentage</th>
		
                      
                    </tr>
                  </thead>
     <tbody>
          <?php  
if(isset($_GET['search'])){		 
 $s= $_GET['search'];
$query=mysql_query("Select (Select count(*) from tbl_attendence Where attendence='P')/ count(studentrollNumber) *100 as Percentage from tbl_attendence ");
			$query3=mysql_query("Select * from tbl_attendence T 
inner join Student_Table st on st.std_roll_no=T.StudentRollNumber 
inner join Subject_table S on T.subjectID=S.Subject_No where st.student_name like '%$s%' group by S.Subject_name,st.student_name ");
while($row=mysql_fetch_row($query3))
{
  echo"<tr>";
            echo '<td>'. $row[1] . '</td>';
            echo '<td>'. $row[17] . '</td>';
			echo '<td>'. $row[21] . '</td>';
			echo '<td>'. $row[13] . '</td>';
			echo '<td>'. $row[14] . '</td>';
			echo '<td>'. $row[4] . '</td>';
           $query=mysql_query("Select  (select count(*) from tbl_attendence where Attendence='P' and studentRollNumber='$row[1]' and subjectId='$row[2]')/(Select count(attendence) from tbl_attendence where studentRollNumber='$row[1]' and subjectId='$row[2]')*100 as per from tbl_attendence where studentrollNumber='$row[1]' and subjectid='$row[2]' group by per asc ");
		   
		while ($row2=mysql_fetch_row($query))
		   {
			   echo '<td>'. $row2[0] . '%</td>';
/*if($row2[0]<30)
{
echo "<td><span style='color:red;'>dropped</span></td>";

}
else
echo "<td><span style='color:green;'>Promoted</span></td>";

*/
			   }
			   echo"</tr>";
}

}
else{


		  
            $query=mysql_query("Select (Select count(*) from tbl_attendence Where attendence='P')/ count(studentrollNumber) *100 as Percentage from tbl_attendence ");
			$query3=mysql_query("Select * from tbl_attendence T 
inner join Student_Table st on st.std_roll_no=T.StudentRollNumber
inner join Subject_table S on T.subjectID=S.Subject_No group by S.Subject_name,st.student_name ");
while($row=mysql_fetch_row($query3))
{
  echo"<tr>";
            echo '<td>'. $row[1] . '</td>';
            echo '<td>'. $row[17] . '</td>';
			echo '<td>'. $row[21] . '</td>';
			echo '<td>'. $row[13] . '</td>';
			echo '<td>'. $row[14] . '</td>';
			echo '<td>'. $row[4] . '</td>';
           $query=mysql_query("Select  (select count(*) from tbl_attendence where Attendence='P' and studentRollNumber='$row[1]' and subjectId='$row[2]')/(Select count(attendence) from tbl_attendence where studentRollNumber='$row[1]' and subjectId='$row[2]')*100 as per from tbl_attendence where studentrollNumber='$row[1]' and subjectid='$row[2]' group by per asc ");
		   
		while ($row2=mysql_fetch_row($query))
		   {
			   echo '<td>'. $row2[0] . '%</td>';
/*if($row2[0]<30)
{
echo "<td><span style='color:red;'>dropped</span></td>";

}
else
echo "<td><span style='color:green;'>Promoted</span></td>";

*/
			   }
			   echo"</tr>";
}
}
           ?>
      </tbody>     
            </table>
             </div><!--table-responsive-->
            </div><!--container-->
<?php include "includes/footer.php"; ?>
