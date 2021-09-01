<?php if(isset($result)):?>

	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
		            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
		                <thead>
		                    <tr class="btn-light">
		                        <td class="text-primary text-center" width="5%">No</td>
		                        <td class="text-primary text-center">Tgl. Jam Kehadiran</td>
		                        <td class="text-primary text-center">Status</td>
		                    </tr>
		                </thead>

		                <tbody>
		                    <?php $no = $numbering;?>
		                    <?php foreach($result as $row):?>
		                        <tr>
		                            <td><?=$no?></td>
		                            <td><?=time_format($row->date_time,'d M Y H:i')?></td>
		                            <td class="text-center">
		                            	<?php 
		                            		if ($row->status == 1) {
		                            			echo "<span class=\"badge badge-success\">Hadir</span>";
		                            		}elseif ($row->status == 2) {
		                            			echo "<span class=\"badge badge-warning\">Sakit</span>";
		                            		}
		                            		elseif ($row->status == 3) {
		                            			echo "<span class=\"badge badge-info\">Ijin</span>";
		                            		}
		                            	?>
		                            </td>
		                        </tr>

		                          <?php $no++;?>
		                   	<?php endforeach;?>

		                </tbody>

		            </table>
		        </div>
			</div>
		</div>
        
   	</div>

	<div class="col-md-12 mt-2 page-subject">
        <?php if (isset($pagination)) : ?>
            <?=$pagination?>
        <?php endif; ?>
    </div>

<?php else:?>
    <div class="col-md-12">
        <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
    </div>
<?php endif;?>