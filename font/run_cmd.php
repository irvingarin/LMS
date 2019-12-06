<?php session_start();
	include("conn.php");
	include("functions.php");
	if(isset($_POST['btnSignup'])){
		$idno = sanitize($_POST['txtid_no']);
		$fname = sanitize($_POST['txtfname']);
		$lname = sanitize($_POST['txtlname']);
		$mi = sanitize($_POST['txtmi']);
		$un = sanitize($_POST['txtusername']);
		$pw = sanitize($_POST['txtcpassword']);

		$lms_r = lms_register($idno, $fname, $lname, $mi, $un, $pw);

		if($lms_r==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Registration Successful </div></div>";
			header("Location: index.php");
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Registration Successful </div></div>";
			header("Location: index.php?do=register");
		}
	}
	if(isset($_POST['btnplogin'])){
		$un = $_POST['txtusername'];
		$pw = sanitize($_POST['txtpassword']);

		$au = authParent($un, $pw);
		$pr = mysql_fetch_object($au);
		if(mysql_num_rows($au)){
			$_SESSION['lms_parent_id'] = $pr->parent_id;
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Welcome $pr->fname </div></div>";
			header("Location: pdashboard.php");
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Incorrect Username or Password </div></div>";
			header("Location: index.php");

		}
	}
	if(isset($_POST['btnlogin'])){
		$uname = sanitize($_POST['txtusername']);
		$pw = sanitize($_POST['txtpassword']);

		$auth = authMember($uname,$pw);
		//$arr = mysql_fetch_array($auth);
		$count =mysql_num_rows($auth);

		if($count!=0){
			
			$g=mysql_fetch_object($auth);
			$_SESSION['lms_m_id']=$g->id;
			$_SESSION['lms_m_id_no']=$g->id_no;
			$acad = getActiveAcad();
			if(preg_match("/BAYA/", $g->id_no)){
				$_SESSION['lms_m_type']="Teacher";				
				$_SESSION['lms_acad_active'] = $acad;
			}else{
				$_SESSION['lms_m_type']="Student";
				$_SESSION['lms_acad_active'] = $acad;
			}
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Welcome $g->st_fname </div></div>";
			header("Location: dashboard.php");
			//echo strpos($g->id_no,"BAYA")." ".$g->id_no;
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Incorrect Username or Password </div></div>";
			header("Location: index.php");
		}
		
	}
	if(isset($_POST['btnCreate'])){
		
		$code = sanitize($_POST['txtclasscode']);
		$course = sanitize($_POST['txtcoursecode']);
		$cdesc = sanitize($_POST['txtdesc']);
		$id_no = $_SESSION['lms_m_id_no'];

		$c = createClass($code, $course, $cdesc,$id_no);
		if($c==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Class Created </div></div>";

		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add new Class </div></div>";
		}
		header("Location: dashboard.php");

	}

	if(isset($_POST['btnsave_module'])){
		$module = sanitize($_POST['txtmodulename']);
		$mod_desc = sanitize($_POST['txtmod_desc']);
		$gid = $_GET['c'];
		$fileName = $_FILES['file']['name'];
		$tmpName  = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileType = $_FILES['file']['type'];
		
		function getExtension($str) {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
			 }
			 
			 $extension = getExtension($fileName);
			 $extension = strtolower($extension);
			 $final_filename = time().".".$extension;
			 $folder_name = "class_".$gid;
			 if( !file_exists("classes/".$folder_name) ){
			 	mkdir("classes/".$folder_name);
			 }
			 
			$copied = move_uploaded_file($tmpName, "classes/".$folder_name."/". $final_filename)or die();

			$do = creatModule($gid,$module,$mod_desc,$final_filename);
			if($do==1){
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Materials Added </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add new Materials </div></div>";
			}
			$ftitle = "New Materials";
			$link = "?group=$gid&t=materials";
			$desc = "New Material added Please go and Check it out";
			$action = "Added";
			$feed = createFeed($ftitle,$link,$desc,$gid,$action);
			header("Location: dashboard.php?group=$gid&t=materials");


	}

	if(isset($_POST['btnSaveActivity'])){
		$name = sanitize($_POST['txtactname']);
		$desc = sanitize($_POST['txtactdesc']);
		$mod_id = $_GET['m'];
		$gid = $_GET['c'];
		$doInsert = creatExercise($mod_id, $name, $desc);
		if($doInsert!=0){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Exercise Added </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add new Activity </div></div>";
		}
			$ftitle = "New Activity";
			$link = "?group=$gid&t=exercises";
			$desc = "Your Teacher posted a new Activity";
			$action = "Posted";
			$feed = createFeed($ftitle,$link,$desc,$gid,$action);
		header("Location: dashboard.php?group=$gid&t=activities");
	}
	if(isset($_POST['btnUpdateActivity'])){
		$gid = $_GET['c'];
		$actid=$_POST['txtid'];
		$name = sanitize($_POST['txtactname']);
		$desc = sanitize($_POST['txtactdesc']);
		$u = updateActivity($actid, $name,$desc);
		if($u==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Activity Updated </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to update activity </div></div>";	
		}
		header("Location: dashboard.php?group=$gid&t=activities");
		// $mod_id = $_GET['m'];
		
	}
	if(isset($_POST['btnJoinClass'])){
		$lms_c_code = $_POST['txtcode'];
		$stud_no = $_SESSION['lms_m_id_no'];

		$j = joinMember($stud_no, $lms_c_code);

		if($j!=0){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> You Successfuly Joined </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to join </div></div>";
		}
		header("Location:dashboard.php");
	}

	if(isset($_POST['btn-importClass'])){

		$fi = basename($_FILES['txtfile']['name']);
		$tmpName  = $_FILES['txtfile']['tmp_name'];

		$nfilename = split(",",$fi);
		//index 0 = class_code
		//index 1 = subject code
		$nyear=str_replace(".csv", "", $nfilename[5]);


		$c = icreateClass($nfilename[0], $nfilename[1], $nfilename[2],$nyear,$nfilename[4],$_SESSION['lms_m_id_no']);
		if($c!="exist"){
			move_uploaded_file($_FILES['txtfile']['tmp_name'],"file/".$_FILES['txtfile']['name']);
			//$x = $_POST['txtlimit'];
			//$filename = "survey.csv";
			$handle = fopen("file/".$_FILES['txtfile']['name'], "r");
			//header("Content-Type: application/vnd.ms-excel");
			// header("Content-disposition: attachment; filename=export.xls");
			$flag = 0;
			while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
					$ns=splitName($data[0]);
					// lms_register($id_no, $fname, $lname, $mname, $uname, $pw)
					$chk = memberExist($data[1]);
					$i=true;
					if($chk==0){
						$i = lms_register($data[1], $ns[1], $ns[0],"", $data[1], $data[1]);
					}else{
						$i=true;
					}
					$join = joinImport($data[1],$c);
					if($i!=true){
						$flag=1;
					}
					// echo $ns[0];
	  		}
	  		if($flag==0){
  			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Import Successful </div></div>";
	  		}else{
	  			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Import Failed </div></div>";
	  		}
  		}else{
  			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Already Exist </div></div>";
  		}
  		

  		header("Location: dashboard.php");
	}

	function splitName($name){
		$n = split(",",$name);
		return $n;
	}

	if(isset($_POST['btnSaveAss'])){
		$c = sanitize($_GET['c']);
		$ass_t = sanitize($_POST['txtass']);
		$ass_d = sanitize($_POST['txtdesc']);
		$asstime = sanitize($_POST['txttime']);
		$ass_date = sanitize($_POST['txtend']);
		$id_no = $_SESSION['lms_m_id_no'];
		$final_filename="";
		$due = date("Y-m-d h:i:s", strtotime($ass_date.$asstime));
		$fileName = $_FILES['file']['name'];

		if($fileName!=""){
			$fileName = $_FILES['file']['name'];
			$tmpName  = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileType = $_FILES['file']['type'];
			
			function getExtension($str) {
						 $i = strrpos($str,".");
						 if (!$i) { return ""; }
						 $l = strlen($str) - $i;
						 $ext = substr($str,$i+1,$l);
						 return $ext;
				 }
				 
				 $extension = getExtension($fileName);
				 $extension = strtolower($extension);
				 $final_filename = time().".".$extension;
				 $folder_name = "class_".$c;
				 if( !file_exists("classes/".$folder_name) ){
				 	mkdir("classes/".$folder_name);
				 }

			
			$copied = move_uploaded_file($tmpName, "classes/".$folder_name."/". $final_filename)or die();
		}
		$n = newAssignment($c,$ass_t,$ass_d,$due,$id_no,"Active",$final_filename);
		

		if($n == true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Assignment added </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add Assignment </div></div>";
		}
			$ftitle = "New Assignment";
			$link = "?group=$c&t=assignments";
			$desc = "Your Teacher posted a new Assignments";
			$action = "Posted";
			$feed = createFeed($ftitle,$link,$desc,$c,$action);
		header("Location: dashboard.php?group=$c&t=assignments");
	}

	if(isset($_POST['btnUpdateAss'])){
		$c = sanitize($_GET['c']);
		$assid=$_POST['txtasid'];
		$ass_t = sanitize($_POST['txtass']);
		$ass_d = sanitize($_POST['txtdesc']);
		$asstime = sanitize($_POST['txttime']);
		$ass_date = sanitize($_POST['txtend']);
		$id_no = $_SESSION['lms_m_id_no'];
		$final_filename="";
		$due = date("Y-m-d h:i:s", strtotime($ass_date.$asstime));
		$fileName = $_FILES['file']['name'];
		if($fileName!=""){
			$fileName = $_FILES['file']['name'];
			$tmpName  = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileType = $_FILES['file']['type'];
			
			function getExtension($str) {
						 $i = strrpos($str,".");
						 if (!$i) { return ""; }
						 $l = strlen($str) - $i;
						 $ext = substr($str,$i+1,$l);
						 return $ext;
				 }
				 
				 $extension = getExtension($fileName);
				 $extension = strtolower($extension);
				 $final_filename = time().".".$extension;
				 $folder_name = "class_".$c;
				 if( !file_exists("classes/".$folder_name) ){
				 	mkdir("classes/".$folder_name);
				 }

			
			$copied = move_uploaded_file($tmpName, "classes/".$folder_name."/". $final_filename)or die();
		}
		// $n = newAssignment($c,$ass_t,$ass_d,$due,$id_no,"Active",$final_filename);
		$n = upAss($c,$ass_t,$ass_d,$due,$id_no,"Active",$final_filename,$assid);
		

		if($n == true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Assignment added </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add Assignment </div></div>";
		}
			// $ftitle = "New Assignment";
			// $link = "?group=$c&t=assignments";
			// $desc = "Your Teacher posted a new Assignments";
			// $action = "Posted";
			// $feed = createFeed($ftitle,$link,$desc,$c,$action);
		header("Location: dashboard.php?group=$c&t=assignments");
	}

	if(isset($_POST["btnSubmitAss"])){
		$a = $_GET['a'];
		$c = $_GET['c'];
		$idno = $_SESSION['lms_m_id_no'];
		$fileName = $_FILES['file']['name'];
		$tmpName  = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileType = $_FILES['file']['type'];

		function getExtension($str) {
					 $i = strrpos($str,".");
					 if (!$i) { return ""; }
					 $l = strlen($str) - $i;
					 $ext = substr($str,$i+1,$l);
					 return $ext;
			 }

			 $extension = getExtension($fileName);
			 $extension = strtolower($extension);
			 $final_filename = time().".".$extension;
			 $folder_name = "ass_".$a;
			 if( !file_exists("classes/".$folder_name) ){
			 	mkdir("classes/".$folder_name);
			 }
			 
			$copied = move_uploaded_file($tmpName, "classes/".$folder_name."/". $final_filename)or die();

			$i = saveSubmision($a,$idno,$final_filename);
			if($i==true){
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Submision Succesful </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Submision failed </div></div>";
			}
			$ftitle = "Assigment";
			$link = "";
			$desc = "You have submited an assigment";
			$action = "Submit";
			$feed = createFeed($ftitle,$link,$desc,$c,$action);
			header("Location: dashboard.php?group=$c&t=assignments");
	}

	if(isset($_POST['btnCreateQuiz'])){
		$idno = $_SESSION['lms_m_id_no'];
		$class_id = $_GET['c'];
		$quiz_title = sanitize($_POST['txtquiz_title']);
		$limit = sanitize($_POST['txtduration']);
		$duedate = sanitize($_POST['txtendate']);

		$create = create_Quiz($idno, $class_id,$quiz_title,$limit,$duedate);

		if($create>0){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Submision Succesful </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Submision failed </div></div>";
		}
		header("Location: dashboard.php?group=$class_id&t=quiz&qid=$create");
	}

	if(isset($_POST['btnSaveQuestion'])){
		$op = array();
		$c = $_GET['c'];
		$qid = $_GET['qid'];
		$question = sanitize($_POST['txtquestion']);
		$type = $_POST['txttype'];
		$ans = sanitize($_POST['txtans']);
		if($type=="multi"){
			$op = $_POST['txtop'];
		}
		$suc = newQuestion($qid,$type,$op,$question,$ans);
		if($suc==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Question Added </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to add Question </div></div>";
		}
		header("Location: dashboard.php?group=$c&t=quiz&qid=$qid");
	}

	if(isset($_POST['btnUpdateQuestion'])){
		$op = array();
		$c = $_GET['c'];
		$qid = $_GET['qid'];
		$ques_id=$_POST['txtquesid'];
		$question = sanitize($_POST['txtquestion']);
		$type = $_POST['txttype'];
		$ans = sanitize($_POST['txtans']);
		if($type=="multi"){
			$op = $_POST['txtop'];
		}
		// $suc = newQuestion($qid,$type,$op,$question,$ans);
		$suc = updateQuestions($qid,$ques_id,$type,$choice,$question,$ans);
		if($suc==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Question has been updated </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to Update Question </div></div>";
		}
		header("Location: dashboard.php?group=$c&t=quiz&qid=$qid");
	}

	if(isset($_POST['btnConfirm'])){
		$c=$_GET['c'];
		$qid = $_GET['qid'];
		// echo $_POST['txtmode'];
		if($_POST['txtmode']=="question"){

			$ques_id = $_POST['txtques'];

			$d = removeQuestion($ques_id);
			if($d==true){
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Question has been deleted </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to delete question </div></div>";
			}
			header("Location: dashboard.php?group=$c&t=quiz&qid=$qid");
		}
		if($_POST['txtmode']=="assignment"){
			$ques_id = $_POST['txtques'];
			$da = deleteAss($ques_id);
			// echo "$ques_id";
			if($da==true){
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Assignment has been deleted </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to delete Assignment </div></div>";
			}
			header("Location: dashboard.php?group=$c&t=assignments");
		}
	}

	if(isset($_POST['btnSubmitAns'])){
		$answer=array();
		$c = $_GET['c'];
		$qid = $_GET['qid'];
		$quesid=$_POST['txtqid'];
		
		foreach ($quesid as &$id) {
			$n="txtans".$id;
			$ans = $_POST[$n];
			//echo $ans;
			array_push($answer, $ans);

		}

		//print_r($ans);
		
		
		$idno = $_SESSION['lms_m_id_no'];
		$stat = "";
		// print_r($quesid);
		// echo "<br />";
		// print_r($answer);
		$save = saveAnser($quesid,$idno,$answer,$qid);

		if($save==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Quiz Recorded </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to record quiz </div></div>";
		}
			$ftitle = "Quiz";
			$link = "";
			$desc = "You have finalize and submited your answer";
			$action = "Submit";
			$feed = createFeed($ftitle,$link,$desc,$c,$action);
		header("Location: dashboard.php?group=$c&t=quiz&qid=$qid");
	}	

	if(isset($_GET['post'])){
		$qid = $_GET['qid'];
		$c = $_GET['group'];
		$stat = "";
		if($_GET['post']=="true"){
			$stat ="Active";
		}else{
			$stat = "Inactive";
		}
		$u = activateQuiz($qid,$stat);
		if($u==true){
			$ftitle = "New Quiz";
			$link = "?group=$c&t=quiz";
			$desc = "Your Teacher posted a new Quiz";
			$action = "Posted";
			$feed = createFeed($ftitle,$link,$desc,$c,$action);
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Quiz has been posted </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed post quiz </div></div>";
		}
		
		header("Location: dashboard.php?group=$c&t=quiz");
	}

	if(isset($_POST['btn-saveChild'])){
		$st = sanitize($_POST['txtstno']);
		$p = sanitize($_GET['p']);
		$s = verifyChild($st,$p);
		if($s == 0){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Not your child. <i>He/She did not add you as guardian/parent</i> </div></div>";
		}else{
		$a = adChild($st,$p);

			if($a == true){
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Added </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed </div></div>";
			}
		}
		header("Location: pdashboard.php");
	}
	if(isset($_POST['btnShare'])){
		$st = $_POST['shareto'];
		$oid = $_SESSION['lms_m_id_no'];
		$mid = $_POST['txtmid'];
		$eflag = 0;
		// print_r($st);
		foreach ($st as $val) {
			$ishare = shareIt($oid, $val, $mid);
			if($ishare==true){
				$eflag = 0;
			}else{
				$eflag=1;
			}
			//echo $val;
		}
		if($eflag==0){
			
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Shared </div></div>";
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed </div></div>";
			}
		
		header("Location: dashboard.php?d=d&tt=library");

	}

	if(isset($_POST['btnChange'])){
		$user = $_SESSION['lms_m_id_no'];
		$pw = sanitize($_POST['txtpass']);
		if(chkPassword($pw, $user)==true){
			$npw = sanitize($_POST['txtnpass']);
			$cpw = sanitize($_POST['txtcpass']);	

			if($npw==$cpw){
				$dc = changePass($cpw, $user);
				//echo $dc;
				if($dc==true){
					$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Password Changed</div></div>";
				}else{
					$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed change password</div></div>";
				}
			}else{
				$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Password di not match. </div></div>";
			}
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i>Current Password is Incorrect </div></div>";

		}
		
		header("Location: dashboard.php?s=settings&k=password");


	}

	if(isset($_POST['btnNguard'])){
		$fname = sanitize($_POST['txtfname']);
		$mname = sanitize($_POST['txtmname']);
		$lname = sanitize($_POST['txtlname']);

		$add = addGuardians($fname, $lname, $mname, $_SESSION['lms_m_id_no']);
		if($add==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> New Guardian added </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to Add Guardian </div></div>";
		}
		header("Location: dashboard.php?s=settings&k=guardians");
	}

	if(isset($_POST['btnUguard'])){
		$fname = sanitize($_POST['txtfname']);
		$mname = sanitize($_POST['txtmname']);
		$lname = sanitize($_POST['txtlname']);
		$id = $_POST['id'];

		$gu = updateGuardian($fname, $lname, $mname, $id);
		if($gu==true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Guardian has been updated </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-warning'> <i class='fa fa-warning fa-fw'></i> Failed to Update Guardian </div></div>";
		}
		header("Location: dashboard.php?s=settings&k=guardians");
	}

	if(isset($_GET['modid'])){
		$modid = $_GET['modid'];
		$mode = $_GET['mp'];
		$stat = "";
		$mm = "";
		if($mode=='publish'){
			$stat = "Active";
			$mm = "Published";
		}else{
			$stat = "Inactive";
			$mm = "Unpublished";
		}
		$mp = publishMod($modid, $stat);
		if($mp == true){
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> Materials has been $mm  </div></div>";
		}else{
			$_SESSION['notif']="<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-danger'> <i class='fa fa-info fa-fw'></i> Materials has been $mm </div></div>";
		}
		header("Location: dashboard.php?d=d&tt=library");

	}

?>