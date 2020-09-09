<?php
session_start();
require_once('fpdf/fpdf.php');
require_once('commonForMarks.php');

//this page must receive 'id' and 'grade' and 'term' information from previous page
if(!isset($_POST['term']))
{
  echo "Error acquiring session";
  die();
}

$grade = $_POST['class'];
$grade = numToStr($grade);
$id = $_SESSION['id'];
$term = $_POST['term'];


class PDF extends FPDF
{
  static $lnSpace = 5;

  public function printHeader(){
    $this->SetFont('Arial','B',18);
    $this->Cell(0, 266, NULL, 1);
    $this->Ln(PDF::$lnSpace);
    $this->image('avm_logo.jpg', 16, 13);
    $this->Cell(0,10,'AVM HIGHER SECONDARY SCHOOL',NULL,NULL,"C");
    $this->Ln(PDF::$lnSpace + 3);
    $this->SetFont('Arial','IB',14);
    $this->Cell(0,10,'Manbhawan, Lalitpur',NULL,NULL,"C");
    $this->Ln(PDF::$lnSpace);
    $this->SetFont('Arial','IB',10);
    $this->Cell(0,10,'Tel:01-5534235, 4354523',NULL,NULL,"C");
    $this->Ln(PDF::$lnSpace+3);
    $this->SetFont('Arial','B',14);
    $exam = ' TERMINAL EXAMINATION PROGRESS REPORT '; //add which terminal exam it is and the year the exam took place
    $this->Cell(0,10,$exam,NULL,NULL,"C");
    $this->Ln(PDF::$lnSpace+5);
  }

  public function printStudentInfo(){  //pass student info as parameters to this function
    $info = $_SESSION['stuInfoArr'];
    $this->Ln(PDF::$lnSpace);
    $this->SetFont('Arial','B',10);
    $nameField = '        Name of the Student:  ' . $info[0];  //add name variable
    $this->Cell(0, 10, $nameField, NULL, NULL);
    $grade = 'Grade: '. $_POST['class'] .'          ';  //add grade variable
    $this->Cell(0, 10, $grade, NULL, NULL, "R");
    $this->Ln(PDF::$lnSpace);

    $parent = '        Parent\'s name:  ' . $info[2];  //add name variable
    $this->Cell(0, 10, $parent, NULL, NULL);
    $studId = 'Student ID:  ' . $info[3] . '          ';  //add grade variable
    $this->Cell(0, 10, $studId, NULL, NULL, "R");
    $this->Ln(PDF::$lnSpace);

    $dOb = '        Date of Birth:  ' . $info[4];  //add name variable
    $this->Cell(0, 10, $dOb, NULL, NULL);
    $this->Ln(PDF::$lnSpace*2);
  }

