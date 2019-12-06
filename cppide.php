<?php session_start();
	include("conn.php");
	include("functions.php");
	if(!isset($_SESSION['lms_m_id_no'])){
		header("Location: index.php");
	}
	if(isset($_GET['x'])){
		$member_id = $_SESSION['lms_m_id_no'];
		$act = getOneActivity($_GET['x']);
		$count = mysql_num_rows($act);
		$actrow = mysql_fetch_object($act);
		if($count==0){
			header("Location:dashboard.php?");
		}
		$folder_name = "classes/class_".$_GET['g']."/lms_".$_GET['g']."_".$_GET['x'];
			$_SESSION['lms_folder_name'] = $folder_name;
			if( !file_exists($folder_name) ){
					mkdir($folder_name);
			}
	}

	if(isset($_GET['f'])){
		$folder_name = $_GET['f'];
		$act = getOneActivity($_GET['e']);
		$count = mysql_num_rows($act);
		$actrow = mysql_fetch_object($act);
		$_SESSION['lms_folder_name'] = $folder_name;
	}
	
	

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>LMS | C++ Editor</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/default.png" />
  	<!-- <link rel="stylesheet" type="text/css" href="cpp.css"> -->
     
     <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

  <script src="socket_io.js" type="text/javascript" charset="utf-8"></script>
  <script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script>
		var staticPrefix='src-noconflict';
	</script>
  <style type="text/css" media="screen">
 	body{
 		background-color: #141414!important;
 		background-image: none;
 		
 	}
    #editor {
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        
    }
    .navbar{
    	box-shadow: none;
    }
    .ace-twilight {
		background-image: url("img/logo-black.svg")!important;
        
        background-repeat: no-repeat;
        
        background-position: left -190px top 20px;
        background-color: transparent;
    }

    #editor_cont{
    	width: 100%;
    	height: 100%;
    	position: relative;
    	margin-left:0;
    	z-index: 0;
    	
    }
  </style>
