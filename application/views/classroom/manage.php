<header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-1" >
    <div class="container" style="min-height: 90px">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-2">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="tag"></i></div>
                        [<?=$info->class_label?>] <?=$info->subject_title?>
                    </h1>
                    <div class="page-header-subtitle"><?=$info->full_name?></div>
                    <div class="page-header-subtitle">
                        <?=$info->diklat?>

                        | Tahun/Periode : <?php if($info->cat_diklat == 1):?>
                            <?=$info->tahun?>
                        <?php else:?>
                            <?=time_format($info->periode_mulai, 'd M Y').'<br/> s/d <br/>'.time_format($info->periode_selesai, 'd M Y')?>
                        <?php endif;?>
                         <br/>
                        <b><?=$info->prodi?><?=$info->label_dkp?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

            <?php $this->load->view('classroom/menu_activity');?>

        
       </div>

        <div class="col-md-9">
            
            <div class="card card-collapsable">
                <a class="card-header" href="#collapseCardExample" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <div class="avatar avatar-xl">
                        <img class="avatar-img img-fluid" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>">
                    </div>
                    Umumkan Sesuatu Ke Kelas Anda !
                    <div class="card-collapsable-arrow">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 116px;">Umumkan Sesuatu Di Kelas Anda ....</textarea>
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control"  name="">
                        </div>

                       <button type="button" class="btn btn-success float-right mb-3"><i class="ion ion-md-create"></i>&nbsp; Posting</button> 
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                     <div class="card mb-4">
                         <div class="card-header">
                             <div class="media flex-wrap w-100 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg" class="d-block ui-w-40 rounded-circle" alt="">
                                 <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">Tom Harry</a>
                                     <div class="text-muted small">13 days ago</div>
                                 </div>
                                 <div class="text-muted small ml-3">
                                     <div>Member since <strong>01/1/2019</strong></div>
                                     <div><strong>134</strong> posts</div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body">
                             <p> For me, getting my business website made was a lot of tech wizardry things. Thankfully i get an ad on Facebook ragarding commence website. I get connected with BBB team. They made my stunning website live in just 3 days.
                                 With the increase demand of online customers. I had to take my business online. BBB Team guided me at each step and enabled me to centralise my work and have control on all aspect of my online business.
                             </p>
                             <p> For me, getting my business website made was a lot of tech wizardry things. Thankfully i get an ad on Facebook ragarding commence website. I get connected with BBB team. They made my stunning website live in just 3 days.
                                 With the increase demand of online customers. I had to take my business online. BBB Team guided me at each step and enabled me to centralise my work and have control on all aspect of my online business.
                             </p>
                         </div>
                         <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                             <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true"> <i class="fa fa-heart text-danger"></i>&nbsp; <span class="align-middle">445</span> </a> <span class="text-muted d-inline-flex align-items-center align-middle ml-4"> <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span> </span> </div>
                             <div class="px-4 pt-3"> <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Reply</button> </div>
                         </div>
                     </div>
                 </div>
             </div>

        </div>
       
    </div>

</div>