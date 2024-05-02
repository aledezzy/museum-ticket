<?php $this->view("header",$data); ?>
<div style="text-align: center;">
 
	<?php if(isset($_GET['mode']) && $_GET['mode'] == 'approved'):?>
		<h1>Grazie per aver acquistato da noi!</h1>
		<h4>Il tuo ordine è stato effettuato con successo</h4>
		<br><br>

	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'cancel'):?>

		<center><h1>Il pagamento è stato annullato!</h1></center>
	<?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'error'):?>
		
		<center><h1>Si è verificato un errore! Pagamento non riuscito!</h1></center>
	<?php else:?>
		<center><h1>Spiacenti, si è verificato un errore!</h1></center>
	<?php endif;?>

		<div>Cosa desideri fare ora?</div><br>
	<a href="<?=ROOT?>shop">
		<input type="button" class="btn btn-warning" value="Continua lo shopping">
	</a>
	<a href="<?=ROOT?>profile">
		<input type="button" class="btn btn-warning" value="Visualizza i tuoi ordini">
	</a>
		
		<br><br>

</div>
<?php $this->view("footer",$data); ?>