<?php $this->view("header",$data); ?>
<div style="text-align: center;">
 
	<?php if(isset($_GET['mode']) && $_GET['mode'] == 'approved'):?>
		<h1>Thank you for shopping with us!</h1>
		<h4>Your order was successful</h4>
		<br><br>

	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'cancel'):?>

		<center><h1>Payment was cancelled!</h1></center>
	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'error'):?>
		
		<center><h1>An error occured! Payment unsuccessful!</h1></center>
	<?php else:?>
		<center><h1>Sorry, An error occured!</h1></center>
	<?php endif;?>

		<div>What would you like to do next?</div><br>
	<a href="<?=ROOT?>shop">
		<input type="button" class="btn btn-warning" value="Continue shopping">
	</a>
	<a href="<?=ROOT?>profile">
		<input type="button" class="btn btn-warning" value="View your orders">
	</a>
		
		<br><br>

</div>
<?php $this->view("footer",$data); ?>