<? include "config/translate.php"; ?>
		<div class="modal-body">
			<form id="blockeditform" method="post" action="Block!save">
				<input type="hidden" name="block_id" id="block_id" value='<?=$obj["block_id"]?>'/>
				<input type="hidden" name="id" value="<?=$obj["id"]?>" id="id"/>
				<input type="hidden" name="input_tm" value="<?= $obj["input_tm"]?>" id="input_tm"/>
				<div class="form-group">
					<label><?=$tname?></label>
					<input class="form-control" placeholder="Enter text" type="text" name="block_name" id="block_name" value="<?=$obj["block_name"]?>"/>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="doClose()"><?=$tclose?></button>
			<button type="button" class="btn btn-primary" onclick="add()"><?=$tsave?></button>
		</div>
