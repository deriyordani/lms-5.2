<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Dashboard - LMS Poltek Pel Sorong</title>
        <link href="<?=base_url('assets/css/styles-student.css')?>" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />


        <link href="<?=base_url('assets/third_party/bootstrap-datepicker/css/bootstrap-datepicker.min.css')?>" rel="stylesheet">

        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       
        <script src="<?=base_url('assets/js/jquery-3.5.1.min.js')?>" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
         <script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>
         <script>


            
            
        function goBack() {
          window.history.back();
        }



        </script>


        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/third_party/bootstrap-datepicker/bootstrap-datepicker.css')?>">

    <script type="text/javascript" src="<?=base_url('assets/third_party/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>"></script>
 

    </head>
    
    
    <body class="nav-fixed sidenav-toggled">
        <div id="base-url" style="display: none"><?=base_url()?></div>
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Navbar Brand-->
            <!-- * * Tip * * You can use text or an image for your navbar brand.-->
            <!-- * * * * * * When using an image, we recommend the SVG format.-->
            <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
            <a class="navbar-brand" href="<?=base_url('classroom')?>">E-Learning</a>
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
                <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="mr-2" data-feather="bell"></i>
                            Alerts Center
                        </h6>
                        <!-- Example Alert 1-->
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 29, 2020</div>
                                <div class="dropdown-notifications-item-content-text">This is an alert message. It&apos;s nothing serious, but it requires your attention.</div>
                            </div>
                        </a>
                        <!-- Example Alert 2-->
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 22, 2020</div>
                                <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
                            </div>
                        </a>
                        <!-- Example Alert 3-->
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 8, 2020</div>
                                <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
                            </div>
                        </a>
                        <!-- Example Alert 4-->
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 2, 2020</div>
                                <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
                    </div>
                </li>
               
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?=$this->session->userdata('log_full_name')?></div>
                                <div class="dropdown-user-details-email"><?=($this->session->userdata('log_category') == 2 ? 'Instruktur' : 'Peserta Diklat')?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=base_url('setting/account')?>">
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