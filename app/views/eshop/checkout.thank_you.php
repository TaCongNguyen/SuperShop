<?php $this->view("header",$data); ?>
<div style="text-align: center;">
 
	<?php if(isset($_GET['mode']) && $_GET['mode'] == 'approved'):?>
		<h1>Cảm ơn vì đã mua hàng!</h1>
		<h4>Đơn hàng đã được thanh toán thành công</h4>
		<br><br>

	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'cancel'):?>

		<center><h1>Thanh toán bị huỷ</h1></center>
	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'error'):?>
		
		<center><h1>Có lỗi xảy ra, thanh toán thất bại</h1></center>
	<?php else:?>
		<center><h1>Đã có lỗi xảy ra</h1></center>
	<?php endif;?>

		<div>Bạn muốn làm gì tiếp theo ?</div><br>
	<a href="<?=ROOT?>shop">
		<input type="button" class="btn btn-warning" value="Tiếp tục mua sắm">
	</a>
	<a href="<?=ROOT?>profile">
		<input type="button" class="btn btn-warning" value="Xem đơn hàng">
	</a>
		
		<br><br>

</div>
<?php $this->view("footer",$data); ?>