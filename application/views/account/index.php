<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-2">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa fa-user"></i> 
                        </div>
                        Profile
                    </h1>
                </div>
                
            </div>
        </div>
    </div>
</header>

<div class="container">

   <!--  <div class="row">
        <div class="col-md-4">
            
            <a href="<?=base_url('student/classroom')?>" class="btn btn-dark">Kembali</a>
        </div>
    </div> -->

     <?=form_open_multipart('account/update_profile')?>
    <div class="row mt-5">
   
        <div class="col-md-4">
            <!-- Profile picture card-->
            <div class="card">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <?php
                        $img = ($row->photo == NULL ? 'assets/img/illustrations/profiles/profile-1.png' : 'uploads/photo/'.$row->photo);
                    ?>
                    <img class="img-account-profile rounded-circle mb-2" src="<?=$img?>" alt />
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">Replace With</div>
                    <!-- Profile picture upload button-->
                    <input type="file" name="f_photo" class="form-control">

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                   
                    <input type="hidden" name="f_uc_user" value="<?=$row->uc?>">
                    <input type="hidden" name="f_uc_person" value="<?=$row->uc_person?>">
                    <input type="hidden" name="f_photo_old" value="<?=$row->photo?>">

                        <div class="form-group">
                             <label>Username</label>
                             <input type="text" class="form-control" name="f_username" value="<?=$row->username?>">
                        </div>

                        <div class="form-group">
                             <label>Nama Lengkap</label>
                             <input type="text" class="form-control" name="f_full_name" value="<?=$full_name?>">
                        </div>

                        <div class="form-group">
                             <label>Email</label>
                             <input type="text" class="form-control" name="f_email" value="<?=$row->email?>">
                        </div>

                        <div class="form-group">
                             <label>Password Lama</label>
                             <input type="password" class="form-control" name="f_password_now" >
                        </div>

                        <div class="form-group">
                             <label>Password Baru</label>
                             <input type="password" class="form-control" name="f_password_new">
                             <span class="text-muted">*) Kosongkan jika tidak akan diubah</span>
                        </div>
                        
                        <!-- Save changes button-->
                         <input type="submit" name="f_submit" class="btn btn-primary mt-2" value="Simpan Profile" >
                    
                </div>
            </div>
        </div>
    
    </div>
    <?=form_close()?>    

</div>