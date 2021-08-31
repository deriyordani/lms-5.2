<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Question Bank
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-header-actions">
            <div class="card-header">
               Daftar Question
               <a href="<?=base_url('question/add/'.$uc_classroom.'/'.$uc_diklat_class)?>" class="btn btn-primary btn-sm">
                   Add
               </a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control form-control-lg">
                                <option>---Pilih Subject---</option>
                            </select>
                       
                        </div>
                        
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control form-control-lg">
                                <option>---Pilih Type---</option>
                            </select>
                       
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                         <button class="btn btn-info" type="button">Search</button>
                    </div>
                   
                </div>
               <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td class="text-primary" width="5%">No</td>
                                <td class="text-primary">Title</td>
                                <td class="text-primary">Subject</td>
                                <td class="text-primary">Type</td>
                                <td class="text-primary">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i=1; $i < 5 ; $i++):?>
                                <tr>
                                    <td width="5%"><?=$i?></td>
                                    <td>Loren ipson dollar is asmet</td>
                                    <td width="20%">Mata Pelajaran <?=$i?></td>
                                    <td width="15%">Multiple Choice</td>
                                    
                                    <td width="17%">
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark">
                                            <i class="mr-1" data-feather="search"></i>
                                        </button>

                                        <button class="btn btn-datatable btn-icon btn-transparent-dark">
                                            <i class="mr-1" data-feather="edit-2"></i>
                                        </button>

                                        <button class="btn btn-datatable btn-icon btn-transparent-dark">
                                            <i class="mr-1" data-feather="trash-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                    
               </div>
            </div>
        </div>
        </div>
        
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Diklat Add</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Level</label>
                    <select name="f_level" class="form-control form-control-lg">
                        <option> --- Pilih ---- </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Periode Mulai</label>
                    <input type="number" name="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Periode Akhir</label>
                    <input type="number" name="" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button">Simpan</button>
            </div>
        </div>
    </div>
</div>