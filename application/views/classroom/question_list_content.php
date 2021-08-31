<div class="row">							
	<div class="col-md-12 border" style="height:375px; overflow-y: scroll;">
		<table class="table">
			<?php if ($q_typ == "bank") : ?>
				<thead class="bg-primary text-white">
			<?php else : ?>
				<thead class="bg-success text-white">
			<?php endif; ?>	
				<tr>
					<th width="5">No.</th>
					<th width="5">Pick</th>
					<th width="400">Question Title</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($q_res)) : ?>
					<?php $i=1; ?>
					<?php foreach($q_res as $qb) : ?>
						<tr>
							<?php 
								switch ($qb->question_type) {
									case 1 : 	$icon = "fa-list";
												break;
									case 2 : 	$icon = "fa-toggle-on";
												break;
									case 3 : 	$icon = "fa-edit";
												break;						

								}

							?>	

							<td class="text-right"><?=$i?>.</i></td>
							<td class="text-right">
								<input class="form-check-input" type="checkbox" name="ucq[]" value="<?=$qb->uc?>">
								<i class="fa <?=$icon?>">
							</td>
							<td width="400">
								<a href="#" class="peek-question" uc-question="<?=$qb->uc?>"><?=read_text($qb->question_title)?></a> <br />
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				<?php else : ?>
					<tr><td colspan="4" class="text-center"><span class="badge badge-danger text-white" style="font-size: 1.2em">Empty </span></td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row mt-2">
	<?php if ($q_typ == "bank") : ?>

		<div class="col-md-9 text-center">
			<h5>
				<small class="text-primary">
					<b><?=$q_amt?></b> <span class="small text-dark">Question(s)</span> 
				</small>
			</h5>
		</div>
		<div class="col-md-3 text-right">
			<button type="submit" name="f_add_picked" class="btn btn-warning btn-sm">Add &nbsp;<i class="fa fa-angle-double-right"></i></button>
		</div>

	<?php else : ?>

		<div class="col-md-3 text-left">
			<button type="submit" name="f_add_picked" class="btn btn-warning btn-sm"><i class="fa fa-angle-double-left"></i>&nbsp; Remove </button>
		</div>
		<div class="col-md-6 text-center">
			<h4><small class="text-danger"><b><?=$q_amt?></b> <span class="small text-dark">Question(s)</span> </small></h4>
		</div>
		<div class="col-md-3 text-right">
			<a href="<?=base_url('classroom/set_bobot/'.$uc_assessment)?>" class="btn btn-primary btn-sm text-right">								
				<i class="fa fa-save"></i>&nbsp; Save
			</a>
		</div>
	<?php endif; ?>
	
</div>

<div class="modal" id="question-detail">
	<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Question Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
			</div>

		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		var base_url = $("#base-url").html();

		$('.peek-question').click(function(){			
			var uc_question	= $(this).attr('uc-question');

			$('#question-detail .modal-content').html('');
			$('#question-detail .modal-content').load(base_url + 'question/view', { js_uc_question : uc_question });
			$('#question-detail').modal('show');

			return false;
		});
		/*
		$('#qbank-search').click(function(){
			var uc_competency 	= $(this).attr('uc-competency');
			var key 			= $('input[name=f_key_qbank]').val();
			var uc_picked 		= $('input[name=f_uc_picked]').val();
			var type			= 'bank';

			$('#bank-list').load(base_url + 'package/search_question', { js_key : key, js_uc_competency : uc_competency, js_uc_picked : uc_picked, js_type : type });

			return false;
		});

		$('#qpick-search').click(function(){
			var uc_competency 	= $(this).attr('uc-competency');
			var key 			= $('input[name=f_key_qbank]').val();
			var uc_picked 		= $('input[name=f_uc_picked]').val();
			var type			= 'pick';

			$('#pick-list').load(base_url + 'package/search_question', { js_key : key, js_uc_competency : uc_competency, js_uc_picked : uc_picked, js_type : type });

			return false;
		});

		$('#qbank-clear').click(function(){
			var uc_competency 	= $(this).attr('uc-competency');
			var key 			= "";
			var uc_picked 		= $('input[name=f_uc_picked]').val();
			var type			= 'bank';

			$('input[name=f_key_qbank]').val('');

			
			$('#bank-list').load(base_url + 'package/search_question', { js_key : key, js_uc_competency : uc_competency, js_uc_picked : uc_picked, js_type : type });

			return false;
		});

		$('#qpick-clear').click(function(){
			var uc_competency 	= $(this).attr('uc-competency');
			var key 			= "";
			var uc_picked 		= $('input[name=f_uc_picked]').val();
			var type			= 'pick';

			$('input[name=f_key_qpick]').val('');

			
			$('#pick-list').load(base_url + 'package/search_question', { js_key : key, js_uc_competency : uc_competency, js_uc_picked : uc_picked, js_type : type });

			return false;
		});

		*/
	});
</script>