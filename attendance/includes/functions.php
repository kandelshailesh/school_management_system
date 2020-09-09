   <?php 
      $conn = "";
      try {
if(isset($_SESSION['signup'])){
        $conn = new PDO('mysql:host=localhost;dbname=sms;','root','');
}
else{
	
	if(isset($_SESSION['loggedin'])){
        $conn = new PDO('mysql:host=localhost;dbname=sms;',$_SESSION['status'],$_SESSION['status']);
	}
}
           if($conn){
			   //echo "successfully connected!";
		   }
      } catch (Exception $e) {

        echo 'ERROR'.$e->getMessage();
      }

// $con = mysqli_connect("localhost","root","","attendance_db");

// // Check connection
// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
//   // else{
//   // 	echo "successfully connected!";
//   // }
// 	$conn = new mysqli("localhost","root","","attendance_db");
// 	// Check connection
// 	if ($conn->connect_error) {
// 	    die("Connection failed: " . $conn->connect_error);
// } 



     Class db{

/**********************/
//Students Entry
/*********************/
 function std_entry($conn,$studentName,$dob,$gender,$email,$phone,$add,$session,$program,$semester){
	try{
		
		$query = "INSERT INTO student_table SET student_name = ?, dob = ?, gender = ?,email = ?,phone = ?, address = ?, Session=?,Program=?,Semester=?";

		$entry = $conn->prepare($query);
		$entry->bindValue(1, $studentName);
		$entry->bindValue(2, $dob);
		$entry->bindValue(3, $gender);
		$entry->bindValue(4, $email);
		$entry->bindValue(5, $phone);
		$entry->bindValue(6, $add);
		$entry->bindValue(7, $session);
		$entry->bindValue(8, $semester);
		$entry->bindValue(9, $program);
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}


		/**********************/
		//Gettintg all records
		/*********************/

function get_all_std($conn,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  std_roll_no LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  
		  function get_search_std($conn,$table,$limit,$name){

			try {
				$query = "SELECT * FROM {$table} where student_name like '%$name%' ORDER BY  std_roll_no LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }


	      /*********************************/
		//Getting single record for editing
		/***********************************/

function get_single_std($conn,$table,$id)
	{
		
		try {
           // echo $table;
		$query = "SELECT * FROM {$table} WHERE student_id='$id' ";
		//echo $query;
			$stmt = $conn->prepare($query);
			// $stmt->bindParam(1, $id);
			if($stmt->execute()){
			return $stmt->fetchAll();
            }
			else{
				die("Error fetching students");
			}
			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}

		/**********************/
		//delete single record
		/*********************/

function delete_std($conn,$table,$id){

			try {
				$query = "DELETE  FROM {$table} WHERE student_id='$id'";
					$stmt = $conn->prepare( $query );
					if($stmt->execute()){
						echo "Successfully deleted";
					}
				 else{
					 echo "Error deleting";
					 return 0;
				 }	
               $query = "DELETE  FROM users WHERE user_id='$id'";
					$stmt = $conn->prepare( $query );
					if($stmt->execute()){
						echo "Successfully deleted";
						//return 1;
					}
				 else{
					 echo "Error deleting";
					 return 0;
				 }						 
				  $query = "DELETE  FROM structures WHERE user_id='$id'";
					$stmt = $conn->prepare( $query );
					if($stmt->execute()){
						echo "Successfully deleted";
						return 1;
					}
				 else{
					 echo "Error deleting";
					 return 0;
				 }						 
					
			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	}

	 	/*****************************/
		//Update singel Student Record
		/****************************/

	function update_std($conn,$s_id,$roll_no,$dob,$gender,$email,$phone,$add, $status, $year, $class,$father,$mother,$studentName,$fee,$scholarship){
	try{
		
		$query = "UPDATE  student_table SET student_id= ?, std_roll_no=? , dob = ?, gender = ?, email = ?, phone = ?, address = ? , Status = ?, Year= ?, class = ?,father=?,mother=?,student_name = ?,fee=?,scholarship=? WHERE student_id ='$s_id'";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1, $s_id);
		$stmt->bindParam(2, $roll_no);
		$stmt->bindParam(3, $dob);
		$stmt->bindParam(4, $gender);
		$stmt->bindParam(5, $email);
		$stmt->bindParam(6, $phone);
		$stmt->bindParam(7, $add);
		$stmt->bindParam(8, $status);
		$stmt->bindParam(9, $year);
		$stmt->bindParam(10, $class);
		$stmt->bindParam(11, $father);
		$stmt->bindParam(12, $mother);
		$stmt->bindParam(13, $studentName);
		$stmt->bindParam(14, $fee);
		$stmt->bindParam(15, $scholarship);
		//$stmt->bindParam(16, '$s_id');
		if($stmt->execute()){
			$query="UPDATE structures SET Name=? where user_id='$s_id'";
			$stmt=$conn->prepare($query);
			$stmt->bindParam(1, $studentName);
			if($stmt->execute()){
			return 1;
			die();
			}
			else{
				return 0;
			}
		}else{
			 return 0;
			
		}
	}

		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	/**************************/
	//Teachers Registration
	/*************************/
 function teacher_entry($conn,$firstName,$lastName,$dob,$gender,$email,$phone,$degree,$salary,$address){
	try{
		
		$query = "INSERT INTO teacher_table SET first_name = ?, last_name = ?, dob = ?, gender = ?,email = ?,phone = ?,degree = ?,salary = ? , address = ?";

		$entry = $conn->prepare($query);
		$entry->bindValue(1, $firstName);
		$entry->bindValue(2, $lastName);
		$entry->bindValue(3, $dob);
		$entry->bindValue(4, $gender);
		$entry->bindValue(5, $email);
		$entry->bindValue(6, $phone);
		$entry->bindValue(7, $degree);
		$entry->bindValue(8, $salary);
		$entry->bindValue(9, $address);
		
		if($entry->execute())
		{
			return "Successfully registered.";
			die();
		}
		else{
			return "Unable to register! Try again please.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

        /*****************************/
		//Fetching Teachers Records
		/****************************/ 


	function get_all_teacher($conn,$table,$limit){
	       try {
				$query = "SELECT * FROM {$table} ORDER BY  teacher_id LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }


function get_search_teacher($conn,$table,$limit,$name){
	       try {
				$query = "SELECT * FROM {$table} where first_name like '%$name%' ORDER BY  teacher_id LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }

       /***************************************************/
		  //Fetching teacher's single record for Editing
	   /*************************************************/ 

	 	function get_single_teacher($conn,$table,$id){
	        try {
				$query = "SELECT * FROM {$table} WHERE teacher_id= '$id'";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }     

    /******************************/
	//Deleting Teacher's Record
	/*****************************/

    function delete_teacher_record($conn,$table,$t_id){
    	try{ 
		 $query="select * from teacher_table where teacher_id='$t_id'";
		   $stmt=$conn->prepare($query);
    		$stmt->execute();
			$res=$stmt->fetchAll();
			foreach($res as $value){
				$res_id=$value['res_id'];
			}
			$query="DELETE FROM resources WHERE ID={$res_id}";
    		$stmt=$conn->prepare($query);
    		if(!$stmt->execute()){
				return 0;
			}
			
    		$query="DELETE FROM {$table} WHERE teacher_id='$t_id'";
    		$stmt=$conn->prepare($query);
    		if(!$stmt->execute()){
				return 0;
			}
			$query="DELETE FROM structures WHERE user_id='$t_id'";
    		$stmt=$conn->prepare($query);
    		if(!$stmt->execute()){
				return 0;
			}
			$query="DELETE FROM users WHERE user_id='$t_id'";
    		$stmt=$conn->prepare($query);
    		if(!$stmt->execute()){
				return 0;
			}
			else{
				return 1;
			}

    	}
    	catch(PDOException $e){
    		return "ERROR : ". $e->getMessage();

    	}
    } 

 /******************************/
	//Updating Teacher's Record
	/*****************************/

	function update_teacher_record($conn,$firstName,$lastName,$dob,$gender,$email,$phone,$degree,$salary,$address,$id,$father,$mother){
	try{
		
		$query = "UPDATE  teacher_table SET first_name = ?, last_name = ?, dob = ?, gender = ?, email = ?, phone = ?, degree = ?, salary = ?, address = ?,father=?,mother=? WHERE teacher_id ='$id'";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1, $firstName);
		$stmt->bindParam(2, $lastName);
		$stmt->bindParam(3, $dob);
		$stmt->bindParam(4, $gender);
		$stmt->bindParam(5, $email);
		$stmt->bindParam(6, $phone);
		$stmt->bindParam(7, $degree);
		$stmt->bindParam(8, $salary);
		$stmt->bindParam(9, $address);
		$stmt->bindParam(10, $father);
		$stmt->bindParam(11, $mother);
		if($stmt->execute()){
			$query="UPDATE structures SET Name= ? where user_id='$id'";
			$stmt = $conn->prepare($query);
			$name=$firstName." ".$lastName;
		    $stmt->bindParam(1,$name);
			if($stmt->execute()){
			return 1;
			die();
			}
			else{
				return 0;
			}
		}else{
			 return 0;
			
		}
	}
		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	 /*****************************/
	// Subject Entry
	/****************************/ 

	function subject_entry($conn,$subName,$teacher,$field,$semester){
	try{
		
		$query = "INSERT INTO subject_table SET subject_name=?, teacher_name = ?, COpt = ? , class =?";

		$entry = $conn->prepare($query);
		$entry->bindValue(1, $subName);
		$entry->bindValue(2, $teacher);
		$entry->bindValue(3, $field);
		$entry->bindValue(4, $semester);	
		if($entry->execute())
		{
			return  1;
			//die();
		}
		else{
			return 0;
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}


		/**********************/
		//Gettintg all subject
		/*********************/

function get_all_subject($conn,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  subject_no LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
		  /**********************/
		//Gettintg single subject
		/*********************/
		  function get_single_sub($conn,$table,$id){
	        try {
				$query = "SELECT * FROM {$table} WHERE subject_no= {$id}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }     

         /*****************************/
		//Delete Single Subject Record
		/****************************/
		  
		  function delete_sub($conn,$table,$id){

			try {
				$query = "DELETE  FROM {$table} WHERE subject_no={$id}";
					$stmt = $conn->prepare( $query );
					if($stmt->execute()){
						return 1;
					}
					else {
						return 0;
					}
					
			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	}

	 	/*****************************/
		//Update single Subject Record
		/****************************/

	function update_sub($conn,$subName,$teacher,$type,$class,$subnumber){
	try{
		
		$query = "UPDATE  subject_table SET subject_name = ?, teacher_name = ?, COpt = ?, class = ? WHERE subject_no = ?";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1, $subName);
		$stmt->bindParam(2, $teacher);
		$stmt->bindParam(3, $type);
		$stmt->bindParam(4, $class);
		$stmt->bindParam(5, $subnumber);
		if($stmt->execute()){
			$query="UPDATE subjects SET name= ? where ";
			return 1;
			die();
		}else{
			//die();
			//die("Unable to Update Record");
			 return 0;
			
		}
	}

		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	    /**********************/
		//Gettintg all semester
		/*********************/

function get_all_term($conn,$table,$limit){

			try {
				$query = "SELECT * FROM {$table} ORDER BY  semester_no LIMIT {$limit}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}

	      }
 
 	 /*****************************/
	// class Entry
	/****************************/ 

	function term_entry($conn,$semesterNo,$subject){
	try{
		
		$query = "INSERT INTO semester_table SET semester_no=?, subject = ?";

		$entry = $conn->prepare($query);
		$entry->bindValue(1, $semesterNo);
		$entry->bindValue(2, $subject);	
		if($entry->execute())
		{
			return "Successfully saved.";
			die();
		}
		else{
			return "Unable to save ! please try again.";
		}
	}

		catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}
	}

	    //###################
		// Get Single User ##
		//###################

	function get_single_user($conn,$table,$id)
	{
		
		try {

			$query = "SELECT * FROM {$table} WHERE id ={$id} ";
			$stmt = $conn->prepare($query);
			// $stmt->bindParam(1, $user_id);
			$stmt->execute();
			return $stmt->fetchAll();

			
		} catch (Exception $e) {
			return "Error : ". $e->getMessage();	
		}
	}
//####################
//Get User ##
//####################
 function get_user($conn,$table){
				
		try {

				$query = "SELECT * FROM {$table}";
					$stmt = $conn->prepare( $query );
					$stmt->execute();
					return $stmt->fetchAll();

			} catch (Exception $e) {
				return "ERROR". $e->getMessage();
			}



		catch(PDOException $exception){
			return "Error: " . $exception->getMessage();
		}
	}

	
 	}


      






