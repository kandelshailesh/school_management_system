
<form method = 'post' action = "<?php echo $_SERVER['PHP_SELF'] ?>">
  <input type = 'text' name = 'id' placeholder = 'STUDENT ID'></input>
  <input type = 'text' name = 'grade' placeholder="GRADE"></input>
  <input type = 'text' name = 'term' placeholder="TERM"></input>
  <input type = 'submit' name = 'add' value = 'ADD'>
  <input type = 'submit' name = 'edit' value = 'EDIT'>
  <input type = 'submit' name = 'delete' value = 'DELETE'>
</form>
</div>

<?php
  session_start();
  require_once('commonForMarks.php');

  //check if table is to be updated by the admin

  if(isset($_POST['add']))
  {
    echo"<p>ADD record:</p>";
    if(!isset($_POST['id']) || !isset($_POST['term']) || !isset($_POST['grade']))
    {
      echo"<p>Error: Empty fields</p>";
    }

    else
    {
      echo"NOW THIS SHOULD BE PRINTED";
      //direct to the page to enter marks
      $_SESSION['id'] = $_POST['id'];
      $_SESSION['grade'] = $_POST['grade'];
      $_SESSION['term'] = $_POST['term'];
      $_SESSION['flag'] = 'add';
      header("location:adminAddMarks.php");
    }
  }

  elseif(isset($_POST['edit']))
  {
    echo"<p>EDIT record</p>";
    if(!isset($_POST['id']) || !isset($_POST['term']) || !isset($_POST['grade']))
    {
      echo"<p>Error: Empty fields</p>";
    }
    elseif($_POST['term'] < 1 || $_POST['term'] > 3){
      echo"<p>Error: Invalid Term selected</p>";
    }
    else
    {
      //direct to the page to enter marks
      $_SESSION['id'] = $_POST['id'];
      $_SESSION['grade'] = $_POST['grade'];
      $_SESSION['term'] = $_POST['term'];
      $_SESSION['flag'] = 'edit';
      header("location:adminAddMarks.php");
    }
  }
try{
  if(isset($_POST['delete']))
  {
    printf("<p>deleting record with id '%d' , grade '%d' and term '%d'</p>", $_POST['id'], $_POST['grade'], $_POST['term']);
    if(empty($_POST['id']) || empty($_POST['grade']) || empty($_POST['term']))
    {
      printf("<p>error: empty fields</p>");
    }
    else
    {
      $handle = connect('sms', 'root');
      $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sqlStmt = "DELETE FROM " . numToStr($_POST['grade']) . " WHERE " . "id = " . $_POST['id'] . " AND term = " . $_POST['term'];
      var_dump($sqlStmt);

      $x = $handle->prepare($sqlStmt);
      $x->execute();
    }
  }

  displayTables();
}
catch(PDOException $e)
{
  echo $e->getMessage() . " Error Occured";
  die();
}
?>
<div style="background-color: rgb(255, 179, 255);">

<?php
function displayTables()  //display all available marks of all grades
{
  for($i = 1; $i <= 10; $i++)
  {
    
    $grade = numToStr($i);
    $html = '';
    $sub = array();
    displayTableHeader($grade, $html, $sub);


    $handle = connect('sms', 'root');
    $qry = "SELECT * FROM " . $grade;
    $x = $handle->prepare($qry);
    $x->execute();

    while($row = $x->fetch(PDO::FETCH_ASSOC))
    {
      $html .= "<tr>  <td>" . $row['id'] . "</td> <td>" . $row['year'] . "</td>  <td>" . $row['term'] . "</td>";
      foreach ($sub as $y)
      {
        $html .= "<td>" . $row[strtolower($y)] . "</td>";
      }
      $html .= "</tr>";
    }

    $html .= "</table>";
    print($html);
 
  }

}
?>
</div>
</table>
</div>
