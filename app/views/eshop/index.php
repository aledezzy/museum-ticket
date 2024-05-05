<?php $this->view("header",$data); ?>

<?php $this->view("slider",$data); ?>
<!-- Cookie Consent -->
<script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
document.addEventListener('DOMContentLoaded', function () {
cookieconsent.run({"notice_banner_type":"headline","consent_type":"express","palette":"light","language":"it","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"Museo"});
});
</script>

<noscript>Cookie di <a href="https://www.freeprivacypolicy.com/">MARTE</a></noscript>
<!-- End Cookie Consent -->





<!-- Below is the link that users can use to open Preferences Center to change their preferences. Do not modify the ID parameter. Place it where appropriate, style it as needed. -->

<!--<a href="#" id="open_preferences_center">Update cookies preferences</a>-->


	<section>
		<div class="container">
			<div class="row">
				
				<?php /*$this->view("sidebar.inc",$data);*/ ?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Biglietti in evidenza</h2>
						
						<?php if(is_array($ROWS)): ?>
						<?php foreach($ROWS as $row): ?>

							<?php $this->view("product.inc",$row); ?>

						<?php endforeach; ?>
						<?php endif; ?>

						<?php //show($segment_data)?>
					</div><!--features_items-->
					
					<?php if(isset($segment_data) && is_array($segment_data)): $num = 0 ?>

					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<?php foreach($segment_data as $key => $seg): $num++?>
									<li <?= ($num == 1) ? 'class="active"' : '';?> ><a href="#<?=$key?>" data-toggle="tab"><?=$key?></a></li>
								<?php endforeach;?>
 							</ul>
						</div>
						<div class="tab-content">

							<?php $num = 0 ?>
							<?php foreach($segment_data as $key => $seg): $num++?>

								<div class="tab-pane fade <?= ($num == 1) ? ' active in ' : '';?> " id="<?=$key?>" >
									
									<div class="col-sm-10">

										<?php if(is_array($seg)): ?>
											<?php foreach($seg as $row): ?>

												<?php $this->view("product.inc",$row); ?>

											<?php endforeach; ?>
										<?php endif; ?>

									</div>
	 							 
								</div>
							<?php endforeach;?>
						</div>
					</div><!--/category-tab-->
					<?php endif;?>

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Butta un occhio qui, bischero</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								
								<?php if(isset($Slider_ROWS) && is_array($Slider_ROWS)): $num = 0 ?>
									
									<?php foreach($Slider_ROWS as $Slider_ROW): $num++ ?>
										<div class="item <?=($num==1)?'active':'';?>">

											<?php if(is_array($Slider_ROW)): ?>
												<?php foreach($Slider_ROW as $row): ?>

													<?php $this->view("product.inc",$row); ?>

												<?php endforeach; ?>
											<?php endif; ?>
		 									 
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
 								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					<?php Page::show_links()?>
				</div>
			</div>
		</div>
	</section>
	
<?php $this->view("footer",$data); ?>

