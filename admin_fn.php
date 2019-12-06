<?php
	function shorten($str, $ln){
		$out = strlen($str) > $ln ? substr($str,0,$ln)."..." : $str;
		return $out;
	} 
	function inLmsSettings($mission, $vission, $objectives,$conn){
		$s = mysqli_query($conn,"INSERT into lms_settings VALUES('','$mission','$vission','$objectives','Active')");
		return $s;
	}
	function editSettings($set_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_settings WHERE setting_id='$set_id'");
		return $s;
	}
	function removeSettings($set_id,$conn){
		$d = mysqli_query($conn,"DELETE FROM lms_settings WHERE setting_id='$set_id'");
		return $d;
	}
	function activeSettings($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_settings WHERE status='Active'");
		return $s;
	}
	function updateSettings($mission, $vission, $objectives, $set_id,$conn){
		$u = mysqli_query($conn,"UPDATE lms_settings set lms_mission='$mission', lms_vision='$vission', lms_objectives='$objectives' WHERE setting_id='$set_id'") or die(mysql_error());
		return $u;
	}
	// function removeSettings($set_id){
	// 	$r = mysql_query("DELETE from lms_settings WHERE setting_id='$set_id'");
	// 	return $r;
	// }
	function lms_insert($tbl,$values){
		$i = mysql_query("INSERT into $tbl values ($values)");
		return $i;
	}

	function inProgram($p,$d,$conn){
		$i = mysqli_query($conn,"INSERT into lms_programs values('','$p','$d','Active')");
		return $i;
	}
	function programbyid($p_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_programs WHERE prog_id='$p_id'");
		return $s;
	}
	function upProgram($p_id, $prog, $desc,$conn){
		// $c=ifExistP($prog, $desc);

		// if($c==0){
			// $u = mysql_query("UPDATE lms_programs set program='$prog', description='$desc' WHERE prog_id='$p_id'");
			$u = mysqli_query($conn,"UPDATE lms_programs set description='$desc' WHERE prog_id='$p_id'");
			return $u;
		// }else{
		// 	return "exist";
		// }	
	}

	function delProgram($p_id,$conn){
		$d = mysqli_query($conn,"DELETE  FROM lms_programs WHERE prog_id='$p_id'") or die(mysql_error());
		return $d;
	}

	function ifExistP($prog, $desc,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_programs WHERE program='$prog' and description='$desc'");
		return mysqli_num_rows($s);
	}
	function getAllP($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_programs");
		return $s;
	}
	function countProgram($conn){
		$r = getAllP($conn);
		$rr = mysqli_num_rows($r);
		return $rr;
	}
	function displayProgram($conn){
		$p = getAllP($conn);
		while($pr = mysqli_fetch_object($p)){
			echo "<option value='$pr->prog_id'>$pr->program</option>";
		}
	}
	
	function newDepartment($code,$desc,$prog_id,$conn){
		$i = mysqli_query($conn,"INSERT into lms_departments VALUES('','$code','$desc','Active','$prog_id')");
		return $i;
	}

	function upDepartment($code,$desc,$prog_id,$dept_id,$conn){
		$i = mysqli_query($conn,"UPDATE lms_departments SET dept_code='$code', dept_desc='$desc', prog_id='$prog_id' WHERE dept_id='$dept_id'");
		return $i;
	}
	function removeDept($dept_id,$conn){
		$s = mysqli_query($conn,"DELETE from lms_departments WHERE dept_id='$dept_id'");
		return $s;
	}
	function getAllDepartment($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE status='Active'");
		return $s;
	}

	function getAllDepartmentByCode($dept_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE dept_id='$dept_id'");
		return $s;
	}

	function dept_by_college($prog_id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE prog_id='$prog_id' and status='Active'") or die(mysql_error());
		return $s;
	}

	function dept_by_collegeAll($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE status='Active'") or die(mysql_error());
		return $s;
	}
	function countDeptAsoc($dept_code,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE dept_code in (SELECT dept_code FROM lms_faculty_tag WHERE dept_code='$dept_code')");
		return mysqli_num_rows($s);
	}

	
	function display_dept_by_id($prog_id,$conn){
		$s = dept_by_college($prog_id,$conn);
		while($sr=mysqli_fetch_object($s)){
			echo "<option value='$sr->dept_code'>$sr->dept_desc</option>";
		}
	}
	function display_dept_all($conn){
		$s = dept_by_collegeAll($conn);
		while($sr=mysqli_fetch_object($s)){
			echo "<option value='$sr->dept_code'>$sr->dept_desc</option>";
		}
	}

	function ExistDept($code,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_departments WHERE dept_code='$code'");
		return mysqli_num_rows($s);
	}

	function getAllPbyID($id,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_programs WHERE prog_id='$id'");
		return $s;
	}
	function generateUsername($name){
		$n = str_replace(". ", ".", $name);
		$n = str_replace(" ", ".", $n);

		$ln = strtolower($n);
		return $ln;
	}
	function inDeans($fname,$mname,$lname,$prog_id,$degree,$conn){
		
		$type = "dean";
		$name=$fname." ".$mname." ".$lname;
		// $ex = ifExistDean($name,$prog_id);
		// $e = collegeHasDean($prog_id);
			// if($ex<=0){
				$un = generateUsername($name);
				deactivateDean($un,$conn);
				deactivateDeanInCol($prog_id,$conn);
				$i = mysqli_query($conn,"INSERT into lms_deans VALUES('','$fname','$mname','$lname','$degree','$un',now(),'$prog_id','Active')");
				$ia = inAdmintbl($un,$name,$un,$type,$conn);
				return $i;
			// }else{
			// 	return "Exist";
			// }
	}

	function deactivateDeanInCol($prog_id,$conn){
		$s = mysqli_query($conn,"UPDATE lms_deans SET status='Inactive' WHERE prog_id='$prog_id'");
		return $s;
	}

	function inAdmintbl($user,$name,$pass,$type,$conn){
		$i = mysqli_query($conn,"INSERT into lms_admin Values('','$user','$name','$pass','$type')");
		return $i;
	}

	function allDeans($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_deans WHERE status='Active'");
		return $s;
	}
	function allDeansInactive($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_deans WHERE status='Inactive'");
		return $s;
	}
	function editDean($fname,$lname,$mi,$prog,$did,$degree,$conn){

		$exist = ifExistDean($fname,$lname,$mi,$prog,$conn);
		// if(collegeHasDean($prog>0)){

		// }else{
		// 	if($exist > 0){
				deactivateDeanInCol($prog,$conn);
				$s = mysqli_query($conn,"UPDATE lms_deans SET dean_fname='$fname',dean_mname='$mi',dean_lname='$lname', prog_id='$prog', status='Active',highest_degre='$degree' WHERE dean_id='$did'") or die(mysql_error());
				return $s;
			// }else{
			// 	return "exist";
			// }
		// }
	}
	function collegeHasDean($prog_id){
		$s = mysql_query("SELECT count(*) bilang FROM lms_deans WHERE prog_id='$prog_id'");
		$m = mysql_fetch_object($s);
		return $m->bilang;
	}
	function ifExistDean($fname,$lname,$mname,$prog,$conn){
		$s = mysqli_query($conn,"SELECT count(*) bilang FROM lms_deans WHERE dean_fname='$fname' and dean_mname='$mname' and dean_lname='$lname' and prog_id='$prog'");
		$sr = mysqli_fetch_object($s);
		return $sr->bilang;
	}

	function auth_admin($user, $pass,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_admin WHERE adm_uname = '$user' and a_pass='$pass'");
		return $s;
	}

	function getAdminbyUsername($user,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_admin WHERE adm_uname = '$user'");
		return $s;	
	}
	function getDeanProg($user,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_deans WHERE username = '$user' and status='Active'") or die(mysql_error());
		return $s;	
	}

	function removeDean($did,$conn){
		$d = mysqli_query($conn,"DELETE from lms_deans WHERE dean_id='$did'");
		return $d;
	}

	function getDeanByID($did,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_deans WHERE dean_id='$did'");
		return $s;
	}


	function getDeanByKey($key){
		$s = mysql_query("SELECT * FROM lms_deans where dean_name like '$key%'");
		return $s;
	}

	function inSubjects($sc, $sd){
		$i = mysql_query("INSERT into lms_subjects values('','$sc','$sd','Active')");
		return $i;
	}

	function getAllSub(){
		$s = mysql_query("SELECT * FROM lms_subjects");
		return $s;
	}

	function inEvent($en, $ed, $es, $ee){
		$i = mysql_query("INSERT into lms_events values('','$en','$ed','$es','$ee','Active')");
		return $i;
	}

	function allEvent($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_events");
		return $s;
	}
	function eventById($eid,$conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_events WHERE event_id='$eid'");
		return $s;
	}
	function editEvent($en, $ed, $es, $ee, $eid,$conn){
		$s= mysqli_query($conn,"UPDATE lms_events SET event_name='$en', event_details='$ed', event_start='$es', event_end='$ee' WHERE event_id='$eid'");
		return $s;
	}
	function upEvent($mode,$eid,$conn){
		$s= mysqli_query($conn,"UPDATE lms_events SET status='$mode' WHERE event_id='$eid'");
		createCalendar($conn);
		return $s;
	}
	function in_members($id_no, $fname, $lname, $mname, $uname, $pw){
		$r = mysql_query("INSERT into lms_members values('','$id_no','$fname','$lname','$mname','$uname','$pw','default.png','Active')");
		return $r;
	}
	function tag_faculty($id_no,$dept){
		$t = mysql_query("INSERT into lms_faculty_tag values('','$id_no','$dept',now(),'Active')");
		return $t;
	}
	function uptag_faculty($id_no,$dept,$conn){

		$st = mysqli_query($conn,"UPDATE lms_faculty_tag set dept_code='$dept' WHERE id_no='$dept'");
		return $st;
	}

	function ifExist($id_no){
		$s = mysql_query("SELECT count(*) b FROM lms_members WHERE id_no='$id_no'");
		$d = mysql_fetch_object($s);
		return $d->b;
	}

	function allFaculty($conn){
			$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no like '%BAYA%'")or die(mysql_error());
			return $s;
	}
	function getFabyProg($prog_id,$conn){
			$s = mysqli_query($conn,"SELECT * FROM lms_members where id_no in (SELECT id_no from lms_faculty_tag WHERE dept_code in(SELECT dept_code from lms_departments WHERE prog_id='$prog_id'))");
			return $s;
	}
	function allActiveFaculty(){
			$s = mysql_query("SELECT * FROM lms_members WHERE id_no like '%BAYA%' and status='Active'")or die(mysql_error());
			return $s;
	}
	function allFacultyByID($id_no,$conn){
			$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no ='$id_no'")or die(mysql_error());
			return $s;
	}
	function getMytag($id_no,$conn){
		$t = mysqli_query($conn,"SELECT * FROM lms_faculty_tag WHERE id_no='$id_no'");
		return $t;
	}

	function getMyCollByDeptCode($dept_code,$conn){
		$c = mysqli_query($conn,"SELECT * FROM lms_programs WHERE prog_id in (SELECT prog_id FROM lms_departments WHERE dept_code='$dept_code')")or die(mysql_error());
		return $c;
	}

	function updateF($id,$fn,$ln,$mi,$conn){
		$u=mysqli_query($conn,"UPDATE lms_members SET st_fname='$fn', st_lname='$ln', st_mname='$mi' WHERE id_no='$id'")or die(mysql_error());
		return $u;
	}

	function updateStatus($id,$stat,$conn){
		$u = mysqli_query($conn,"UPDATE lms_members set status='$stat' WHERE id_no='$id'");
		return $u;
	}
	
	function getActiveAcad($conn){
		$s = mysqli_fetch_object(mysqli_query($conn,"SELECT * FROM lms_acad_settings WHERE status='Active'"));
		return $s->acad_id;
	}
	function getActiveAcadYear($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_acad_settings WHERE status='Active'");
		return $s;
	}
	// function materialsRPTcount($id_no){
	// 	$s = mysql_query("SELECT from lms_members");
	// }
	function getFclass($conn){
		$acad_id=getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE acad_id='$acad_id'");
		return $s;
	}
	function getClassInDept($prog_id,$conn){
		$acad_id=getActiveAcad($conn);
		$s = mysqli_query($conn,"SELECT * FROM lms_class WHERE acad_id='$acad_id' and dept_code in (SELECT dept_code FROM lms_departments WHERE prog_id='$prog_id' )");
		return $s;

	}
	function allfacultynomat($prog_id){
		$s = mysql_query("SELECT * FROM lms_members where id_no like 'BAYA%' and id_no not in(SELECT id_no FROM lms_class WHERE class_id not in (SELECT class_id FROM class_modules)) and id_no in(SELECT id_no FROM lms_faculty_tag WHERE dept_code in (SELECT dept_code FROM lms_departments WHERE prog_id='$prog_id'))") or die(mysql_error());
		return $s;
	}
	function getFeed($prog_id){
		$s = mysql_query("SELECT * FROM lms_feed WHERE id_no in (SELECT id_no FROM lms_members WHERE id_no in (SELECT id_no FROM lms_faculty_tag WHERE dept_code in (SELECT dept_code FROM lms_departments WHERE prog_id='$prog_id'))) order by date_added desc");
		return $s;
	}
	function countFeed($id_no){
		$s = mysql_query("SELECT * FROM lms_feed WHERE id_no in (SELECT id_no FROM lms_members WHERE id_no ='$id_no') order by date_added desc");
		return $s;
	}

	function deactivateDean($username,$conn){
		$d = mysqli_query($conn,"UPDATE lms_deans SET status='Inactive' WHERE username='$username'");
		return $d;
	}

	function facindept($prog_id){
		$s = mysql_query("SELECT * FROM lms_members WHERE id_no in (SELECT id_no FROM lms_faculty_tag WHERE dept_code in (SELECT dept_code FROM lms_departments WHERE prog_id='$prog_id'))");
		return $s;
	}
	function allFbyID($eno,$conn){

		$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no='$eno'")or die(mysql_error());
		return $s;
	}

	function sub_ass($awid,$subid){
		$a = mysql_query("INSERT into lms_sub values('','$awid','$subid',now())");
		return $a;
	}
	function allStudents($conn){

			$s = mysqli_query($conn,"SELECT * FROM lms_members WHERE id_no like '%BGU%'")or die(mysql_error());
			return $s;
			
	}

	function inParents($fn,$ln,$mi,$un,$pw){
			$i = mysql_query("INSERT into lms_parents values('','$fn','$ln','$mi','$un','$pw','Active')");
			return $i;
	}
	function allParents(){
			$s = mysql_query("SELECT * FROM lms_parents");
			return $s;
	}

	function inSyllabus($mt,$md,$aid,$mf,$mty){
			$i = mysql_query("INSERT into lms_materials values('','$mt','$md','$aid',now(),0,'$mf','$mty')");
			return $i;
	}

	function allSyllabus(){
			$s = mysql_query("SELECT * FROM lms_materials");
			return $s;
	}

	function authAdmin($u, $p){
		$s = mysql_query("SELECT * FROM lms_admin WHERE adm_uname = '$u' and a_pass='$p' and adm_uname in(SELECT username from lms_deans WHERE status='Active')");
		return $s;
	}

	function adChild($stno,$pid){
		$i = mysql_query("INSERT into lms_child values('','$stno','$pid')");
		return $i;
	}
	function getChilds($pid){
		$s = mysql_query("SELECT * FROM lms_child WHERE parent_id='$pid'");
		return $s;
	}

	function addAcad($sy, $sem){
		
		$exist = ifExisteAcad($sy, $sem);
		if($exist==0){
			autoDeactivate();
			$sys = $sy."-".$sem;
			$i = mysql_query("INSERT into lms_acad_settings VALUES('','$sy', '$sem','$sys','Active')");
			return $i;
		}else{
			return false;
		}

	}

	function ifExisteAcad($sy, $sem){
		$s = mysql_query("SELECT * FROM lms_acad_settings WHERE school_year='$sy' and semester='$sem'");
		return mysql_num_rows($s);
	}

	function allAcad($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_acad_settings");
		return $s;
	}

	function getActive($conn){
		$s = mysqli_query($conn,"SELECT * FROM lms_acad_settings WHERE status='Active'");
		// $r = mysql_fetch_object($s);
		return $s;	
	}

	function ActivateDeactivate($acadid,$stat,$conn){
		if($stat == "Active"){
			autoDeactivate($conn);
		}
		$u = mysqli_query($conn,"UPDATE lms_acad_settings set status='$stat' where acad_id='$acadid'") or die(mysql_error());
		return $u;
	}
	function autoDeactivate($conn){
		$s = mysqli_query($conn,"UPDATE lms_acad_settings set status ='Inactive'");
		return $s;
	}

	function countClassMember($class_id,$conn){
		$c = mysqli_query($conn,"SELECT count(*) bilang FROM lms_class_member WHERE class_id='$class_id'");
		$cr = mysqli_fetch_object($c);
		return $cr->bilang;
	}
	function countMembersByacad($conn){
		$ac = mysqli_fetch_object(getActive($conn));
		$c = mysqli_query($conn,"SELECT count(*) bilang FROM lms_class_member WHERE class_id in (SELECT class_id FROM lms_class WHERE acad_id='$ac->acad_id')");
		$cr = mysqli_fetch_object($c);
		return $cr->bilang;
	}

	function countClassMaterials($class_id,$conn){
		$cm = mysqli_query($conn,"SELECT count(*) bilang FROM class_modules WHERE class_id='$class_id'");
		$cr = mysqli_fetch_object($cm);
		return $cr->bilang;
	}

	function countAllCourseMaterial($conn){
		$ac = mysqli_fetch_object(getActive($conn));
		$c = mysqli_query($conn,"SELECT count(*) bilang from class_modules WHERE class_id in(SELECT class_id FROM lms_class WHERE acad_id='$ac->acad_id')");
		$cr = mysqli_fetch_object($c);
		return $cr->bilang;
	}
	function countSubject($conn){
		$ac = mysqli_fetch_object(getActive($conn));
		$s = mysqli_query($conn,"SELECT count(*) bilang FROM lms_class WHERE acad_id='$ac->acad_id' group by subject_code");
		return mysqli_num_rows($s);
	}
	function createCalendar($conn){
		 $g = mysqli_query($conn,"SELECT * FROM lms_events where status='Active'");
		    $txt = "[\n";
		    $text = "[\n";

		    $sep="";
		    if(mysqli_num_rows($g)>1){
		      $sep=",";
		    }else{
		      $sep="";
		    }
		  while($sr = mysqli_fetch_object($g)){
		    $txt .= "{ \n title:'".$sr->event_name."',\n start: new Date(".date("Y",strtotime($sr->event_start)).", ".date("m",strtotime($sr->event_start))."-1".", ".date("d",strtotime($sr->event_start))."),\n end: new Date(".date("Y", strtotime($sr->event_end)).", ". date("m", strtotime($sr->event_end))."-1,".date("d", strtotime($sr->event_end))."".")\n }".$sep;
		  }
		  $txt.="\n]";
		    $myfile = file_put_contents('event.txt', $txt.PHP_EOL);
	}

	function verifyChangePass($user,$pass){
		$s = mysql_query("SELECT * FROM lms_admin WHERE adm_uname='$user' and a_pass='$pass'" );
		return mysql_num_rows($s);
	}
	function AdminchangePassword($user,$cpass){
		$s = mysql_query("UPDATE lms_admin SET a_pass='$cpass' WHERE adm_uname='$user'");
		return $s;
	}
?>