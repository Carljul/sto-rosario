<?php
    if(isset($_FILES['file'])){
        var_dump($_POST['file_to_exclude']);
        var_dump($_POST['file_to_exclude2']);
        // Flush All Files from uploaded_images 
        // Folder path to be flushed
        $location = 'uploaded_images/';
        
        // List of name of files inside
        // specified folder
        $files = glob($location.'*'); 
        
        // Deleting all the files in the list
        if(count($files) > 2){
            foreach($files as $file) {
            
                if(is_file($file)) {
                    if(
                        $_POST['file_to_exclude'] != "" && $file != "uploaded_images/".$_POST['file_to_exclude'] &&
                        $_POST['file_to_exclude2'] != "" && $file != "uploaded_images/".$_POST['file_to_exclude2']
                    ){
                        // Delete the given file
                        unlink($file); 
                    }
                
                }
                
            }
        }

        $name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmp_name, $location.$name);
        
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">

    <style>
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
            z-index: 1;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }

        /* to pop modal from right */
        .modal.fade:not(.in).right .modal-dialog {
            position: absolute;
            right: 25px;
            width: 100%;
        }
        .btn-print{
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .full-height{
            height: 100vh;
        }
        .cover-body{
            height: 100%;
        }
        .cover-div{
            height: 100%;
        }
        #certificate{
            display: none;
        }
        #address_text{
            margin-bottom: 0px !important;
        }
        #tel_number_text{
            margin-bottom: 0px !important;
        }

        @media print {
            body .btn-actions{
                display: none;
            }
            #printArea, #printArea * {
                visibility: visible;
            }
            #printArea {
                border: none !important;
            }
            #printArea .card-body{
                padding: 0px !important;
            }

            .header{
                padding: 0px;
                margin: 0px;
                width: 2000px;
            }
            .header .row{
                margin: 0px 10% !important;
            }
        }
        @page {
            size: landscape;
            margin: 15%;
        }
        .logo-container{
            position: absolute;
            width: 10% !important;
        }
        .church-name-container{
            position: absolute;
            width: 90% !important;
        }
        #printArea{
            background-repeat: no-repeat;
            background-size: cover;
            -webkit-print-color-adjust: exact;
        }
    </style>

    <!-- JQUERY  -->
    <script src="js/jquery-3.6.0.min.js"></script>
  </head>
  <body class="bg-dark p-2 full-height">
      
    <!-- Print Button -->
    <button type="button" class="btn-print btn btn-xl btn-success btn-circle btn-actions"><i class="fa fa-print"></i></button>

    <!-- Content -->
    <div class="container-fluid">
        <div class="float-end btn-actions">
            <div class="row mb-1">
                <button type="button" class="btn btn-xl btn-warning btn-circle" data-bs-toggle="modal" data-bs-target="#modalCertificateForm">
                    <i class="fa fa-user"></i>
                </button>
            </div>
            <div class="row mb-1">
                <button type="button" class="btn btn-xl btn-primary btn-circle" data-bs-toggle="modal" data-bs-target="#modalSettingsForm">
                    <i class="fa fa-cogs"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="container-fluid cover-body">
        <div class="card cover-div" id="printArea">
            <div class="card-body">
                <!-- Progress Indicator -->
                <div class="loader position-absolute top-50 start-50 translate-middle">
                    <h5>Preparing Form</h5>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- /Progress Indicator -->
                <!-- Certificate -->
                <div id="certificate">
                    <div class="container header">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <center>
                                    <div class="logo-container">
                                        <img src="uploaded_images/logo.jpg" id="logo" class="img-fluid" alt="logo" style="width: 150px;">
                                    </div>
                                    <div class="church-name-container">
                                        <!-- Do Not change HTML Structure -->
                                        <span id="church_name_text"><h3>Archdiocesan Shrine of the Sto. Rosario Parish</h3></span>
                                        <p id="address_text">Pantaleon del Rosario St, Cebu City, 6000 Cebu</p>
                                        <p id="tel_number_text">Tel. No. (639)+0687650</p>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                Sponsors List:
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Certificate -->
            </div>
        </div>
    </div>

    <!-- Certificate Content Modal -->
    <div class="modal fade right" id="modalCertificateForm" tabindex="-1" aria-labelledby="modalCertificateForm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

    <!-- Certificate Settings Modal -->
    <div class="modal fade right" id="modalSettingsForm" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalSettingsForm" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Certificate Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="text_changes-tab" data-bs-toggle="tab" data-bs-target="#text_changes" type="button" role="tab" aria-controls="home" aria-selected="true">Text Changes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Text Styles</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="text_changes" role="tabpanel" aria-labelledby="text_changes-tab">
                            <br>
                            <div class="mb-3">
                                <label for="upload_background_image" class="form-label">Upload Background Image</label>
                                <input type="file" class="form-control" id="upload_background_image" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="upload_logo" class="form-label">Upload Logo</label>
                                <input type="file" class="form-control" id="upload_logo" accept="image/*">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="church_name" placeholder="test">
                                <label for="church_name">Church Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="church_address" placeholder="test">
                                <label for="church_address">Address</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="include_address" checked>
                                <label class="form-check-label" for="include_address">
                                    Include Address
                                </label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="telephone_number" placeholder="test">
                                <label for="telephone_number">Telephone Number</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="include_telephone_number" checked>
                                <label class="form-check-label" for="include_telephone_number">
                                    Include Telephone Number
                                </label>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <br>
                            <div class="mb-3">
                                <label for="church_name_font_style">Church Name Font Style</label>
                                <select class="form-select" aria-label="Default select example" id="church_name_font_style">
                                    <option selected disabled>Church Name Font Style</option>
                                    <option>Arial, sans-serif</option>
                                    <option>Helvetica, sans-serif</option>
                                    <option>Verdana, sans-serif</option>
                                    <option>Trebuchet MS, sans-serif</option>
                                    <option>Gill Sans, sans-serif</option>
                                    <option>Noto Sans, sans-serif</option>
                                    <option>Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif</option>
                                    <option>Optima, sans-serif</option>
                                    <option>Arial Narrow, sans-serif</option>
                                    <option>sans-serif</option>
                                    <option>Impact, fantasy</option>
                                    <option>Luminari, fantasy</option>
                                    <option>Chalkduster, fantasy</option>
                                    <option>Jazz LET, fantasy</option>
                                    <option>Blippo, fantasy</option>
                                    <option>Stencil Std, fantasy</option>
                                    <option>Marker Felt, fantasy</option>
                                    <option>Trattatello, fantasy</option>
                                    <option>fantasy</option>
                                    <option>Comic Sans MS, Comic Sans, cursive</option>
                                    <option>Apple Chancery, cursive</option>
                                    <option>Bradley Hand, cursive</option>
                                    <option>Brush Script MT, Brush Script Std, cursive</option>
                                    <option>Snell Roundhand, cursive</option>
                                    <option>URW Chancery L, cursive</option>
                                    <option>cursive</option>
                                    <option>Andale Mono, monospace</option>
                                    <option>Courier New, monospace</option>
                                    <option>Courier, monospace</option>
                                    <option>FreeMono, monospace</option>
                                    <option>OCR A Std, monospace</option>
                                    <option>DejaVu Sans Mono, monospace</option>
                                    <option>monospace</option>
                                    <option>Times, Times New Roman, serif</option>
                                    <option>Didot, serif</option>
                                    <option>Georgia, serif</option>
                                    <option>Palatino, URW Palladio L, serif</option>
                                    <option>Bookman, URW Bookman L, serif</option>
                                    <option>New Century Schoolbook, TeX Gyre Schola, serif</option>
                                    <option>American Typewriter, serif</option>
                                    <option>serif</option>
                                    <option>Old English Text MT</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="church_name_font_style">Church Name Font Size</label>
                                <select class="form-select" aria-label="Default select example" id="church_name_font_size">
                                    <option selected value="">Church Name Font Size</option>
                                    <option value="h6">Extra small</option>
                                    <option value="h5">Small</option>
                                    <option value="h4">Medium</option>
                                    <option value="h3">Large</option>
                                    <option value="h2">Extra Large</option>
                                    <option value="h1">Double XL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_save_certificate_settings">Save Settings</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

    <!-- /Content -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function(){
            loader();
            function loader(){
                // will hide the loader
                setTimeout(function(){
                    $(".loader").fadeOut(500);
                },3000);
                
                // will show the certificate template
                setTimeout(function(){
                    showCertificate();
                },3500);
            }

            function showCertificate(){
                $("#certificate").css("display","block");
            }

            // Printing
            $(".btn-print").click(function(){
                print();
            });

            // ============= data Management
            // clear_site_management();
            site_management();
            function site_management(){
                var site_config = [{
                    "site_image": "",
                    "site_background": "",
                    "certificate_of": "",
                    "list_of_sponsors": "",
                    "church_name": "",
                    "church_name_font_size": "",
                    "church_name_font_style": "",
                    "address": "",
                    "address_text_style": "",
                    "is_include_address": true,
                    "tel_number": "",
                    "tel_number_text_style": "",
                    "is_include_telephone": true
                }];

                var certificate = [{
                    "childs_name": "",
                    "fathers_name": "",
                    "mothers_name": "",
                    "list_of_sponsors": []
                }];
                if(localStorage.getItem('site_config') != null && localStorage.getItem('certificate') != null){
                    var sc = JSON.parse(localStorage.getItem('site_config'));
                    var site_config_parsed = JSON.parse(localStorage.getItem('site_config'));
                    var certificate_parsed = JSON.parse(localStorage.getItem('certificate'));

                    // logo
                    if(sc[0]['site_image'] != ""){
                        $("#logo").attr("src", "uploaded_images/"+sc[0]['site_image']);
                    }
                    // background image
                    if(sc[0]['site_background'] != ""){
                        $("#printArea").css("background-image", "url('uploaded_images/"+sc[0]['site_background']+"')");
                    }
                    // church name
                    if(sc[0]['church_name'] != ""){
                        $("#church_name_text")[0].childNodes[0].innerText = sc[0]['church_name'];
                        $("#church_name").val(sc[0]['church_name']);
                    }
                    // church font size
                    if(sc[0]['church_name_font_size'] != ""){
                        var innerText = $("#church_name_text")[0].innerText;
                        var html = "";
                        switch(sc[0]['church_name_font_size']){
                            case "h1":
                                html = "<h1>"+innerText+"</h1>";
                                break;
                            case "h2":
                                html = "<h2>"+innerText+"</h2>";
                                break;
                            case "h3":
                                html = "<h3>"+innerText+"</h3>";
                                break;
                            case "h4":
                                html = "<h4>"+innerText+"</h4>";
                                break;
                            case "h5":
                                html = "<h5>"+innerText+"</h5>";
                                break;
                            case "h6":
                                html = "<h6>"+innerText+"</h1>";
                                break;
                            default: 
                                html = "<h6>"+innerText+"</h6>";
                        }
                        $("#church_name_text").html(html);
                        $("#church_name_font_size").val(sc[0]['church_name_font_size']);
                    }
                    // church font style
                    if(sc[0]['church_name_font_style'] != ""){
                        $("#church_name_text").css('font-family', sc[0]['church_name_font_style']);
                        $("#church_name_font_style").val(sc[0]['church_name_font_style']);
                    }
                }else{
                    localStorage.setItem('site_config', JSON.stringify(site_config));
                    localStorage.setItem('certificate', JSON.stringify(certificate));
                }
            }

            function clear_site_management(){
                localStorage.removeItem('site_config');
                localStorage.removeItem('certificate');
            }
            
            // upload background image
            $("#upload_background_image").change(function(){
                var result = this;
                // console.log(result);
                if (result.files && result.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#printArea").css("background-image", "url('"+e.target.result+"')");
                    }
                    reader.readAsDataURL(result.files[0]);
                }else{
                    alert('select a logo to see preview');
                }
            });

            // upload logo
            $("#upload_logo").change(function() {
                readURL(this);
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('select a logo to see preview');
                    $('#logo').attr('src', 'uploaded_images/logo.jpg');
                }
            }
            
            // Updating Church Name
            $("#church_name").change(function(){
                var val = $(this).val();
                $("#church_name_text")[0].childNodes[0].innerText = val;
            });

            // Updating Church Name Font Size
            $("#church_name_font_size").change(function(){
                var val = $(this).val();
                if(val != ""){
                    var innerText = $("#church_name_text")[0].innerText;
                    var html = "";
                    switch(val){
                        case "h1":
                            html = "<h1>"+innerText+"</h1>";
                            break;
                        case "h2":
                            html = "<h2>"+innerText+"</h2>";
                            break;
                        case "h3":
                            html = "<h3>"+innerText+"</h3>";
                            break;
                        case "h4":
                            html = "<h4>"+innerText+"</h4>";
                            break;
                        case "h5":
                            html = "<h5>"+innerText+"</h5>";
                            break;
                        case "h6":
                            html = "<h6>"+innerText+"</h1>";
                            break;
                        default: 
                            html = "<h6>"+innerText+"</h6>";
                    }

                    $("#church_name_text").html(html);
                }else{

                }
            });

            // Updating Church Font Style
            $("#church_name_font_style").change(function(){
                var church_name_font_style = $("#church_name_font_style").find(":selected").text();
                if(church_name_font_style != "Church Name Font Style"){
                    $("#church_name_text").css('font-family', church_name_font_style);
                }
            });

            // Updating Church Address
            $("#church_address").change(function(){
                var val = $(this).val();
                $("#address_text").html(val);
            });

            $("#include_address").change(function(){
                var result_address = $("#include_address").is(":checked");
                var result_telephone = $("#include_telephone_number").is(":checked");
                // margin adjustments
                if(result_address && result_telephone){
                    $("#church_name_text").css('margin-top','0px');
                }else if(!result_address && !result_telephone){
                    $("#church_name_text").css('margin-top','40px');
                }else{
                    $("#church_name_text").css('margin-top','20px');
                }
                // showing hiding address
                if(result_address){
                    $("#address_text").css('display', 'block');
                }else{
                    $("#address_text").css('display', 'none');
                }
            });

            // Updating Telephone Number
            $("#telephone_number").change(function(){
                var val = $(this).val();
                $("#tel_number_text").html(val);
            });

            $("#include_telephone_number").change(function(){
                var result_address = $("#include_address").is(":checked");
                var result_telephone = $("#include_telephone_number").is(":checked");
                // margin adjustments
                if(result_address && result_telephone){
                    $("#church_name_text").css('margin-top','0px');
                }else if(!result_address && !result_telephone){
                    $("#church_name_text").css('margin-top','40px');
                }else{
                    $("#church_name_text").css('margin-top','20px');
                }
                // showing hiding address
                if(result_telephone){
                    $("#tel_number_text").css('display', 'block');
                }else{
                    $("#tel_number_text").css('display', 'none');
                }
            });
            // end include telephone

            //
            $("#btn_save_certificate_settings").click(function(){
                var file_data = $('#upload_background_image').prop('files')[0];   
                var file_data_logo = $('#upload_logo').prop('files')[0];  

                console.log("file_data", file_data);

                // Upload Background Image
                var upload_background_image = new FormData();             
                upload_background_image.append('file', file_data);
                upload_background_image.append('file_to_exclude', 'logo.jpg');
                upload_background_image.append('file_to_exclude2', file_data_logo != undefined ? file_data_logo.name : localStorage.getItem('site_config')[0]['site_image']);
                upload_image(upload_background_image);
                
                // upload logo 
                var upload_logo = new FormData();             
                upload_logo.append('file', file_data_logo);
                upload_logo.append('file_to_exclude', 'logo.jpg');
                upload_logo.append('file_to_exclude2', file_data != undefined ? file_data.name : localStorage.getItem('site_config')[0]['site_background']);
                upload_image(upload_logo);

                // fetching of data
                // Church Name and Style
                var church_name = $("#church_name").val();
                var church_name_font_style = $("#church_name_font_style").find(":selected").text();
                var church_name_font_size = $("#church_name_font_size").val();
                var site_image = file_data_logo != undefined ? file_data_logo.name : localStorage.getItem('site_config')[0]['site_image'] == undefined ? "":localStorage.getItem('site_config')[0]['site_image'];
                var site_background = file_data != undefined ? file_data.name : localStorage.getItem('site_config')[0]['site_background'] == undefined ? "":localStorage.getItem('site_config')[0]['site_background'];
                var church_name = church_name == undefined ? localStorage.getItem('site_config')[0]['church_name']:church_name;
                var church_name_font_size = church_name_font_size == undefined ? localStorage.getItem('site_config')[0]['church_name_font_size']:church_name_font_size;
                var church_name_font_style = church_name_font_style == "Church Name Font Style" ? localStorage.getItem('site_config')[0]['church_name_font_style']:church_name_font_style;
                var site_config = [{
                    "site_image": site_image,
                    "site_background": site_background,
                    "certificate_of": "",
                    "list_of_sponsors": "",
                    "church_name": church_name,
                    "church_name_font_size": church_name_font_size,
                    "church_name_font_style": church_name_font_style,
                    "address": "",
                    "address_text_style": "",
                    "is_include_address": true,
                    "tel_number": "",
                    "tel_number_text_style": "",
                    "is_include_telephone": true
                }];

                
                localStorage.setItem('site_config', JSON.stringify(site_config));
                
                site_management();
            });

            function upload_image(myFiles){
                $.ajax({
                    type: 'POST',
                    url: 'index.php',
                    contentType: false,
                    processData: false,
                    data: myFiles,
                    cache: false,
                    error: function(e){
                        alert('Something Went Wrong');
                    }
                });
            }
        });
    </script>
  </body>
</html>