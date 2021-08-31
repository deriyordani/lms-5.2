<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Register - Learning Management System Politeknik Pelayaran Sorong</title>
        <link href="<?=base_url('assets/css/styles.css')?>" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />
        <script data-search-pseudo-elements defer src="<?=base_url('assets/js/all.min.js')?>" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/js/feather.min.js')?>" crossorigin="anonymous"></script>
        <style type="text/css">
body {
   background: url('../assets/img/Background-LMS.jpg') no-repeat #dadada;
}
    
</style>
    </head>
    <body >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <!-- Basic registration form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                  
                                    <div class="card-body">

                                        <img class="text-center img-responsive rounded mx-auto d-block" width="30%" src="<?=base_url('assets/img/Logo-LMS.png')?>">

                                        <h3 class="font-weight-light my-4 text-center">Register Account E-learning</h3>
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
                                        <!-- Registration form-->
                                        <?=form_open('auth/store_register_NEW',array('name' => 'registration'))?>
                                            <div class="form-group">
                                                <label class="small mb-1" >Tipe Pengguna</label>
                                                <select name="f_type_user" class="form-control form-control-lg">
                                                    <option value="">---Pilih---</option>
                                                    <option value="2">Instruktur</option>
                                                    <option value="3">Peserta/Taruna</option>
                                                </select>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="small mb-1" >Nama Lengkap</label>
                                                <input class="form-control" name="f_nama_lengkap" type="text"  />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" >ID Number</label>
                                                <input type="text" name="f_id_number" class="form-control" required="">
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" >Email</label>
                                                <input class="form-control" name="f_email" type="text"   />
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" >Username</label>
                                                <input class="form-control" name="f_username" type="text"   />
                                            </div>

                                           <div class="form-row">
                                                <div class="col-md-6">
                                                    <!-- Form Group (password)-->
                                                    <div class="form-group">
                                                        <label class="small mb-1" >Password</label>
                                                        <input class="form-control" name="f_password" id="inputPassword"  type="password"   />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Form Group (confirm password)-->
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Ulangi Password</label>
                                                        <input class="form-control" name="f_password_confirm" id="inputConfirmPassword" type="password"   />
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <!-- Form Group (create account submit)-->
                                            <div class="form-group mt-4 mb-0">
                                                <input type="submit" name="f_save" class="btn btn-primary btn-block" value="Register">
                                                
                                            </div>
                                        <?=form_close()?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?=base_url('auth/login')?>">Sudah Punya Akun ? Kembali Ke Laman Login</a></div>
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
       
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6188dbcf6db522f0","si":10,"version":"2021.1.1"}'></script>

        <script type="text/javascript">
            $(document).ready(function(){

                $('select[name=f_type_user]').change(function(){
            
                    var uc = $(this).val();

                    if (uc == '2') {
                        $('.instruktur-show').css({'display' : 'block'});
                        $('.student-show').css({'display' : 'none'});
                    }else{
                        $('.student-show').css({'display' : 'block'});
                        $('.instruktur-show').css({'display' : 'none'});
                    } 

                });


                $("form[name='registration']").validate({
                    // Specify validation rules
                    rules: {
                      // The key name on the left side is the name attribute
                      // of an input field. Validation rules are defined
                      // on the right side
                        f_nama_lengkap: "required",
                        f_username: "required",
                      // lastname: "required",
                        f_email: {
                            required: true,
                            // Specify that email should be validated
                            // by the built-in "email" rule
                            f_email: true
                          },
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
                      f_nama_lengkap: "Harap Masukan Nama Lengkap",
                      f_username: "Harap Masukan Username",
                      // lastname: "Please enter your lastname",
                      f_password: {
                        required: "Berikan Kata Sandi",
                        minlength: "Kata sandi Anda setidaknya harus terdiri dari 6 karakter"
                      },
                      f_email: "Harap Masukan Email Dengan Benar",
                      f_password_confirm: {
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
