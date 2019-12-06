<!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/myPOP.js"></script>
    <script type="text/javascript" src="js/chart.js"></script>
    <script type="text/javascript" src="js/lms_analytics.js"></script>
    <script type="text/javascript" src="js/addons/datatables.js"></script>
    <script src="js/jquery.time-to.js"></script>
    <script>
     
    $(document).ready(function(){
        $("[data-deadline]").each(function(){
           var t = $(this);
            var d = $(this).attr("data-deadline");

          //alert(d);
          var reCount;
          // Set the date we're counting down to
          var countDownDate = new Date(d).getTime();
            //alert(countDownDate);
          // Update the count down every 1 second
            var x = setInterval(function() {

              // Get today's date and time
              var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
              //alert(distance);
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
             t.html(days + "d " + hours + ":"
            + minutes + ":" + seconds + "");

            // If the count down is finished, write some text 
            if (distance < 0) {
              clearInterval(x);
              t.html("CLOSED");
            }
            //return reCount;
          }, 1000);
        });
         $("[data-limit]").each(function(){
           var t = $(this);
            var d = $(this).attr("data-limit");

          //alert(d);
          var reCount;
          // Set the date we're counting down to
          var countDownDate = new Date(d).getTime();
            //alert(countDownDate);
          // Update the count down every 1 second
            var x = setInterval(function() {

              // Get today's date and time
              var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
              //alert(distance);
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
             t.html(minutes + ":" + seconds + "");

            // If the count down is finished, write some text 
            if (distance < 0) {
              clearInterval(x);
              t.html("CLOSED");
            }
            //return reCount;
          }, 1000);
        });


    });
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#dtatable').DataTable();
    $('#dtatable1').DataTable();
    $("#dtatableresult").DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".qtype").change(function(){
        var l = $(this).val();
        var qid=$(".qtype").attr("data-quizid");
        var group = $(".qtype").attr("data-groupid");
        var lnk;
        if(l=="multi"){
          lnk= "remote_pages/multiple_choice.php?c="+group+"&qid="+qid;
        }
        if(l=="true"){
          lnk= "remote_pages/trueorfalse.php?c="+group+"&qid="+qid;
        }
        if(l=="ident"){
          lnk= "remote_pages/indentification.php?c="+group+"&qid="+qid 
        }
        $(".addQ").attr("data-remote",lnk);
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("t");
    var g = url.searchParams.get("group");
    var tt = url.searchParams.get("tt");
    //alert(c);
    if(tt!=null){
      $("."+tt).addClass("active");
    }
    $("."+c).addClass("active");
    $(".g"+g).addClass("active");

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("body").on("click",".adChoice", function(){
        var op = $(this).attr("data-opt");
        //var nxt = op=='z'?'a': op=='Z'?'a':String.fromCharCode(op.charCodeAt(0)+1);
        var nxt = "";
        if(op=="B"){
          nxt='C';
        }
        if(op=='C'){
          nxt='D';
        }
        if(op=='D'){
          nxt='E'; 
        }

        // op++;
        // alert(op);
        var txtbox;
        

         
        if(op=="E"){
          txtbox="<span class='text-danger'>Too Many Choices</span>";
          $(this).attr("disabled","");
        }else{
          txtbox="<div class='form-group'><label for='txtop"+op+"'class='font-weight-light'><strong>"+op+"</strong></label><input type='text' name='txtop[]' id='txtop"+op+"' value='' class='form-control' required=''></div>";
          $(this).attr("data-opt",nxt);
        }
        $(".responses").append(txtbox);

    });
  });
</script>

    <!-- Footer -->


<footer class="page-footer font-small lms-blue">
  
    <!-- Footer Elements -->
    <div class="container-fluid">

      <!-- Grid row-->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-12 py-5">
          <div class="mb-5 flex-center">

            <!-- Facebook -->
            <a class="fb-ic">
              <i class="fa fa-facebook fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!-- Twitter -->
            <a class="tw-ic">
              <i class="fa fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!-- Google +-->
            <a class="gplus-ic">
              <i class="fa fa-google-plus fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Linkedin -->
            <a class="li-ic">
              <i class="fa fa-linkedin fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Instagram-->
            <a class="ins-ic">
              <i class="fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
            </a>
            <!--Pinterest-->
            <a class="pin-ic">
              <i class="fa fa-pinterest fa-lg white-text fa-2x"> </i>
            </a>
          </div>
        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Pangasinan State University:
      <a href="#">psu.edu.ph</a>
    </div>
    <!-- Copyright -->

  </footer>

  <!-- Footer -->