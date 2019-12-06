<?php 
  include("../conn.php");
  include("../functions.php");

if(isset($_GET['cid'])){

  $r = allQuizByStudent($_GET['id_no'],$_GET['cid']);


?>

	<table id="dtatableresult" class="table table-condensed table-bordered">
      <thead>
        <tr>
            <th>Date</th>
            <th>Quiz No</th>
            <th>Item</th>
            <th>Result</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while($rr = mysql_fetch_object($r)){

        ?>
          <tr>
            <td><?=$rr->date_added?></td>
            <td><?=$rr->quiz_title?></td>
            <td><?=countQItems($rr->quiz_id)?></td>
            <td><?=coutCorrect($rr->quiz_id, $_GET['id_no'])?></td>
          </tr>
        <?php } ?>
      </tbody>
  </table>
  <?php } ?>