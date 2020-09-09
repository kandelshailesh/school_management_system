<?php
function connect($dbname, $usrName, $pwd = ''){
  try{
    $x = "mysql:host=127.0.0.1:3306;dbname=" . $dbname;
    $handler = new PDO($x, $usrName, $pwd);
    return $handler;
  }
  catch(PDOException $e){
    echo $e->getMessage();
    die();
  }
}

function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}



function numToStr($n)
{
  $x = array('one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten');
  if($n >= 1)
    return $x[$n-1];
  else {
    return 'error converting number to string(preferably of grade)';
  }
}

function displayTableHeader($grade, &$html, &$sub = array(), &$fm = array())  //grade->which grade  html->populate this with html code for displaying table header  $sub = populate this with subjects array
{
  //---------------TABLE HEADER PART START------------
  printf("<p>%s</p>", $grade);
  $html .= "<table class = " . $grade . " border> <tr>";
  $html .= "<th>Id</th> <th>Year</th>  <th>Term</th>";

  $xml=simplexml_load_file("gradeSubInfo.xml");  //load the headings(subjects) of each column
  $subXmlObj = $xml->$grade->sub;
  $fmXmlObj = $xml->$grade->fm;
  $sub = xml2array($subXmlObj);
  $fm = xml2array($fmXmlObj);
  //display subjects fetched from xml
  if(!empty($sub))
  {
    foreach ($sub as $x)
    {
      $html .= "<th>" . $x . "</th>";
    }
  }
  $html .= "</tr>";
  //---------------TABLE HEADER ENDS------------------------
}
?>
