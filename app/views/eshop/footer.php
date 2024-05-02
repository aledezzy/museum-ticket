	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span> <strong>Museo</strong> </span>Marte</h2>
							<p>Vieni a visitarci!</p>
						</div>
					</div>
					<div class="col-sm-7">
				   
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="<?= ASSETS . THEME ?>images/home/map2.png" alt="" />
							<!--<p>Italia</p>-->
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
							<h2>Servizi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Aiuto online</a></li>
								<li><a href="#">Contattaci</a></li>
								<li><a href="#">Stato dell'ordine</a></li>
								<li><a href="#">Cambia posizione</a></li>
								<li><a href="#">Domande frequenti</a></li>
								<?php if(isset($data['user_data']) && $data['user_data']->rank == 'admin'): ?>
									<li><a href="<?=ROOT?>admin">Admin</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Biglietti</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Termini di utilizzo</a></li>
								<li><a href="#">Politica sulla privacy</a></li>
								<li><a href="#">Politica di rimborso</a></li>
								<li><a href="#">Sistema di fatturazione</a></li>
								<li><a href="#">Sistema di biglietteria</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Su di noi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Informazioni sulla società</a></li>
								<li><a href="#">Carriere</a></li>
								<li><a href="#">Posizione del negozio</a></li>
								<li><a href="#">Programma di affiliazione</a></li>
								<li><a href="#">Diritti d'autore</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Sul museo marte...</h2>
							<form action="javascript:alert('Ti sei registrato alla nostra newsletter! Grazie!');" class="searchform">
								<input type="text" placeholder="Email..." />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Ottieni gli aggiornamenti più recenti dal nostro sito e mantieniti aggiornato...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2024 UDA24 MARTE Tutti i diritti riservati.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Ale, Giordy, Mt, Dani</a></span></p>
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