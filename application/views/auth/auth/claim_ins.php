<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Klaim Data - Learning Management System Politeknik Pelayaran Sorong</title>
        <link href="<?=base_url('assets/css/styles.css')?>" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Klaim Data Instruktur</h3></div>
                                    <div class="card-body">

                                        <?php if($this->session->userdata('info')):?>
                                            <?php $warning = $this->session->flashdata('info')?>
                                            <div class="alert <?=$warning['class']?> alert-icon" role="alert">
                                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <div class="alert-icon-aside">
                                                    <i class="far <?=$warning['icon']?>"></i>
                                                </div>
                                                <div class="alert-icon-content">
                                                    <h6 class="alert-heading">Pemberitahuan</h6>
                                                     <?=$warning['message']?>
                                                </div>
                                            </div>
                                        <?php endif;?>

                                        <!-- Login form-->
                                        <form action="<?=base_url('auth/update_claim_ins')?>" method="post">
                                           	<input type="hidden" name="f_uc_person" value="<?=$rs_ins->uc?>">
                                           	<div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">NIK</label>
                                                <br/>
                                                <label><b><?=$rs_ins->id_number?></b></label>
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Nama Lengkap</label>
                                                <br/>
                                                <label><b><?=$rs_ins->full_name?></b></label>
                                            </div>
                                            
                                            
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <input type="submit" name="f_claim" class="btn btn-primary btn-block" value="Klaim Data !">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer mt-auto footer-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &#xA9; LMS - Politeknik Pelayaran Sorong 2021</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/js/scripts.js')?>"></script>


    </body>


</html>