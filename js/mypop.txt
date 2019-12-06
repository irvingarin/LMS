$(document).ready(function () {
    var title = "";
    $("body").on('click', ".poop", function (e) {
        e.preventDefault();

        title = $(this).attr("title");
        var urls = $(this).attr("href");
        var remote = $(this).attr("data-remote");
        var size = "";

        var rmode = $(this).attr("data-size");
        
        if(rmode == undefined){
            size = "modal-sm";     
        }else{
            size = rmode; 
        }
        //                var id = this.id;
        //                var ids = $("#" + id).text();
        $("body").append("<div id='mod' class='modal fade' role='dialog'><div class='modal-dialog "+size+"'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>" + title + "</h5><button type='button' class='close' data-dismiss='modal'>&times;</button></div><div class='modal-body'></div></div></div></div>");
        //alert("ssfasdf");
        var tar = "";
        $("#mod").modal("show");
        if (urls != "#") {
            tar = urls;
        } else {
            tar = remote;
        }

        $(".modal-body").load(tar);



    });
    $("#mod").on('show.bs.modal', function () {

    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $('.modal').remove();
    });

    ////////////////////////////////View Image ////////////////////////////////////////
     $("body").on('click', ".viewimg", function (e) {
        e.preventDefault();

        title = $(this).attr("title");
        var urls = $(this).attr("href");
        var remote = $(this).attr("data-remote");
        var size = "";

        var rmode = $(this).attr("data-size");
        
        if(rmode == undefined){
            size = "modal-sm";     
        }else{
            size = rmode; 
        }
        //                var id = this.id;
        //                var ids = $("#" + id).text();
        $("body").append("<div id='mod' class='modal fade' role='dialog'><div class='modal-dialog "+size+"'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>" + title + "</h4></div><div class='modal-body'><img src='' class='view-me img-responsive' width='100%' alt='img'/></div></div></div></div>");
        //alert("ssfasdf");
        var tar = "";
        $("#mod").modal("show");
        if (urls != "#") {
            tar = urls;
        } else {
            tar = remote;
        }

        $(".view-me").attr("src",tar);



    });
});