  public function printMarks(){   //draw marksheet table
    $tableWidth = $this->GetPageWidth() - 2 * 10 - 2 * 8; //10cm margin in by default in the page. We set 8mm margin by ourselves
    $this->cell(8, 10);
    $this->cell(0.06 * $tableWidth, 10, "S.N.", 1, NULL, "C");
    $this->cell(.46 * $tableWidth, 10, "Subjects", 1, NULL, "C");
    $this->cell(.15 * $tableWidth, 5, "Full", 'TR', NULL, "C");
    $this->cell(.15 * $tableWidth, 5, "Pass", 'TR', NULL, "C");
    $this->cell(.15 * $tableWidth, 5, "Obtained", 'TR', 1, "C");
    $this->cell(8, 10);
    $this->cell(0.52 * $tableWidth, 10);
    for($i = 0; $i < 3; $i++){
      if($i == 2){
        $this->cell(.15 * $tableWidth, 5, "Marks", 'BR', 1, "C");
        continue;
      }
      $this->cell(.15 * $tableWidth, 5, "Marks", 'BR', NULL, "C");
    }

    $xml=simplexml_load_file("gradeSubInfo.xml");  //load list of subjects
    $sub = $xml->$GLOBALS['grade']->sub;  //load from xml file
     //user defined function
    $sn = ''; //list of all serial numbers on new libxml_use_internal_errors
    $fmXMLobj = $xml->$GLOBALS['grade']->fm; //list of full Marks
    $fm = xml2array($fmXMLobj);

    $pmXMLobj = $xml->$GLOBALS['grade']->pm; //list of pass Marks
    $pm = xml2array($pmXMLobj);

//QUERY THE RESPECTIVE GRADE TABLE OF MARKS AND RETURN ONLY THE MARKS IN $om
    $dbname = 'sms';
    $handle = connect($dbname, 'root');
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $qry = "SELECT * FROM " . $GLOBALS['grade'] . " WHERE id = '" . $GLOBALS['id'] . "' AND term = " . $GLOBALS['term'];
    $x = $handle->prepare($qry);
    $x->execute();
    $row = $x->fetch(PDO::FETCH_NUM);    //I don't think we need a while loop here. So, don't need to use it here.(CHECK THOUGH)
    if(!$row)
    {
      echo "Error: You have not appeared for that examination";
      die();
    }
    $om = array_slice($row, 3);

    //  = array(80, 77, 80, 96, 96, 69, 69, 69, 69, 99);  list of obtained marks
    $count = sizeof($sub);     //set this to the number of subjects available
    $index = -1;
    $this->SetFont('Arial',NULL,10);

    while(++$index < $count){
      $border = "R";
      if($index == 9)
       $border = "RB";
      $this->cell(8, 10);
      $this->cell(0.06 * $tableWidth, 10, $index+1, $border."L", NULL, "C");
      $this->cell(.46 * $tableWidth, 10, $sub[$index], $border, NULL, "L");
      $this->cell(.15 * $tableWidth, 10, $fm[$index], $border, NULL, "C");
      $this->cell(.15 * $tableWidth, 10, $pm[$index], $border, NULL, "C");
      $this->cell(.15 * $tableWidth, 10, $om[$index], $border, 1, "C");
    }

    while($count++ < 10){
      $border = "R";
      if($count == 10)
       $border = "RB";
      $this->cell(8, 10);
      $this->cell(0.06 * $tableWidth, 10, NULL, $border."L", NULL, "C");
      $this->cell(.46 * $tableWidth, 10, NULL, $border, NULL, "C");
      $this->cell(.15 * $tableWidth, 10, NULL, $border, NULL, "C");
      $this->cell(.15 * $tableWidth, 10, NULL, $border, NULL, "C");
      $this->cell(.15 * $tableWidth, 10, NULL, $border, 1, "C");
    }

    $this->cell(8, 10);
    $this->SetFont('Arial', 'B', 10);
    $this->cell(0.52 * $tableWidth, 10, 'Grand Total', "LB", NULL, "C");
    $this->cell(.15 * $tableWidth, 10, array_sum($fm), "LB", NULL, "C");
    $this->cell(.15 * $tableWidth, 10, array_sum($pm), "LB", NULL, "C");
    $this->cell(.15 * $tableWidth, 10, array_sum($om), "LBR", 1, "C");

    $this->printAnalysis($fm, $pm, $om, $tableWidth);
  }

  private function printAnalysis($fm, $pm, $om, $tableWidth){
    $flag = 'passed';
    for($i = 0; $i < sizeof($pm); $i++){
      if($om[$i] == NULL){
        $flag = 'absent';
        break;
      }
      if($om[$i] < $pm[$i]){
        $flag = 'failed';
        break;
      }
    }
    $this->Ln(PDF::$lnSpace);
    $this->cell(.82 * $tableWidth+8, 10);
    $result = 'Result: ' . $flag;
    $this->cell(0, 10, $result, NULL, 1, "L");

    if($flag == "passed"){
      $per = array_sum($om)/array_sum($fm) * 100;
      $div = $per >= 80 ? 'distinction' : ($per >= 70 ? 'first' : ($per >= 55 ? 'second' : 'third'));
      $per = round($per, 2);
      $per = $per . '%';
    }
    else {
      $per = $div = 'N/A';
    }

    $this->cell(.82 * $tableWidth + 8, 10);
    $Division = "Division:  " . $div;
    $this->cell(0, 10, $Division, NULL, 1, "L");

    $this->cell(.82 * $tableWidth + 8, 10);
    $percent = "Percentage: " . $per;
    $this->cell(0, 10, $percent, NULL, 1, "L");
  }

  public function foot(){
    $this->Ln( 5 * PDF::$lnSpace);
    $this->cell(8, 10);
    $date = '2017-03-27';
    $this->cell(25, 10, $date, NULL, NULL, "C");

    $this->cell(120, 10);

    $prncplSign = 'mahesh';
    $this->cell(25, 10, $prncplSign, NULL, 1, "C");

    $this->cell(8, 10);
    $this->cell(25, 10, "Date of Issue", "T", NULL, "C");

    $this->cell(120, 10);

    $this->cell(25, 10, 'Principal', "T", NULL, "C");
  }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->printHeader();
$pdf->printStudentInfo();
$pdf->printMarks();
$pdf->foot();
$pdf->Output();
?>
