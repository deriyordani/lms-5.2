<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Lupa Password - Learning Management System Politeknik Pelayaran Sorong</title>
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
                                <!-- Basic forgot password form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Password Recovery</h3></div>
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

                                       
                                        <?=form_open('auth/store_change_password', array('name' => 'forgotPass'))?>
                                        <input type="hidden" name="f_uc" value="<?=$uc?>">
                                            <div class="form-group">
                                                <label>Password Baru</label>
                                                <input type="password" name="f_password" placeholder="Masukan Password!" class="form-control">
                                            </div>
                                             <div class="form-group">
                                                <label>Ulangi Password</label>
                                                <input type="password" name="f_password_ulangi" placeholder="Ulangi Password!" class="form-control">
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="<?=base_url('auth/login')?>">Kembali ke Laman Login</a>
                                                <input type="submit" class="btn btn-primary" name="f_store" value="Reset Password">
                                            </div>
                                        <?=form_close()?>
                                    </div>
                                    <div class="card-footer text-center">
                                       <div class="small"><a href="<?=base_url('auth/register')?>">Belum Memiliki Akun ? Daftar disini !</a></div>
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
         <script src="<?=base_url('assets/js/jquery.validate.min.js')?>"></script>

          <script type="text/javascript">
            $(document).ready(function(){


                $("form[name='forgotPass']").validate({
                    // Specify validation rules
                    rules: {
                     
                        f_password: {
                            required: true,
                            minlength: 6
                        },
                        f_password_confirm: {
                            required: true,
                            minlength: 6,
                            equalTo: "#inputPassword"
                        }
                    },
                    // Specify validation error messages
                    messages: {
                     
                      f_password: {
                        required: "Berikan Kata Sandi",
                        minlength: "Kata sandi Anda setidaknya harus terdiri dari 6 karakter"
                      },
                      f_password_ulangi: {
                            required: "Berikan Kata Sandi",
                            minlength: "Kata sandi Anda setidaknya harus terdiri dari 6 karakter",
                            equalTo: "Silakan masukkan kata sandi yang sama "
                        },
                    },
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                    submitHandler: function(form) {
                      form.submit();
                    }
                  });
            });
        </script>
    </body>

</html>
