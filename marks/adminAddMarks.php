<?php
  session_start();
  require_once('commonForMarks.php');
  if(isset($_SESSION['flag']))
  {
    $html = '';
    $sub = array();
    $fm = array();
    $grade = numToStr($_SESSION['grade']);
    displayTableHeader($grade, $html, $sub, $fm);  //$html and $sub are no longer empty after calling this function
    // print $html;
    $handle = connect('sms', 'root');
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //allow pdo to throw exception

try{
    if(isset($_POST['submitEdit'])){ //check if submit button is clicked. field0 is the first subjet's name and id is student's id submitted through form
      $size = sizeof($sub);  //hold number of subjects
      if($_POST['term'] > 3 || $_POST['term'] < 1)
        throw(new PDOException());
      $sqlStmt = "UPDATE `" . $grade . "` SET `id`='" . $_POST['id'] . "', `year`=" . $_POST['year'] . ", `term`=" . $_POST['term'];
      $flag = 1;
      for($i = 0; $i < $size; $i++)
      {
          $tmp = "field" . $i;

          if($_POST[$tmp] > $fm[$i] || $_POST[$tmp] < 0)
            $flag = 0;

          if(isset($_POST[$tmp]))
            $sqlStmt .= ", `" . $sub[$i] . "`=" . $_POST[$tmp] . "";
          else {
            $sqlStmt .= ", `" . $sub[$i] . "`=NULL";
          }
      }

      if($flag != 1)
        throw(new PDOException());

      var_dump($sqlStmt);
      $sqlStmt .= " WHERE `id`='" . $_SESSION['id'] . "' AND `term`=" . $_SESSION['term'] . "";

        $x = $handle->prepare($sqlStmt);
        $x->execute();

      var_dump($x);
      $_SESSION['id'] = $_POST['id'];
      $_SESSION['term'] = $_POST['term'];
      header("location:StudentSelection.php");
    }

    if(isset($_POST['submitAdd'])){ //check if submit button is clicked. field0 is the first subjet's name and id is student's id submitted through form
      $size = sizeof($sub);  //hold number of subjects
      if($_POST['term'] > 3 || $_POST['term'] < 1)
        throw(new PDOException());
      $flag = 1;
      $sqlStmt = "INSERT INTO `" . $grade . "` VALUES ('" . $_POST['id'] . "', '" . $_POST['year'] . "', " . $_POST['term'];
      for($i = 0; $i < $size; $i++)
      {
          $tmp = "field" . $i;

          if($_POST[$tmp] > $fm[$i] || $_POST[$tmp] < 0)
            $flag = 0;

          if(isset($_POST[$tmp]))
            $sqlStmt .= ", " . $_POST[$tmp];
          else {
            $sqlStmt .= ", NULL";
          }
      }

      if($flag != 1)
        throw(new PDOException());

      $sqlStmt .= ");";
      var_dump($sqlStmt);

      $x = $handle->prepare($sqlStmt);
      $x->execute();

      var_dump($x);
      header("location:StudentSelection.php");
    }

    if($_SESSION['flag'] == 'edit')
    {
      $qry = "SELECT * FROM " . $grade . " WHERE id = '" . $_SESSION['id'] . "' AND term = " . $_SESSION['term'];
      var_dump($qry);
      $x = $handle->prepare($qry);
      $x->execute();
      $html .= "<form method = 'post' action = '" . $_SERVER['PHP_SELF'] . "'>";
      if($row = $x->fetch(PDO::FETCH_ASSOC))
      {
        $html .= "<tr>  <td><input type = 'text' value = '" . $row['id'] . "' name = 'id'></td> <td><input type = 'text' value = '" . $row['year'] . "' name = 'year'></td> <td><input type = 'text' value = '" . $row['term'] . "' name = 'term'></td>";
        $counter = 0;
        foreach($sub as $field)
        {//more vars need to be POSTed
          $html .= "<td><input type = 'text' value = '" . $row[strtolower($field)] . "' name = 'field" . $counter . "'></td>";
          $counter+=1;
        }
        $html .= "</tr>";
      }
      else {
        printf("<h1>Record Not Found</h1>");
        die();
      }
      $html .= "</table>";
      $html .= "<input type = 'submit' name = 'submitEdit' value = 'submit'></form>";
      printf($html);
    }

    elseif($_SESSION['flag'] == 'add')
    {
      $qry = "SELECT * FROM " . $grade . " WHERE id = '" . $_SESSION['id'] . "' AND term = " . $_SESSION['term'];
      var_dump($qry);
      $x = $handle->prepare($qry);
      $x->execute();
      if($x->fetch(PDO::FETCH_ASSOC)){
        print("<P>ERROR: RECORD ALREADY EXISTS</p>");
        die();
      }
      $html .= "<form method = 'post' action = '" . $_SERVER['PHP_SELF'] . "'>";

        $html .= "<tr>  <td><input type = 'text' name = 'id' value = " . $_SESSION['id'] . "></td> <td><input type = 'text' name = 'year'></td> <td><input type = 'text'  name = 'term' value = " . $_SESSION['term'] . "></td>";
        $counter = 0;
        for($i = 0; $i < sizeof($sub); $i++)
        {
          $html .= "<td><input type = 'text' name = 'field" . $i . "'></td>";
        }
        $html .= "</tr>";
      $html .= "</table>";
      $html .= "<input type = 'submit' name = 'submitAdd' value = 'submit'></form>";
      printf($html);
    }

    else
    {
      printf("<h1>ERROR:</h1><h2>Page reached for purpose other than adding or editing records.</h2>");
      die();
    }

}

catch(PDOException $e)
{
  echo($e->getMessage(). "<br>Error: Invalid data<br>");
  exit();
}
}
  else
  {
    echo"Error: This is accessible only to admin after entering student's credentials.";
  }



?>
