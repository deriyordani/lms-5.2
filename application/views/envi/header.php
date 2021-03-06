<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Dashboard - LMS Poltekpel Sorong</title>
        <link href="<?=base_url('assets/css/styles.css')?>" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/third_party/fontawesome-5.13.0/css/all.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/third_party/jquery-ui/jquery-ui.css');?>" /> 
        
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
         <script src="<?=base_url('assets/js/jquery-3.5.1.min.js')?>" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
         <script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>

        <script type="text/javascript" src="<?=base_url('assets/third_party/jquery-ui/jquery-ui.js');?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/third_party/jquery-ui/jquery-timepicker.js');?>"></script>

        <script src="<?=base_url('assets/third_party/tinymce/tinymce.min.js')?>" ></script>

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

    </head>
    
    <div id="base-url" style="display: none" ><?=base_url()?></div>
    <body class="nav-fixed " onload="display_ct()">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand" href="#">
                <img class="" style="height: 40px;" src="<?=base_url('assets/img/favicon.png')?>"> &nbsp; E-LEARNING</a>
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Search Input-->
            
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ml-auto">
               
  
               
                <!-- User Dropdown-->
                <?php
                    if($this->session->userdata('log_photo') == NULL){
                        $url = base_url('assets/img/illustrations/profiles/profile-1.png');
                    }else{
                        $url = base_url('uploads/photo/'.$this->session->userdata('log_photo'));
                    }
                ?>
                <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?=$url?>" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="<?=$url?>" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?=$this->session->userdata('log_username')?></div>
                                <div class="dropdown-user-details-email"><?=$this->session->userdata('log_email')?></div>
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
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                      <?php $this->load->view('envi/menu')?>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title">

                                <?php 

                                    $session_category = $this->session->userdata('log_category');

                                    if ($session_category == 1) {
                                        echo "Administrator";
                                    }elseif ($session_category == 2) {
                                        echo "Instructor";
                                    }
                                    elseif ($session_category == 3) {
                                        echo "Peserta Diklat";
                                    }
                                    elseif ($session_category == 4) {
                                        echo "Operator Prodi";
                                    }elseif ($session_category == 5) {
                                        echo "Operator DKP";
                                    }

                                ?>
                               
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>