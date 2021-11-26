	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Super</span>shop</h2>
							<p>Mua gì cũng có </p>
						</div>
					</div>
					<div class="col-sm-7">
				   
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?= ASSETS . THEME ?>images/home/map.png" alt="" />
							<p>Thủ Đức, TP Hồ Chí Minh</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Hỗ trợ</a></li>
								<li><a href="#">Liên hệ</a></li>
								<li><a href="#"></a></li>
								<li><a href="#">FAQ’s</a></li>
								<?php if(isset($data['user_data']) && $data['user_data']->rank == 'admin'): ?>
									<li><a href="<?=ROOT?>admin">Admin</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Mua nhanh</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Phái nam</a></li>
								<li><a href="#">Phái nữ</a></li>
								<li><a href="#">Cards</a></li>
								<li><a href="#">Giày</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều khoản</a></li>
								<li><a href="#">Quyền riêng tư</a></li>
								<li><a href="#">Chính sách hoàn trả</a></li>
								
								
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Về chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#">Địa chỉ</a></li>
								<li><a href="#">Giới thiệu</a></li>
								<li><a href="#">Bản quyền</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Về Super Shop</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Luôn cập nhật tin tức <br />về trang web của chúng tôi</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		
		
	</footer><!--/Footer-->
	

  
    <script src="<?= ASSETS . THEME ?>js/jquery.js"></script>
	<script src="<?= ASSETS . THEME ?>js/bootstrap.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?= ASSETS . THEME ?>js/price-range.js"></script>
    <script src="<?= ASSETS . THEME ?>js/jquery.prettyPhoto.js"></script>
    <script src="<?= ASSETS . THEME ?>js/main.js"></script>
</body>
</html>