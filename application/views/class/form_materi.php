<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Add - Materi Pembelajaran
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('classroom/task')?>" class="btn btn-sm btn-light text-primary active mr-2">
                        <i data-feather="arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class=" col-md-8 mx-auto ">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 230px;"></textarea>
            </div>

            <div class="form-group">
                <label>Lampiran</label>
                <input type="file" class="form-control" name="">
            </div>

            <input type="submit" class="btn btn-success" value="Kirim" name="">
        </div>
        
    </div>
</div>