<? include "translate/translate.php"; ?>
		<div class="modal-body">
			
			<form id="feededitform" method="post" action="Block!save">
				<input type="hidden" name="feed_id" id="feed_id" value='<?=$obj["feed_id"]?>'/>
				<input type="hidden" name="input_tm" value="<?= $obj["input_tm"]?>" id="input_tm"/>
				<div class="form-group">
					<label>FeedURL</label>
					<input class="form-control" placeholder="Enter text" type="text" name="url" id="url" value="<?=$obj["url"]?>"/>
				</div>
			</form>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" onclick="doClose()"><?=$tclose?></button>
			<button type="button" class="btn btn-primary" onclick="add()"><?=$tsave?></button>
		</div>
