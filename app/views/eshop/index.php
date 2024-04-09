<?php $this->view("header",$data); ?>

<?php $this->view("slider",$data); ?>
	
	<section>
		<div class="container">
			<div class="row">
				
				<?php $this->view("sidebar.inc",$data); ?>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						
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
						<h2 class="title text-center">recommended items</h2>
						
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

