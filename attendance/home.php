<?php
session_start();

             if(isset($_SESSION['id'])){
              $username=($_SESSION['username']);
              $userId=($_SESSION['id']);
            }
			else if(isset($_SESSION['loggedin']) && $_SESSION['stat']!='root'){
				$username=($_SESSION['uname']);
			}
            else{
              header("Location:login.php");
            }
			include 'connection.php';
           //echo $_SESSION['stat'];
 $pagetitle="Home Page";
 include "includes/header.php";
     // include "includes/slider.php";
      ?>
        <div class="templatemo-welcome" id="templatemo-welcome">
            <div class="container">
                <div class="templatemo-slogan text-center">
                    <span class="txt_darkgrey">Welcome to </span><span class="txt_orange">Attendance Page</span>
                    <p class="txt_slogan">
                </div>	
            </div>
        </div>   
        

    <div id="templatemo-blog">
            <div class="container">
                <div class="row">
                 <?php include "includes/sidebar.php";?>
                <div class="blog_box">
                    <div class="col-sm-5 col-md-6 blog_post">
                        <ul class="list-inline">
                        <li>    
                        <div class="clearfix"> </div>
                        <p class="blog_text">
                            </p>
                            </li>
                        </ul>
                    </div> <!-- /.blog_post 1 --> 
                </div>
              </div>
           </div>
    </div>
<?php include "includes/footer.php"; ?>