</head>
<body>
	<?php 
		//require("component/nav.php");

	?>
	<nav class="navbar navbar-expand-lg navbar-expand-lg navbar-dark lms-blue">
	  <a class="navbar-brand" href="cppide.php"><img src="img/logo2-white.svg" width="40px"></a> <span class="white-text">C++ Editor</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
	    aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	   
	  </div>
	</nav>

	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<br />
				<div class="nav">
					<div class="col-sm-4">
						<div class="form-group">
						
							
						</div>
					</div>
				</div>
        	</div>
		</div>
		<?php 
		$fffile="";
		if(isset($_GET['x'])){
			    		$fffile=$member_id."_".$_GET['x'].".cpp";
			    }		
		if(isset($_GET['f'])){
			    				$fffile=$_GET['fl'];
			    }
			?>
		<div class="row">
			<div class="col-sm-12">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#codetab" role="tab" aria-controls="home" aria-selected="true">
			    	<span class="filename"><?=$fffile?></span>
				</a>
			  </li>
			  
			  <li class="nav-item">
			    <a class="nav-link" id="output-tab" data-toggle="tab" href="#output" role="tab" aria-controls="outputtab" aria-selected="false">Output</a>
			  </li>
			  <li class="nav-item">
			    <button id="runcode" class="btn btn-sm btn-rounded lms-blue" title="Compile and Run"><i class="fa fa-play"></i></button>
			    <?php 
			    	if(isset($_GET['x'])){
			    ?>
			    <button id="savecode" class="btn btn-sm btn-rounded lms-blue" data-act="<?=$actrow->mod_ac_id?>" title="Save File"><i class="fa fa-save"></i></button>
			<?php } ?>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="codetab" role="tabpanel" aria-labelledby="code-tab"> 	<div class="container-fluid">
			  		<div class="row">
			  			<div class="col-sm-8">
						  	<div id="editor_cont scroll-lms scrollbar-primary">
						  		<?php 
						  		$ffile = "";
						  		$cppfile = "";
							  	$ncppfile="";
						  		if(isset($_GET['x'])){
							  		$ffile = $member_id."_".$_GET['x'].".cpp";
							  		
							  			if(file_exists($folder_name."/".$ffile)){
									
										$cppfile = file_get_contents($folder_name."/".$ffile);
										$ncppfile = htmlspecialchars( $cppfile, ENT_QUOTES, 'UTF-8' );
									}
								}
								if(isset($_GET['f'])){
									$ffile = $_GET['fl'];
							  		
							  			if(file_exists($folder_name."/".$ffile)){
									
										$cppfile = file_get_contents($folder_name."/".$ffile);
										$ncppfile = htmlspecialchars( $cppfile, ENT_QUOTES, 'UTF-8' );
									}
								}
						  		?>
								<div id="editor" class="comped"><?php 
									
									echo $ncppfile;
								?></div>	
								<?php ?>
							</div>	
						</div>
						<div class="col-sm-4">
							<div class="dir-box">
								<h5 class="text-white"><i class="fa fa-coffee"></i> <span><?=$actrow->act_title?></span></h5>
								<div class="scroll-lms scrollbar-primary">

									<div class="list-group text-white">
		  								<p><?=$actrow->activities_desc?></p>
									<?php 
										/*
										$dir    = './cpp';
										$cdir = scandir($dir);
										foreach ($cdir as $key => $value) { 
											if($value!="." and $value!=".."){
												if(strpos($value, ".exe")!=true){
													echo '<a href="#!" class="list-group-item list-group-item-action"><i class="fa fa-file fa-fw"></i>'.$value.'</a>';
												}
											}
										}
										*/
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
				 </div>
			  </div>
		
			  <div class="tab-pane fade" id="output" role="tabpanel" aria-labelledby="output-tab"> 
			  		<div class="output">
						<code id="outputcont">Output
							
						</code>

					</div>
			  </div>
			</div>
		</div>
		</div>
		
		
	</div>
	<?php 
		require("component/footer.php");
	?>
	<div class="notip"></div>
	
	
	<script type="text/javascript">
		
	</script>
	
	
	<script>
	    var editor = ace.edit("editor");
	    editor.setTheme("ace/theme/twilight");
	    editor.session.setMode("ace/mode/c_cpp");
	    editor.session.setUseSoftTabs(true);
	    $(document).ready(function(){
			$("body").on("click","#runcode", function(){
				editor.find('+',{
				    backwards: false,
				    wrap: false,
				    caseSensitive: false,
				    wholeWord: false,
				    regExp: false
				});
				editor.findNext();
				editor.findPrevious();
				editor.replaceAll('%2B');
				editor.find('&',{
				    backwards: false,
				    wrap: false,
				    caseSensitive: false,
				    wholeWord: false,
				    regExp: false
				});
				editor.findNext();
				editor.findPrevious();
				editor.replaceAll('%26');
				//%26

				var ccode = editor.getValue();
				var filename = $(".filename").text();
				// = ccode.replace("++","%2B%2B");
				//str = str.replace("++","%2B%2B");
				editor.find('%2B',{
				    backwards: false,
				    wrap: false,
				    caseSensitive: false,
				    wholeWord: false,
				    regExp: false
				});
				editor.findNext();
				editor.findPrevious();
				editor.replaceAll('+');
				editor.find('%26',{
				    backwards: false,
				    wrap: false,
				    caseSensitive: false,
				    wholeWord: false,
				    regExp: false
				});
				editor.findNext();
				editor.findPrevious();
				editor.replaceAll('&');
		
				jQuery.ajax({
					url:'runajax.php',

					type:'post',
					dataType:'text',
					data:"compile=true&c="+ccode+"&f="+filename,
					success:function(f){
						//alert(f);
						$("#outputcont").html(f);
					}
				});
			});

			function repl(string){

				return string;
			}

			$("#savecode").click(function(e){
				e.preventDefault();
				var act = $(this).attr("data-act");
				var filename = $(".filename").text();
				jQuery.ajax({
					url:'runajax.php',
					type:'post',
					dataType:'text',
					data:'save=true&acid='+act+'&f='+filename,
					success:function(f){
						$(".notip").html(f);
					}
				});
			});
		});

	</script>
	
	
</body>
</html>

