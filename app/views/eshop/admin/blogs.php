
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

			<a href="<?=ROOT?>admin/blogs?add_new=true">
				<input type="button" class="btn btn-warning pull-right" value="Thêm bài">
			</a>

			<thead>
				<tr><th>Tiêu đề</th><th>Người tạo</th><th>Nội dung</th><th>Hình ảnh</th><th>Ngày tạo</th><th>Hành động</th></tr>
			</thead>
			<tbody>

			<?php if(isset($blogs) && is_array($blogs)):?>
				<?php foreach($blogs as $blog):?>

					<tr style="position: relative;"><td><?=$blog->title?></td><td><a href="<?=ROOT?>profile/<?=$blog->user_url?>"><?=$blog->user_data->name?></a></td><td><?=nl2br(htmlspecialchars(substr($blog->post,0,200)))?></td><td><img src="<?=ROOT.$blog->image?>" style="width:150px;" /></td><td><?=date("jS M Y H:i a",strtotime($blog->date))?></td>
	 
						<td>
							
							<a href="<?=ROOT?>admin/blogs?edit=<?=$blog->url_address?>">
								<i class="fa fa-pencil"></i> Sửa
							</a>

							<a href="<?=ROOT?>admin/blogs?delete=<?=$blog->url_address?>">
								<i class="fa fa-trash-o"></i> Xoá
							</a>

						
						</td>
						
					</tr>
				<?php endforeach;?>
			<?php endif;?>
				<tr><td colspan="6"><?php Page::show_links()?></td></tr>
			</tbody>

			

		<?php elseif($mode == "edit"):?>

			<?php if(isset($errors)):?>
			<div class="status alert alert-danger" ><?=$errors?></div>
			<?php endif;?>

			<h2>Sửa bài đăng</h2>
			<form method="post" enctype="multipart/form-data">
				
				<label for="title">Tiêu đề</label>
				<input id="title" class="form-control" value="<?=isset($POST['title']) ? $POST['title']:'';?>" type="text" name="title">

				<label for="image">Hình ảnh</label>
				<input id="image" class="form-control" type="file" name="image">
				<input type="hidden" name="url_address" value="<?=isset($POST['url_address']) ? $POST['url_address']:'';?>">

				<label for="post">Nội dung</label>
				<textarea id="post" class="form-control" name="post"><?=isset($POST['post']) ? $POST['post']:'';?></textarea>
 				<br>
 				<input type="submit" class="btn btn-success pull-right" value="Save">
				<hr>
				<img src="<?=ROOT?><?=isset($POST['image']) ? $POST['image']:'';?>" style="width: 400px;">
			</form>

		<?php elseif($mode == "add_new"):?>

			<?php if(isset($errors)):?>
			<div class="status alert alert-danger" ><?=$errors?></div>
			<?php endif;?>

			<h2>Thêm bài</h2>
			<form method="post" enctype="multipart/form-data">
				
				<label for="title">Tiêu đề</label>
				<input id="title" class="form-control" value="<?=isset($POST['title']) ? $POST['title']:'';?>" type="text" name="title">

				<label for="image">Hình ảnh</label>
				<input id="image" class="form-control" type="file" name="image">

				<label for="post">Nội dung</label>
				<textarea id="post" class="form-control" name="post"><?=isset($POST['post']) ? $POST['post']:'';?></textarea>
 				<br>
 				<input type="submit" class="btn btn-success pull-right" value="Post">
				
			</form>

		<?php elseif($mode == "delete_confirmed"):?>

			<div class="status alert alert-success" style="">Xoá thành công</div>
			<a href="<?=ROOT?>admin/blogs">
			<input type="button" class="btn btn-success pull-right" value="Back to posts"/>
			</a>

		<?php elseif($mode == "delete" && is_object($blogs)):?>
			
			<div class="status alert alert-danger" style="">Bạn có chắc muốn xoá?</div>
			
			<thead>
				<tr><th>Tiêu đề</th><th>Người đăng</th><th>Bài</th><th>Hình ảnh</th><th>Ngày đăng</th><th>Hành động</th></tr>
			</thead>
			<tbody>

				<tr style="position: relative;"><td><?=$blogs->title?></td><td><a href="<?=ROOT?>profile/<?=$blogs->user_url?>"><?=$blogs->user_data->name?></a></td><td><?=$blogs->post?></td><td><img src="<?=ROOT.$blogs->image?>" style="width:150px;" /></td><td><?=date("jS M Y H:i a",strtotime($blogs->date))?></td>
				</tr>
				<a href="<?=ROOT?>admin/blogs?delete_confirmed=<?=$blogs->url_address?>">
				<input type="button" class="btn btn-warning pull-right" value="Delete"/>
				</a>
			</tbody>

		<?php endif;?>


</table>
 

<?php $this->view("admin/footer",$data); ?>