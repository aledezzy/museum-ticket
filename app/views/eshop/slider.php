<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">

					<?php if(isset($slider) && is_array($slider)):?>
						
						<ol class="carousel-indicators">
							<?php $num = 0;?>
							<?php foreach ($slider as $row):?>
	 							<li data-target="#slider-carousel" data-slide-to="<?=$num?>" class="<?= $num == 0 ? 'active':'';?>"></li>
	 						<?php $num++; endforeach;?>
	 					</ol>
	 					<?php $num = 0;?>
						<div class="carousel-inner">
							<?php foreach ($slider as $row): $num++?>
								<div class="item <?= $num == 1 ? 'active':'';?>">
									<div class="col-sm-6">
										<h1><span><?=substr(strtoupper($row->header1_text),0,1)?></span><?=substr(strtoupper($row->header1_text),1)?></h1>
										<h2><?=$row->header2_text?></h2>
										<p><?=$row->text?></p>
										<a href="<?=$row->link?>">
											<button type="button" class="btn btn-default get">Get it now</button>
										</a>
									</div>
									<div class="col-sm-6">
										<img src="<?= ROOT . $row->image?>" class="girl img-responsive" alt="" />
									</div>
								</div>
							<?php endforeach;?>
						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					<?php endif;?>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->