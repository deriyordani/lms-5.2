<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Dashboard - LMS Poltek Pel Sorong</title>


        <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />


        <link href="<?=base_url('assets/css/styles-student.css')?>" rel="stylesheet" />
        <!--
        <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="<?=base_url('assets/third_party/bootstrap-datepicker/css/bootstrap-datepicker.min.css')?>" rel="stylesheet">
        -->
        
        <link rel="stylesheet" href="<?=base_url('assets/third_party/jquery-ui/jquery-ui.css');?>" /> 

        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/js/jquery-3.5.1.min.js')?>" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>

        <script type="text/javascript" src="<?=base_url('assets/third_party/jquery-ui/jquery-ui.js');?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/third_party/jquery-ui/jquery-timepicker.js');?>"></script>
        
        <script src="<?=base_url('assets/third_party/tinymce/tinymce.min.js')?>" ></script>

        <script src="<?=base_url('assets/js/idleTime.js')?>"></script>

        <script>
            function goBack() {
              window.history.back();
            }

            function display_c(){
                var refresh=1000; // Refresh rate in milli seconds
                mytime=setTimeout('display_ct()',refresh)
            }

            function display_ct() {
                var x = new Date()
                var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
                x1 =  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
                 $('#time').html(x1);
                //document.getElementById('time').innerHTML = x1;
                display_c();
             }
        </script>

        <script type="text/javascript">
            $(function(){
                $( ".datepicker").datepicker({
                    showButtonPanel: true
                });

                $( ".timepicker").timepicker();
                $( ".datetimepicker").datetimepicker();
            });
        </script>


    </head>
    
 
    
    <body class="nav-fixed sidenav-toggled" onload="display_ct()">
        <div id="category-sess" style="display: none" ><?=$this->session->userdata('log_category')?></div>
        <div id="base-url" style="display: none"><?=base_url()?></div>
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand" href="#">
                <img class="" style="height: 40px;" src="<?=base_url('assets/img/favicon.png')?>"> &nbsp; E-LEARNING</a>
            <!-- Sidenav Toggle Button-->
            <a onclick="goBack()" class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" title="Kembali Kehalaman Sebelumnya">
                <i data-feather="arrow-left-circle" title="Back to Dashboard"></i>
            </a>
          <!--  <button  ></button> -->
            <!-- Navbar Search Input-->

           <!--  <form class="form-inline mr-auto d-none d-md-block mr-3">
                <div class="input-group input-group-joined input-group-solid">
                    <input type="submit" class="btn btn-primary" value="Dashboard" name="">
                </div>
            </form> -->
            
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ml-auto">

               
               
                <!-- Alerts Dropdown-->
               
               
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <?php if($this->session->userdata('log_photo') != NULL):?>
                                <img class="img-fluid" src="<?=base_url('uploads/photo/'.$this->session->userdata('log_photo'))?>" />
                            <?php else:?>
                                <img class="img-fluid" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>" />
                            <?php endif;?>

                    
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <?php if($this->session->userdata('log_photo') != NULL):?>
                                <img class="dropdown-user-img" src="<?=base_url('uploads/photo/'.$this->session->userdata('log_photo'))?>" />
                            <?php else:?>
                                <img class="dropdown-user-img" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>" />
                            <?php endif;?>
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?=$this->session->userdata('log_username')?></div>
                                <div class="dropdown-user-details-email">
                                    
                                        <?php 

                                            if($this->session->userdata('log_category') == 2){
                                                $role = "Instruktur";
                                                $logout = base_url('auth/logout');
                                            }elseif ($this->session->userdata('log_category') == 3) {
                                                $role = "Peserta Diklat";
                                                $logout = base_url('auth/logout');
                                            }
                                            elseif ($this->session->userdata('log_category') == 4) {
                                                $role = "Operator Prodi";
                                                $logout = base_url('monitoring/login/logout');
                                            }else{
                                                 $role = "Administrator";
                                                 $logout = base_url('auth/logout_admin');
                                            }

                                        ?>

                                        <?=$role?>
                                </div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('account')?>">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a>
                        <a class="dropdown-item" href="<?=base_url('auth/logout')?>">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            
            <div id="layoutSidenav_content">
                <main>