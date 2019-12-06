<?php 
	$ggg = "";
	function getActiveMision($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_settings WHERE status='Active'")or die(mysqli_error());
		return $s;
	}
	function sanitize($text) {
		  $text = htmlspecialchars($text, ENT_QUOTES);
		  $text = str_replace("\n\r","\n",$text);
		  $text = str_replace("\r\n","\n",$text);
		  $text = str_replace("\n","<br>",$text);
		  return $text;
	}

	function getCurrentUser($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no='$id_no'")or die(mysql_error());
		$c = mysqli_fetch_object($s);
		return $c;
	}
	function getCurrentUserParent($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_parents WHERE parent_id='$id_no'")or die(mysqli_error());
		$c = mysqli_fetch_object($s);
		return $c;
	}

	function createFeed($title,$link,$desc,$clas_id,$action,$conn){
		$c = mysqli_query($conn,"INSERT into lms_feed VALUES('','$title','$link','$desc',now(),'$clas_id','$action','".$_SESSION['lms_m_id_no']."')")or die(mysql_error());
		return $c;
	}


	function getfeed($gid,$id_no,$conn){
		$sfeed = mysqli_query($conn,"SELECT * FROM lms_feed WHERE feed_group in (SELECT class_id from lms_class_member WHERE id_no='$id_no') order by id desc");
		return $sfeed;
	}
	function getmyfeed($id_no,$conn){
		$f = mysqli_query($conn,"SELECT * FROM lms_feed WHERE id_no='$id_no' order by date_added desc");
		return $f;
	}

	function upcommingEvents($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_events WHERE (event_start >= now()) order by event_start")or die(mysql_error());
		return $s;
	}

	function get_AllMembers($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members");
		return $s;
	}
	function getMemberByid_no($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no like '%$id_no%'")or die(mysql_error());
		return $s;
	}
	function getMemberByid_noT($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no = '$id_no'")or die(mysql_error());
		return $s;
	}



	function getMemeByID($idno,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no like '%$idno%'");
		return $s;
	}
	
	function errorLog($elogs,$uid,$conn){
		$l=sanitize($elogs);
		$i = mysqli_query($conn,"INSERT into errorlogs values('','$l',now(),'$uid')")or die(mysql_error());
		return $i;
	}

	function lms_register($id_no, $fname, $lname, $mname, $uname, $pw,$conn){
		$r = mysqli_query($conn,"INSERT into lms_members values('','$id_no','$fname','$lname','$mname','$uname','$pw','default.png','Active')")or die(mysql_error());
		return $r;
	}

	function memberExist($id_no,$conn){
		$s = mysqli_query($conn,"SELECT count(*) d from lms_members WHERE id_no='$id_no'");
		$r = mysql_fetch_object($s);
		return $r->d;
	}
	function authParent($usn, $pws,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_parents WHERE username='$usn' and password='$pws'");
		return $s;
	}
	function authMember($usn,$pws,$conn){
		$r="";
		if((preg_match("/BAYA/", $usn)) or (preg_match("/BGU/", $usn))){
			$r = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no='$usn' and st_password='$pws' and status='Active'")or die(mysql_error());
			
		}else{
			
			$r = mysqli_query($conn,"SELECT * FROM lms_members WHERE st_username='$usn' and st_password='$pws' and status='Active'")or die(mysql_error());
		}
		return $r;
	}

	function createClass($class_code, $subject_code, $subject_desc,$id_no,$conn){
		$sc_code = mt_rand(1000,100000);
		$acad = getActiveAcad($conn);
		$i = mysqli_query($conn,"INSERT into lms_class values('','$class_code', '$subject_code', '$subject_desc', '$sc_code', '$id_no','$acad')");
		return $i;
	}
	function getActiveAcad($conn){
		$s = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM lms_acad_settings WHERE status='Active'"));
		return $s->acad_id;
	}
	function getActiveAcadByid($acadid,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_acad_settings WHERE acad_id='$acadid'");
		return $s;
	}

	function getActiveAcadYear(){
		$s = mmysql_query("SELECT * FROM lms_acad_settings WHERE status='Active'");
		return $s;
	}



	function icreateClass($class_code, $subject_code, $subject_desc,$year,$dept,$id_no,$conn){
		$sc_code = mt_rand(1000,100000);
		$acadid = getActiveAcad($conn);
		$s = ifClassExist($class_code, $subject_code, $subject_desc,$year,$dept,$id_no);
		if(mysql_num_rows($s)==0){
		$i = mysqli_query($conn,"INSERT into lms_class values('','$class_code', '$subject_code', '$subject_desc','$year','$dept' ,'$sc_code', '$id_no','$acadid')");
			return mysqli_insert_id();
		}else{
			return "exist";
		}
	}

	function ifClassExist($class_code, $subject_code, $subject_desc,$year,$dept,$id_no){
		$chk = mysql_query("SELECT * FROM lms_class WHERE class_code='$class_code' and subject_code='$subject_code' and subject_desc='$subject_desc'and year_lvl='$year' and id_no='$id_no'");
		return mysql_num_rows($chk);
	}

	function getClasses($id_no,$conn){
		$acadid = getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE id_no='$id_no' and acad_id='$acadid'");
		return $s;
	}

	function getFacSameCsub($class_id){
		$m = mysql_fetch_object(class_by_id($class_id));
		$acadid = getActiveAcad($conn);
		// $s = mysql_query("SELECT * FROM lms_members WHERE id_no in (SELECT id_no FROM lms_class WHERE (subject_code='$m->subject_code' and acad_id='$acadid')  and (id_no != '".$_SESSION['lms_m_id_no']."'))");
		// select * from lms_members where id_no in (SELECT id_no from lms_class where subject_code='IT 214' AND acad_id='2' and id_no !='BAYA-00211')
		$s = mysql_query("SELECT * from lms_members where id_no in (SELECT id_no from lms_class where subject_code='$m->subject_code' AND acad_id='$acadid' and id_no !='".$_SESSION['lms_m_id_no']."')");
		return $s;
	}

	function shareIt($id_no, $sto, $mat_id,$conn){
		$s = mysqli_query($conn,"INSERT into shared_materials VALUES('','$id_no','$sto','$mat_id','Shared')");
		return $s;
	}

	function getShared($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM shared_materials WHERE shared_to='All' or shared_to='$id_no'")or die(mysql_error());
		return $s;
	}



	function class_by_id($classid,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE class_id='$classid'");
		return $s;
	}

	function getMyClass($id_no,$conn){
		$acadid = getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE class_id in (SELECT class_id FROM lms_class_member WHERE id_no='$id_no') and acad_id='$acadid'");
		return $s;
	}

	function getMyChildClass($parent_id,$conn){
		$acadid = getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE class_id in (SELECT class_id FROM lms_class_member WHERE id_no in (SELECT id_no FROM lms_child WHERE parent_id='$parent_id')) and acad_id='$acadid'");
		return $s;
	}
	function getSubClasses($id_no,$conn){
		$acadid = getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE id_no in(SELECT awol_id FROM lms_sub where id_no='$id_no') and acad_id='$acadid'");
		return $s;	
	}
	function getClassbyID($group_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE class_id='$group_id'");
		return $s;
	}


	function getClassMembers($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members INNER JOIN lms_class_member on lms_members.id_no = lms_class_member.id_no WHERE class_id='$class_id' order by st_lname");
		return $s;
	}


	function joinImport($stud_no,$cid,$conn){
		$i = mysqli_query($conn,"INSERT into lms_class_member values('','$cid','$stud_no',now())") or die(mysql_error());
		return $i;
	}

	function joinMember($stud_no, $code,$conn){
		$cid = authCode($code,$conn);
		$i = mysqli_query($conn,"INSERT into lms_class_member values('','$cid','$stud_no',now())") or die(mysql_error());
		return $i;
	}

	function authCode($code,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE security_code='$code'");
		$r = mysqli_fetch_object($s);
		return $r->class_id;
	}


	function activityLog($actions, $pg, $id_no,$conn){
		$i = mysqli_query($conn,"INSERT into activity_log values('','$actions','$pg',now(),'$id_no')");
		return $i;
	}

	function creatModule($class_id,$title,$descr,$filename,$conn){
		$i = mysqli_query($conn,"INSERT INTO class_modules VALUES('','$class_id','$title','$descr','$filename', now(),0,'Inactive')");
		return $i;
	}
	function getModules($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM class_modules WHERE class_id='$class_id' and status='Active'");
		return $s;
	}
	// function getModules1($class_id){
	// 	$s = mysql_query("SELECT * FROM class_modules WHERE class_id='$class_id'");
	// 	return $s;
	// }
	function getAllModules($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM class_modules WHERE class_id in (SELECT class_id FROM lms_class WHERE id_no='$id_no') and status='Active'");
		return $s;
	}
	function getAllModules1($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM class_modules WHERE class_id in (SELECT class_id FROM lms_class WHERE id_no='$id_no')");
		return $s;
	}
	function viewModule($mod_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM class_modules WHERE mod_id='$mod_id' status='Active'");
		$r = mysqli_fetch_object($s);
		return $r;
	}
	function getSharedModule($mod_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM class_modules WHERE mod_id='$mod_id'");
		// $r = mysql_fetch_object($s);
		return $s;
	}
	function viewPlusOne($mod_id,$conn){
		$u = mysqli_query($conn,"UPDATE class_modules set views=views+1 WHERE mod_id='$mod_id'") or die(mysql_error());
		return $u;
	}

	function publishMod($mod_id, $stat,$conn){
		$u = mysqli_query($conn,"UPDATE class_modules set status='$stat' WHERE mod_id='$mod_id'");
		return $u;
	}
	function creatExercise($mod_id, $title, $desc, $conn){
		$i = mysqli_query($conn,"INSERT INTO lms_mod_activities VALUES('','$mod_id','$title','$desc',now())");
		return $i;
	}
	function getActivities($mod_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_mod_activities WHERE mod_id='$mod_id'");
		return $s;
	}
	function getOneActivity($act_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_mod_activities WHERE mod_ac_id='$act_id'");
		return $s;
	}
	function updateActivity($act_id, $title,$desc,$conn){
		$s = mysqli_query($conn,"UPDATE lms_mod_activities set act_title='$title', activities_desc='$desc' WHERE mod_ac_id='$act_id'");
		return $s;
	}
	function gerAllColors($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_color");
		return $s;
	}


	function saveExercise($mod_act_id,$id_no,$filename,$filepath,$conn){
		$d = checkExist($mod_act_id,$id_no,$conn);
		$i=0;
		if(mysqli_num_rows($d)==0){
			$i = mysqli_query($conn,"INSERT into lms_exercise_file values('','$mod_act_id','$id_no','$filename',now(),0,'$filepath')");
		}else{
			$i=1;
		}
		return $i;
	}

	function checkExist($aid,$id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_exercise_file WHERE mod_ac_id='$aid' and id_no='$id_no'");
		return $s;
	}

	function getExcerciseList($mod_act_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_exercise_file inner join lms_members on lms_exercise_file.id_no = lms_members.id_no WHERE mod_act_id='$mod_act_id'")or die(mysql_error());
		return $s;
	}

	function display_classes($id_no,$conn){
		$c = getClasses($id_no,$conn);
		if(mysqli_num_rows($c)==0){
			echo "<li class='list-group-item text-danger'>No Records Found</li>";
		}else{
			while($rw = mysqli_fetch_object($c)){
				echo "<li class='list-group-item'><a href='?group=$rw->class_id' class='class-li g$rw->class_id' data-activity='Open class $rw->class_id'>$rw->subject_code $rw->year_lvl</a></li>";
			}	
		}
	}
	function display_sub_classes($id_no,$conn){
		$c = getSubClasses($id_no,$conn);
		if(mysqli_num_rows($c)==0){
			echo "";
			// echo "<li class='list-group-item text-danger'>No Records Found</li>";
		}else{
			while($rw = mysqli_fetch_object($c)){
				echo "<li class='list-group-item'><a href='?group=$rw->class_id' class='class-li g$rw->class_id' data-activity='Open class $rw->class_id'>$rw->subject_code</a></li>";
			}	
		}
	}
	
	function display_My_classes($id_no,$conn){
		$c = getMyClass($id_no,$conn);
		if(mysqli_num_rows($c)==0){
			echo "<li class=' list-group-item text-danger'>No Records Found</li>";
		}else{
			while($rw = mysqli_fetch_object($c)){
				echo "<li class='list-group-item'><a href='?group=$rw->class_id' class='class-li g$rw->class_id' data-activity='Open class $rw->class_id'>$rw->subject_code $rw->year_lvl</a></li>";
			}	
		}
	}
	function display_MyChild_classes($parent_id){
		$c = getMyChildClass($parent_id);
		if(mysql_num_rows($c)==0){
			echo "<li class=' list-group-item text-danger'>No Records Found</li>";
		}else{
			while($rw = mysql_fetch_object($c)){
				echo "<li class='list-group-item'><a href='?group=$rw->class_id' class='class-li g$rw->class_id' data-activity='Open class $rw->class_id'>$rw->subject_code</a></li>";
			}	
		}
	}

	function display_my_child($parent_id,$conn){
		$s = getChild($parent_id,$conn);
		if(mysqli_num_rows($s)==0){
			echo "<li class=' list-group-item text-danger'>No Records Found</li>";
		}else{
			while($sr = mysqli_fetch_object($s)){
				echo "<li class='list-group-item'><a href='?ch=$sr->id_no' class='class-li g$sr->id_no' data-activity='Open Child details $sr->id_no'>$sr->st_fname</a></li>";
			}	
		}
	}

	function getChild($parent_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no in (SELECT id_no FROM lms_child WHERE parent_id='$parent_id')");
		return $s;
	}

	function newAssignment($class_id,$ass_t,$ass_d,$end_t,$id_no,$stat,$filename,$conn){
		$n = mysqli_query($conn,"INSERT into lms_assignment VALUES ('','$class_id','$ass_t','$ass_d',now(),'$end_t','$id_no','$stat','$filename')")or die(mysql_error());
		return $n;
	}

	function getAllAss($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_assignment WHERE class_id='$class_id' and status='Active' order by date_added desc");
		return $s;
	}

	function upAss($class_id,$ass_t,$ass_d,$end_t,$id_no,$stat,$filename,$ass_id,$conn){
		$s = mysqli_query($conn,"UPDATE lms_assignment set ass_title='$ass_t', ass_desc='$ass_d', end_time='$end_t', filename='$filename' WHERE ass_id='$ass_id'")or die(mysql_error());
		return $s;
	}
	function deleteAss($ass_id,$conn){
		$s = mysqli_query($conn,"DELETE from lms_assignment WHERE ass_id='$ass_id'")or die(mysql_error());
		return $s;
	}

	function getAssbyID($ass_id){
		$s = mysql_query("SELECT * FROM lms_assignment WHERE ass_id='$ass_id'");
		return $s;
	}

	function getAllSubmisions($ass_id){
		$s = mysql_query("SELECT * FROM lms_ass_sub WHERE ass_id='$ass_id'");
		return $s;
	}
	function getAllMyAssignment($ass_id,$id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_ass_sub WHERE ass_id='$ass_id' and id_no='$id_no'");
		return $s;
	}
	

	function saveSubmision($a,$idno, $file,$conn){
		$i = mysqli_query($conn,"INSERT into lms_ass_sub VALUES ('','$a','$idno','$file','Active',now())");
		return $i;
	}

	function create_Quiz($idno, $class_id,$quiz_title,$limit,$duedate,$conn){
		$i = mysqli_query($conn,"INSERT into lms_quiz VALUES('','$idno','$class_id','$quiz_title',now(),'$limit','Inactive','0','$duedate')");
		return mysqli_insert_id();
	}

	function activateQuiz($quiz_id,$stat,$conn){
		$s = mysqli_query($conn,"UPDATE lms_quiz set status='$stat' WHERE quiz_id='$quiz_id'")or die(mysql_error());
		return $s;
	}

	function getQuiz($qid,$conn){
		$q = mysqli_query($conn,"SELECT * FROM lms_quiz WHERE quiz_id='$qid'");
		return $q;
	}

	function allQuiz($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_quiz WHERE class_id='$class_id'");
		return $s;
	}
	function allQuizStudent($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_quiz WHERE class_id='$class_id' and status='Active' order by quiz_id desc");
		return $s;
	}



	// Add Questions
	function newQuestion($qid,$type,$choice,$question,$ans,$conn){
		$i = mysqli_query($conn,"INSERT into lms_quiz_questions VALUES('','$qid','$type','$question')");
		$ques_id = mysql_insert_id();
		$k = createKey($ques_id,$ans,$conn);
		if($type=="multi"){
			$op = "A";
			foreach ($choice as &$value) {
				$c=addChoices($ques_id,$op,sanitize($value),$conn);
				$op++;
			}
		}
		return $k;
	}

	function addChoices($qid,$op,$choice,$conn){
		$i = mysqli_query($conn,"INSERT into lms_choices VALUES ('','$qid','$op','$choice')")or die(mysql_error());
		return $i;
	}

	function createKey($qid,$ans,$conn){
		$i = mysqli_query($conn,"INSERT into lms_key_ans VALUES('','$qid','$ans')");
		return $i;
	}
	//end Add Questions

	function updateQuestions($qid,$ques_id,$type,$choice,$question,$ans,$conn){
		$u = mysqli_fetch_object(mysqli_query($conn,"UPDATE lms_quiz_questions set q_type='$type', question='$question' WHERE question_id='$ques_id'"));
		$gc = getChoises($ques_id,$conn);
		$ukey = updateKey($ques_id,$ans,$conn);
		$x=0;
		if($type=="multi"){
			while($gcr = mysqli_fetch_object($gc)){
				$uc=updateChoices($ques_id,"",$choice[0],$gc->choice_id);
				$x++;
			}
		}

		return $ukey;
	}

	function updateChoices($ques_id,$op,$choice,$choice_id,$conn){
		$sr=mysqli_fetch_object(getChoisesById($choice_id,$conn));
		$update = mysqli_query($conn,"UPDATE lms_choices SET lms_choices='$choice' WHERE choice_id='$choice'");
		return $update;
	}

	function updateKey($ques_id,$ans,$conn){
		$uk = mysqli_query($conn,"UPDATE lms_key_ans SET question_ans='$ans' WHERE question_id='$ques_id'");
		return $uk;
	}

	function getQuestions($qid,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_quiz_questions WHERE quiz_id='$qid' order by rand()");
		return $s;
	}

	function getQuestionByID($ques_id){
		$s = mysqli_query($conn,"SELECT * FROM lms_quiz_questions WHERE question_id='$ques_id'")or die(mysql_error());
		return $s;
	}

	function removeQuestion($ques_id,$conn){
		$dq = mysqli_query($conn,"DELETE  From lms_quiz_questions WHERE question_id='$ques_id'")or die(mysql_error());
		$dc = mysqli_query($conn,"DELETE  From lms_choices WHERE question_id='$ques_id'")or die(mysql_error());
		$da = mysqli_query($conn,"DELETE  From lms_key_ans WHERE question_id='$ques_id'")or die(mysql_error());
		return $da;
	}
	function getChoises($ques_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_choices WHERE question_id='$ques_id'");
		return $s;
	}
	function getChoisesById($choice_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_choices WHERE question_id='$choice_id'");
		return $s;
	}

	function getKey($ques_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_key_ans WHERE question_id='$ques_id'");
		return $s;
	}

	function checkIfCorrect($qid,$ans,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_key_ans WHERE question_id='$qid' and question_ans='$ans'");
		if(mysqli_num_rows($s)!=0){
			return "Correct";
		}else{
			return "Incorrect";
		}
	}

	function saveAnser($qid,$idno,$ans,$quiz_id,$conn){
		$x = 0;
		$flag = 1;
		foreach ($qid as &$quesid){
			$stat = checkIfCorrect($quesid,$ans[$x],$conn);
			$i = mysqli_query($conn,"INSERT into lms_student_quiz VALUES ('','$idno','$quesid','".sanitize($ans[$x])."',now(),'$stat','$quiz_id')");
			$x++;
			if($i==false){
				$flag=0;
			}
		}
		return $flag;
	}

	function coutCorrect($quiz_id, $idno,$conn){
		$s = mysqli_query($conn,"SELECT count(*) correct FROM lms_student_quiz WHERE id_no='$idno' and quiz_id='$quiz_id' and status='Correct'");
		$r = mysqli_fetch_object($s);
		return $r->correct;
	}

	function alreadyExam($quiz_id, $idno,$conn){
		$chk = mysqli_query($conn,"SELECT * FROM lms_student_quiz WHERE id_no='$idno' and quiz_id='$quiz_id'");
		return $chk;
	}

	function getQuizResult($quiz_id, $idno,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_student_quiz inner join lms_quiz_questions on lms_student_quiz.question_id=lms_quiz_questions.question_id WHERE lms_quiz_questions.quiz_id='$quiz_id' and id_no='$idno'" ) or die(mysql_error());
		return $s;
	}
	function getQuizResultT($quiz_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_student_quiz inner join lms_quiz_questions on lms_student_quiz.question_id=lms_quiz_questions.question_id WHERE lms_quiz_questions.quiz_id='$quiz_id' group by id_no" ) or die(mysql_error());
		return $s;
	}
	function getKeyByQ($ques_id,$ans,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_choices WHERE question_id='$ques_id' and choice_letter='$ans'");
		if(mysqli_num_rows($s)>0){
		$sr = mysqli_fetch_object($s);
		return $sr->choice_letter." (".$sr->choices.")";
		}
	}
	function adChild($stno,$pid,$conn){
		$i = mysqli_query($conn,"INSERT into lms_child values('','$stno','$pid')");
		return $i;
	}

	function countAssignment($class_id,$conn){
			$s = mysqli_query($conn,"SELECT * FROM lms_assignment WHERE class_id='$class_id'");
			return $s;
	}

	function displayTotalAssPerClass($class_id,$conn){
		$t = countAssignment($class_id,$conn);
		$tot = mysqli_num_rows($t);
		return $tot;
	}
	function countSubmitted($class_id,$conn){
		$s = mysqli_query($conn,"SELECT count(*) total FROM `lms_assignment` where ass_id in (SELECT ass_id from lms_ass_sub) and class_id='$class_id' ");
		$sr = mysqli_fetch_object($s);
		return $sr->total;
	}

	function countQuiz($class_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_quiz WHERE class_id='$class_id' and status='Active'");
		return $s;
	}
	function countQItems($qid,$conn){
		$r = getQuestions($qid,$conn);
		return mysqli_num_rows($r);
	}
	function countQuizTaken($class_id,$conn){
		$s = mysqli_query($conn,"SELECT count(*) total FROM `lms_quiz` WHERE quiz_id in (SELECT quiz_id from lms_student_quiz) and class_id='$class_id' and status='Active'");
		$sr = mysqli_fetch_object($s);
		return $sr->total;
	}
	function allQuizByStudent($id_no,$class_id,$conn){
		 $s = mysqli_query($conn,"SELECT * FROM lms_quiz WHERE class_id='$class_id'");
		 return $s;
	}

	function chkPassword($pw, $id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_members	WHERE id_no='$id_no'");
		return mysqli_num_rows($s);
	}

	function changePass($pws, $id_no,$conn){
		$c = mysqli_query($conn,"UPDATE lms_members set st_password='$pws' WHERE id_no='$id_no'")or die(mysql_error());
		return $c;
	}

	function getGuardians($id_no,$conn){
		$s = mysqli_query($conn,"SELECT * FROM guardians WHERE id_no='$id_no'");
		return $s;
	}
	function getGuardiansID($gid,$conn){
		$s = mysqli_query($conn,"SELECT * FROM guardians WHERE gid='$gid'");
		return $s;
	}
	function addGuardians($fname, $lname, $mname, $id_no,$conn){
		$a = mysqli_query($conn,"INSERT into guardians VALUES('','$fname','$lname','$mname','Active','$id_no')");
		return $a;
	}
	function updateGuardian($fname, $lname, $mname, $gid,$conn){
		$a = mysqli_query($conn,"UPDATE guardians SET fname='$fname', lname='$lname', mname='$mname' WHERE gid='$gid'");
		return $a;
	}

	function verifyChild($id_no,$parentID,$conn){
		$sp = mysqli_fetch_object(mysqli_query($conn,"SELECT concat(fname, lname) name FROM lms_parents WHERE parent_id='$parentID'"));
		$s = mysqli_query($conn,"SELECT * FROM guardians WHERE id_no='$id_no' and concat(fname, lname)='$sp->name'");
		return mysqli_num_rows($s);
	}


	// function verifyGuardian(){

	// }

	// function getChilds($pid){
	// 	$s = mysql_query("SELECT * FROM lms_child WHERE parent_id='$pid'");
	// 	return $s;
	// }
?>
