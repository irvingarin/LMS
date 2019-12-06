<?php 
  include("../conn.php");
  include("../functions.php");

if(isset($_GET['qid'])){

  $r = getQuizResultT($_GET['qid'],$conn);
   


?>

	<table id="dtatableresult" class="table table-condensed table-bordered">
      <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Items</th>
            <th>Result</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while($rr = mysqli_fetch_object($r)){
           $sr = mysqli_fetch_object(getMemberByid_noT($rr->id_no,$conn));

          $name = $sr->st_lname.", ".$sr->st_fname;
        ?>
          <tr>
            <td><?=$rr->date_taken?></td>
            <td><?=$name?></td>
            <td><?=countQItems($rr->quiz_id,$conn)?></td>
            <td><?=coutCorrect($rr->quiz_id, $rr->id_no)?></td>
          </tr>
        <?php } ?>
      </tbody>
  </table>
  <?php } ?>