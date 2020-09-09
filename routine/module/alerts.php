<?php
function writeMsg($tipe){
	if ($tipe=='save.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Success!</strong> A subject has been created.";	
	} else 
	if ($tipe == 'save.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong>Something went wrong!";
	}
	else 
	if ($tipe == 'update.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Success!</strong>";
	}
	else 
	if ($tipe == 'update.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong> Data gagal diupdate!";
	}

echo "<div class=\"alert alert-dismissible ".$MsgClass."\">
  	  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  	  ".$Msg."
	  </div>";		  
}
?>