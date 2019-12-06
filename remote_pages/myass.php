<?php session_start();
	include("../conn.php");
	include("../functions.php");
	$s = getAllMyAssignment($_GET['as_id'],$_SESSION['lms_m_id_no'],$conn)
?>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th>Filename</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			while($sr = mysqli_fetch_object($s)){
		?>
		<tr>
			<td><?=$sr->filename?></td>
			<td><?=$sr->date_uploaded?></td>
		</tr>
		<?php } ?>
	</tbody>
	
</table>