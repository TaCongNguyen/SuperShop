<?php

$start = memory_get_usage();
$startTime = microtime(true);
require 'CSRF.php';
$ss = CSRF::init();

if (empty($_POST)) {
    $ss->validate();
}
$endTime = (round(microtime(true) - $startTime, 5));
echo '<pre>';
echo 'Memory Usaged: ', (memory_get_usage() - $start) / 1024, 'KB <br/>';
echo 'Timeline: ', $endTime, 'seconds' ,'<br/>' ;
echo  'token ẩn:', $ss->getToken();
echo '</pre>';

?>
<?php require('connect.php');?>
<?php $this->view("header",$data); ?>

	<section>
		<div class="container">
			<div class="row">

				<?php $this->view("sidebar.inc",$data); ?>
					
				<div class="col-sm-9">

					<?php if(isset($row) && is_object($row)):?>

						<div class="blog-post-area">
							<h2 class="title text-center">Mới nhất từ chúng tôi</h2>
							<div class="single-blog-post">
								<h3><?=htmlspecialchars($row->title)?></h3>
								<div class="post-meta">
									<ul>
										<li><i class="fa fa-user"></i><?=$row->user_data->name?></li>
										<li><i class="fa fa-clock-o"></i><?=date("H:i a",strtotime($row->date))?></li>
										<li><i class="fa fa-calendar"></i><?=date("M jS, Y",strtotime($row->date))?></li>
									</ul>
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</div>
								<img src="<?=ROOT . $row->image?>" style="width: 100%;" alt="<?=htmlspecialchars($row->title)?>">
								<br><br>
								<p><?=nl2br(htmlspecialchars($row->post))?></p>

								<div class="pager-area">
									<ul class="pager pull-right">
										<li><a href="#">Trước</a></li>
										<li><a href="#">Sau</a></li>
									</ul>
								</div>
							</div>
						</div><!--/blog-post-area-->

						<div class="rating-area">
							<ul class="ratings">
								<li class="rate-this">Đánh giá</li>
								<li>
									<i class="fa fa-star color"></i>
									<i class="fa fa-star color"></i>
									<i class="fa fa-star color"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</li>
								<li class="color">(6 votes)</li>
							</ul>
							<ul class="tag">
								<li>TAG:</li>
								<li><a class="color" href="">Áo thun <span>/</span></a></li>
								<li><a class="color" href="">T-Shirt <span>/</span></a></li>
								<li><a class="color" href="">Bé gái</a></li>
							</ul>
						</div><!--/rating-area-->

						<div class="socials-share">
							<a href=""><img src="images/blog/socials.png" alt=""></a>
						</div><!--/socials-share-->
						<div>	
							<div class="panel panel-default">
							<div class="panel-heading">Đăng bình luận</div>
							<div class="panel-body">
								<form method="post">
								<div class="form-group">
									<label for="exampleInputEmail1">Tên</label>
									<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Email </label>
									<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Nội dung</label>
									<textarea name="subject" class="form-control" rows="3"></textarea>
								</div>
								<button type="submit" class="btn btn-primary">Đăng</button>
								</form>
							</div>
							</div>
						
						</div>
					<!--Comments-->
					<?php
					if(isset($_POST) & !empty($_POST)){
						$name = mysqli_real_escape_string($connection, $_POST['name']);
						$email = mysqli_real_escape_string($connection, $_POST['email']);
						$subject = mysqli_real_escape_string($connection, $_POST['subject']);
					 
						$isql = "INSERT INTO comments (name, email, subject, status) VALUES ('$name', '$email', '$subject', 'draft')";
						$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
						if($ires){
							$smsg = "Bình luận đã được đăng";
							
						}else{
							$fmsg = "Thất bại";
						}
					 
					}
					?>
					<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
					<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
			 
					
					<div class="col">
				
						<div class="panel panel-default">
						<div class="panel-heading">Bình luận</div>
						<div class="panel-body">
						<?php 
							$comsql = "SELECT * FROM comments ";
							$comres = mysqli_query($connection, $comsql);
							while($comr = mysqli_fetch_assoc($comres)){
								$hash = md5( strtolower( trim( $comr['email'] ) ) );
								$size = 50;
								$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
						?>
							<div class="row">
								<div class="col-md-3">
									<img src="<?php echo $grav_url; ?>">
								</div>
								<div class="col-md-9">
									<p><strong><?php echo htmlspecialchars($comr['name'], ENT_QUOTES, 'UTF-8'); ?></strong> </p>
									<p><?php  echo htmlspecialchars($comr['submittime'], ENT_QUOTES, 'UTF-8');?></p>
									<p><?php  echo htmlspecialchars($comr['subject'], ENT_QUOTES, 'UTF-8'); ?></p>
								</div>
							</div>
							<br>
							<?php } ?>
						</div>
						</div>
					
					
					</div>

					<?php else:?>

						<div class="status alert alert-danger" style="font-size: 18px;text-align: center;">Không tìm thấy bài </div>
					<?php endif;?>
			 
				</div>	
			</div>
		</div>
	</section>


<?php $this->view("footer",$data); ?>





