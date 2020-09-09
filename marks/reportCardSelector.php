<?php
    include "bootheader.php";
    include "navbar2.php";
    
    include "../home/marksintro.php";
    ?>

<div class="container" style="padding:100;">
  <div class="row">
  <div class="col-sm-4">
  </div>
  <div class="col-sm-4">
   <h3>Enter your Info</h3>
    <form action = 'reportCard.php' method="post">
    <label for="grade">Grade:</label>

    <select name="class" id="grade" class="form-control" Placeholder="Grade">

      <?php
        session_start();
        $_SESSION['id'] = $_SESSION['user_id']; //this should be global session variable
        if(!isset($_SESSION['id']))
        {
          echo "Error acquiring session";
          die();
        }
        require_once('commonForMarks.php');

        $handle = connect('sms', 'root');
        $table = 'student_table';
        $qry = "SELECT * FROM " . $table . " WHERE student_id = '" . $_SESSION['id'] . "'";
        $x = $handle->prepare($qry);
        $x->execute();
        $row = $x->fetch(PDO::FETCH_OBJ);
        $count = 10;
        $html = '';
        for($i = 1; $i <= $count; $i++)
        {
          $html .= "<option value = '" . $i . "'>". $i . "</option>\n";
        }
        $html .= "</select>";
        echo $html;
        $_SESSION['stuInfoArr'] = array($row->student_name, $row->class, $row->father, $_SESSION['id'], $row->dob); //this will be used in marksheet


      ?>
      <br>
      <label for="term">Terminal:</label>
    <select name = 'term' id="term" class="form-control" Placeholder="Term">
      
      <option value = '1'>1</option>
      <option value = '2'>2</option>
      <option value = '3'>3</option>
    </select><br>
    <input type = 'submit' class="w3-btn w3-large form-control w3-blue" value = 'GO!'>
  </form><br>
  </div>
  <div class="col-sm-4">
    
  </div>
</div>
 
  </div>

<?php
    include "../home/footer.php";
   ?>
