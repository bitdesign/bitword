<? include "config/translate.php"; ?>
		<div class="modal-body">
			<div class="form-group">
				<label><?=$timage[$lan]?></label>
				<input class="form-control" placeholder="Enter text" type="text" id="txt" name="fileNameIsted" value="<?=$obj["dsp_img"]?>"/>
			</div>
			<form id="blockeditform" method="post" action="Block!save">
				<input type="hidden" name="dsp_img"  id="dsp_img" value='<?=$obj["dsp_img"]?>'/>
				<input type="hidden" name="block_id" id="block_id" value='<?=$obj["block_id"]?>'/>
				<input type="hidden" name="id" value="<?=$obj["id"]?>" id="id"/>
				<input type="hidden" name="input_tm" value="<?= $obj["input_tm"]?>" id="input_tm"/>
				<div class="form-group">
					<label><?=$tname[$lan]?></label>
					<input class="form-control" placeholder="Enter text" type="text" name="block_name" id="block_name" value="<?=$obj["block_name"]?>"/>
				</div>
			</form>
			<div class="form-group">
				<input  type="file"   class="input_file_hidden" id="image" name="image" onchange="setFileName(this.value)" accept="image/*"/>
				<img data-toggle="tooltip" title="<?=$tuploadtips[$lan]?>" onclick="$('#image').trigger('click');" style="border:1px solid red;width:100%; height:100px;" src='<?=$obj["dsp_img"]?>' id="echoimg"/>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="doClose()"><?=$tclose[$lan]?></button>
			<button type="button" class="btn btn-primary" onclick="add()"><?=$tsave[$lan]?></button>
		</div>
