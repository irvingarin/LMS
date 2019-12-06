<?php session_start();
	include("conn.php");
	include("functions.php");
	$current="";
	$result = "";
	$comp = "";
	$file = "";

	$folder_path = $_SESSION['lms_folder_name'];

	if(isset($_POST['compile'])){
		$nc = htmlspecialchars($_POST['c']);
		$current = htmlspecialchars_decode($nc);
		//echo $nc;
		$file = $_POST['f'];

		file_put_contents($folder_path."/".$file, $current);
		putenv("PATH=".__DIR__."\MinGW64\bin");

		$nfile = str_replace(".cpp", "", $file);

		$comp=shell_exec("g++ ".$folder_path."/".$nfile.".cpp"." -o ".$folder_path."/".$nfile.".exe 2>&1");
		// $comp=shell_exec("cd ".__DIR__."/".$folder_path."/ && gcc -o test".$nfile.".cpp 2>&1");
		
		//exec("g++ ".$nfile.".cpp" );
		//printf($comp);
		if($comp==""){
			$result = shell_exec(__DIR__."/".$folder_path."/".$nfile.".exe");//
			// $result = shell_exec("cd ".__DIR__."/".$folder_path."/ && /test");
			echo "<code class='text-success'><br />Completed</code> <br /><hr />";
			echo "<pre>".$result."</pre>";


		}else{
			echo "<code class='text-danger'><br />Syntax Error</code> <br /><hr />";
			$doInsert=errorLog($comp,1);
			echo "<pre>".$comp."</pre>";

		}
	}
	if(isset($_POST['save'])){
		$id_no = $_SESSION['lms_m_id_no'];
		$filename = $_POST['f'];
		$mod_act_id = $_POST['acid'];

		$sa = saveExercise($mod_act_id,$id_no,$filename,$folder_path);

		if($sa==true){
			echo "<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-success'> <i class='fa fa-info fa-fw'></i> File Successfuly Saved </div></div>";
		}else{
			echo "<div id='toast-container' class='toast-top-right animated slideInUp'><div class='toast-message toast-danger'> <i class='fa fa-info fa-fw'></i> Failed to save file </div></div>";
		}
			$ftitle = "Activity";
			$link = "";
			$desc = "You have saved your activity";
			$action = "Saved";
			$feed = createFeed($ftitle,$link,$desc,$c,$action);
	}

?>