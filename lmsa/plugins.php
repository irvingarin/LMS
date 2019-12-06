 <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/myPOP.js"></script>
    <!-- MDB core JavaScript -->
    <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script type="text/javascript" src="js/calendar.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.maskedinput-1.3.js"></script> -->

    <!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();

            $('.dataTables_length').addClass('bs-select');
            $("#dtBasicExample1").DataTable();
        });
    </script>
    <!-- Calendar -->
        <script>
            $(document).ready(function(){
              $('#calendar').fullCalendar({
   


                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: ''
                },
                editable: true,
                events: <?php 
                  

                  $fh = fopen('event.txt','r');
                  while ($line = fgets($fh)) {
                    // <... Do your work with the line ...>
                     echo($line);
                  }
                  fclose($fh);

                ?>
              });
            })
        </script>
        <script type="text/javascript">
          $(document).ready(function(e){
              $("body").on("focus",".mask",function(){
                if($(this).val()==""){
                  $(this).val("BAYA-");  
                }
                
              });

              $("body").on("keydown",".mask",function(e){
                var k = event.which;
                // alert(k);
                var $this = $(this);
                var str = $this.val();
                if(k==8){
                  e.preventDefault();
                  if($this.val("BAYA-")){
                    $this.val("BAYA-");
                  }
                }
                var key = String.fromCharCode(k);
                var regex = /[0-9]|\./;
                if( !regex.test(key) ) {
                  // alert("X");
                  e.preventDefault();
                  // if(theEvent.preventDefault) theEvent.preventDefault();
                }
                var n = str.length;
                if(n==10){
                  e.preventDefault();
                }
                // alert(n);
                // var $this = $(this);
                // var mask = $this.attr("data-inputmask");
                // $this.val($mask);
              });
          });
        </script>
      
        <script type="text/javascript">
          $(document).ready(function(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var c = url.searchParams.get("d");
            //alert(c);
            if(c!=null){
              $("."+c).addClass("active");
            }else{
              $(".dashboard").addClass("active");
            }
            
          });
        </script>