<?php $this->view("header",$data); ?>

	<div class="container text-center">
		<div class="logo-404">
			<a href="index.html"><img src="<?=ASSETS . THEME ?>images/home/logo.png" alt="" /></a>
		</div>
		<div class="content-404">
			<img src="<?=ASSETS . THEME ?>images/404/404.png" class="img-responsive" alt="" style="max-width:200px;"/>
					<h1><b>OPPS!</b> Non abbiamo trovato questa pagina</h1>
					<p>Uh... Sembra che tu abbia rotto qualcosa. La pagina che stai cercando è scomparsa.</p>
					<h2><a href="<?=ROOT?>">Torna alla pagina iniziale</a></h2>
				</div>
			</div>

<?php $this->view("footer",$data); ?>