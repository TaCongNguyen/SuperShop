<?php $this->view("admin/header",$data); ?>

<?php $this->view("admin/sidebar",$data); ?>

<style type="text/css">
	
	.details{

		background-color: #eee;
		box-shadow: 0px 0px 10px #aaa;
		width: 100%;
		position: absolute;
		min-height: 100px;
		left: 0px;
		padding: 10px;
		z-index: 2;
	}

</style>
<table class="table table-striped table-advance table-hover">
 
		<?php if($mode == "read"):?>

			<thead>
				<tr><th>Tên</th><th>Chủ đề</th><th>Email</th><th>Tin nhắn</th><th>Ngày tạo</th><th>Hành động</th></tr>
			</thead>
			<tbody>

			<?php if(isset($messages) && is_array($messages)):?>
				<?php foreach($messages as $message):?>

					<tr style="position: relative;"><td><?=htmlspecialchars($message->name)?></td><td><?=htmlspecialchars($message->subject)?></td><td><?=htmlspecialchars($message->email)?></td><td><?=htmlspecialchars($message->message)?></td><td><?=date("jS M Y H:i a",strtotime($message->date))?></td>
	 
						<td>
							<a href="<?=ROOT?>admin/messages?delete=<?=$message->id?>">
							<i class="fa fa-trash-o"></i> Xoá
							</a>
						</td>
						
					</tr>
				<?php endforeach;?>
			<?php endif;?>

			<tr><td colspan="8"><?php Page::show_links();?></td></tr>

			</tbody>
		<?php elseif($mode == "delete_confirmed"):?>

			<div class="status alert alert-success" style="">Xoá thành công</div>
			<a href="<?=ROOT?>admin/messages">
			<input type="button" class="btn btn-success pull-right" value="Back to messages"/>
			</a>

		<?php elseif($mode == "delete" && is_object($messages)):?>
			
			<div class="status alert alert-danger" style="">Bạn có chắc muốn xoá</div>
			
			<thead>
				<tr><th>Tên</th><th>Chủ đề</th><th>Email</th><th>Tin nhắn</th><th>Ngày tạo</th><th>Hành động</th></tr>
			</thead>
			<tbody>

				<tr style="position: relative;"><td><?=htmlspecialchars($messages->name)?></td><td><?=htmlspecialchars($messages->subject)?></td><td><?=htmlspecialchars($messages->email)?></td><td><?=htmlspecialchars($messages->message)?></td><td><?=date("jS M Y H:i a",strtotime($messages->date))?></td>
				</tr>
				<a href="<?=ROOT?>admin/messages?delete_confirmed=<?=$messages->id?>">
				<input type="button" class="btn btn-warning pull-right" value="Xoá"/>
				</a>
			</tbody>

		<?php endif;?>


</table>
 

<?php $this->view("admin/footer",$data); ?>