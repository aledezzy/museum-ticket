<?php $this->view("header",$data); ?>
	
	<section id="advertisement">
		<div class="container">
			<img src="<?=ASSETS.THEME?>images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">

				<?php $this->view("sidebar.inc",$data); ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						
						<?php if(isset($ROWS) && is_array($ROWS)): ?>
						<?php foreach($ROWS as $row): ?>

							<?php $this->view("product.inc",$row); ?>

						<?php endforeach; ?>
						<?php endif; ?>
						
						<?php Page::show_links()?>
						
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
 
 	
  
<?php $this->view("footer",$data); ?>