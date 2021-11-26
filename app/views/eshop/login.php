<?php $this->view("header",$data); ?>

	<section id="form" style="margin-top: 5px;"><!--form-->
		<div class="container">
			<div class="row" style="text-align: center;">

				<span style="font-size:18px;color:red;"><?php check_error() ?></span>
				
				<div class="col-sm-4 col-sm-offset-1" style="float: none;display: inline-block;">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form method="post">
							<input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '';?>" placeholder="Email " />
							<input type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '';?>" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Giữ tôi luôn đăng nhập

							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
						<br>
						<a href="<?=ROOT?>signup">Chưa có tài khoản? Đăng kí ngay!</a>
					</div><!--/login form-->
				</div>
			 
			</div>
		</div>
	</section><!--/form-->
	
<?php $this->view("footer",$data); ?>
