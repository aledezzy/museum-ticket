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
 

	<?php if(is_array($ROWS)):?>

			<div class="register-req">
				<p>Campi con * sono obbligatori</p>
			</div><!--/register-req-->

		<?php 

			$address1 		= "";
			$address2 		= "";
			$postal_code 	= "";
			$country 		= "";
			$state 			= "";
			$home_phone 	= "";
			$mobile_phone 	= "";
			$message 	= "";

			if(isset($POST_DATA)){

				extract($POST_DATA);
			}

		?>

		<form method="post">
			<div class="shopper-informations" >
				<div class="row">
		 
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Spedizione a</p>
							<div class="form-one">
 									
								<input name="address1" value="<?=$address1?>" class="form-control" type="text" placeholder="Indirizzo 1 *" autofocus="autofocus" required><br>
								<input name="address2" value="<?=$address2?>" class="form-control" type="text" placeholder="Indirizzo 2"><br>
								<input name="postal_code" value="<?=$postal_code?>" class="form-control" type="text" placeholder="Codice Postale *" required><br>
								 
							</div>
							<div class="form-two">

									<select name="country" class="js-country" oninput="get_states(this.value)" required>
										<?php if($country == ""){
											echo "<option>-- Paese --</option>";
										}else{
											echo "<option>$country</option>";
										}?>
										<?php if(isset($countries) && $countries):?>
											<?php foreach ($countries as $row): ?>

												<option value="<?=$row->country?>"><?=$row->country?></option>

									 		<?php endforeach;?>
									 	<?php endif;?>
										
										
									</select><br><br>
									
									<input name="state"value="<?=$state?>" class="form-control" type="text" placeholder="Regione *" autofocus="autofocus" required><br>

									
									 
									<input name="home_phone" value="<?=$home_phone?>" class="form-control" type="text" placeholder="Telefono di casa"><br>
									<input name="mobile_phone" value="<?=$mobile_phone?>" class="form-control" type="text" placeholder="Telefono *" required><br>
									<br>
									
							</div>
						</div>
					</div>
					<div class="col-sm-4" >
						<div class="order-message">
							<p>Spedizione</p>
							<textarea name="message" placeholder="Note sul tuo ordine, Note speciali per la consegna" rows="16"><?=$message?></textarea>
							 
						</div>
					</div>
				</div>
		 
 				<input type="submit" class="btn btn-warning pull-right" value="Continue >" name="">
			
			</div>
		</form>


	<?php else:?>
		<h3 style="text-align: center;">
			Aggiungi un elemento nel carrello prima!
		</h3>
	<?php endif;?>

			<a href="<?=ROOT?>cart">
				<input type="button" class="btn btn-warning pull-left" value="< Torna al carrello" name="">
			</a>
		</div>
	</section> <!--/#cart_items-->

	<script type="text/javascript">
		
		function get_states(country){

	  		send_data({
	  			id:country.trim()
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

			var info = {};
			info.data_type = data_type;
			info.data = data;

			ajax.open("POST","<?=ROOT?>ajax_checkout",true);
			ajax.send(JSON.stringify(info));
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
 							
							select_input.innerHTML += "<option value='"+obj.data[i].state+"'>"+obj.data[i].state+"</option>";
						}
					}
				}

			}


		}

	</script>
<?php $this->view("footer",$data); ?>