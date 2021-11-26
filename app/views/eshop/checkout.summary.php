<?php $this->view("header",$data); ?>
 
<?php 

	if(isset($errors) && count($errors) > 0){

		echo "<div>";
		foreach($errors as $error){

			echo "<div class='alert alert-danger' style='padding:5px;max-width:500px;margin:auto;text-align:center;'>$error</div>";
		}
		echo "</div>";
	}

?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->
 

	<?php if(isset($orders) && is_array($orders)):?>

			<div class="register-req">
				<p style="text-align: center;">Hãy xác nhận các thông tin lần cuối</p>
			</div><!--/register-req-->
 
 				<?php foreach($orders as $order):?>
							<?php $order = (object)$order; ?>
						 
 								<div class="js-order-details details" >
   									
									<!--order details-->
									<div style="display: flex;">
										<table class="table" style="flex: 1;margin: 4px;">

											<tr><th>Quốc gia</th><td><?=$order->country?></td></tr>
											<tr><th>Tỉnh/ thành phố</th><td><?=$order->state?></td></tr>
											<tr><th>Địa chỉ giao hàng 1</th><td><?=$order->address1?></td></tr>
											<tr><th>Địa chỉ giao hàng 2</th><td><?=$order->address2?></td></tr>
											
										</table>
										<table class="table" style="flex: 1;margin: 4px;">
											<tr><th>Zip/Postal Code</th><td><?=$order->postal_code?></td></tr>
											<tr><th>Điện thoại bàn</th><td><?=$order->home_phone?></td></tr>
											<tr><th>Điện thoại di động</th><td><?=$order->mobile_phone?></td></tr>
											<tr><th>Ngày</th><td><?=date("Y-m-d")?></td></tr>
											
										</table>
									</div>
										<table style="width: 100%;background-color: #eee"><tr><td style="text-align: center;padding: 1em;"><?=$order->message?></td></tr></table>

									<hr>
									<h4>Tóm tắt đơn hàng</h4>
									<table class="table">
										<thead>
											<tr><th>Qty</th><th>Mô tả</th><th>Số lượng</th><th>Tổng</th></tr>
										</thead>	
										<?php if(isset($order_details) && is_array($order_details)):?>
											<?php foreach($order_details as $detail):?>
												<tbody>
													<tr><td><?=$detail->cart_qty?></td><td><?=$detail->description?></td><td><?=$detail->price?></td><td><?=($detail->cart_qty * $detail->price)?></td></tr>
												</tbody>
													
											<?php endforeach;?>

										<?php else: ?>
											<div style="text-align: center;">Không còn tìm thấy đơn hàng</div>
										<?php endif;?>
									</table>
									<h3 class="pull-right">Tổng cộng <?=$sub_total?></h3>
								</div>
					 
					<?php endforeach;?>
	 

	<?php else:?>
		<h3 style="text-align: center;">
			Hãy thêm hàng vào giỏ trước
		</h3>
	<?php endif;?>
			<hr style="clear: both;">
			<a href="<?=ROOT?>checkout">
				<input type="button" class="btn btn-warning pull-left" value="< Trở về" name="">
			</a>
			<form method="post">
				<input type="submit" class="btn btn-warning pull-right" value="Thanh toán >" name="">
			</form>
		</div>
	</section> <!--/#cart_items-->

	<script type="text/javascript">
		
		function get_states(id){

	  		send_data({
	  			id:id.trim()
	 		},"get_states");
	 	}

	 	function send_data(data = {},data_type)
		{

	 		var ajax = new XMLHttpRequest();
	 
			ajax.addEventListener('readystatechange', function(){

				if(ajax.readyState == 4 && ajax.status == 200)
				{
					handle_result(ajax.responseText);
				}
			});

			ajax.open("POST","<?=ROOT?>ajax_checkout/"+data_type+"/"+ JSON.stringify(data),true);
			ajax.send();
		}

		function handle_result(result)
		{

			console.log(result);
			if(result != ""){
				var obj = JSON.parse(result);

				if(typeof obj.data_type != 'undefined')
				{

					if(obj.data_type == "get_states"){
						
						var select_input = document.querySelector(".js-state");
						select_input.innerHTML = "<option>-- Tỉnh/ Thành phố --</option>";

						for (var i = 0; i < obj.data.length; i++) {
 							
							select_input.innerHTML += "<option value='"+obj.data[i].id+"'>"+obj.data[i].state+"</option>";
						}
					}
				}

			}


		}

	</script>
<?php $this->view("footer",$data); ?>