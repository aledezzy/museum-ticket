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
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
 

	<?php if(isset($orders) && is_array($orders)):?>

			<div class="register-req">
				<p style="text-align: center;">Si prega di confermare le informazioni di seguito</p>
			</div><!--/register-req-->
 
 				<?php foreach($orders as $order):?>
							<?php $order = (object)$order; ?>
						 
 								<div class="js-order-details details" >
   									
									<!--order details-->
									<div style="display: flex;">
										<table class="table" style="flex: 1;margin: 4px;">

											<tr><th>Paese</th><td><?=$order->country?></td></tr>
											<tr><th>Stato</th><td><?=$order->state?></td></tr>
											<tr><th>Indirizzo di consegna 1</th><td><?=$order->address1?></td></tr>
											<tr><th>Indirizzo di consegna 2</th><td><?=$order->address2?></td></tr>
											
										</table>
										<table class="table" style="flex: 1;margin: 4px;">
											<tr><th>CAP</th><td><?=$order->postal_code?></td></tr>
											<tr><th>Telefono di casa</th><td><?=$order->home_phone?></td></tr>
											<tr><th>Telefono cellulare</th><td><?=$order->mobile_phone?></td></tr>
											<tr><th>Data</th><td><?=date("Y-m-d")?></td></tr>
											
										</table>
									</div>
										<table style="width: 100%;background-color: #eee"><tr><td style="text-align: center;padding: 1em;"><?=$order->message?></td></tr></table>

									<hr>
									<h4>Sommario</h4>
									<table class="table">
										<thead>
											<tr><th>Qta</th><th>Descrizione</th><th>Prezzo singolo</th><th>Totale</th></tr>
										</thead>
										<?php if(isset($order_details) && is_array($order_details)):?>
											<?php foreach($order_details as $detail):?>
												<tbody>
													<tr><td><?=$detail->cart_qty?></td><td><?=$detail->description?></td><td><?=$detail->price?></td><td><?=($detail->cart_qty * $detail->price)?></td></tr>
												</tbody>
													
											<?php endforeach;?>

										<?php else: ?>
											<div style="text-align: center;">Nessun dettaglio</div>
										<?php endif;?>
										
									</table>
									<?php if($total_discount > 0):?>
										<h3 style="font-size: 90% !important; ">Sconto applicato: <?=$total_discount?>€ sul totale</h3>
									<?php endif;?>
									<h3 class="pull-right">Totale: <?=$sub_total?></h3>
								</div>
					 
					<?php endforeach;?>
	 

	<?php else:?>
		<h3 style="text-align: center;">
			Aggiungi prima degli articoli nel carrello!
		</h3>
	<?php endif;?>
			<hr style="clear: both;">
			<a href="<?=ROOT?>checkout">
				<input type="button" class="btn btn-warning pull-left" value="< Back to checkout" name="">
			</a>
			<form method="post">
				<input type="submit" class="btn btn-warning pull-right" value="Pay >" name="">
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
						select_input.innerHTML = "<option>-- State / Province / Region --</option>";

						for (var i = 0; i < obj.data.length; i++) {
 							
							select_input.innerHTML += "<option value='"+obj.data[i].id+"'>"+obj.data[i].state+"</option>";
						}
					}
				}

			}


		}

	</script>
<?php $this->view("footer",$data); ?>