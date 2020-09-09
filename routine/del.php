<?php
session_start();
include "config/connect.php";

mysqli_query($con,"DELETE FROM subjects WHERE ID = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='rekap.php';</script>";
?>