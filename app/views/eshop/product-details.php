<?php $this->view("header",$data); ?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					
				</div>
				<!--start product-->
				<div class="col-sm-9 padding-right">
				<?php if($ROW):?>
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?=ROOT.$ROW->image?>" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="<?=ROOT.$ROW->image?>" alt=""></a>
 										</div>
										<div class="item">
										  <a href=""><img src="<?=ROOT.$ROW->image2?>" alt=""></a>
 										</div>
										<div class="item">
										  <a href=""><img src="<?=ROOT.$ROW->image3?>" alt=""></a>
 										</div>
										<div class="item">
										  <a href=""><img src="<?=ROOT.$ROW->image4?>" alt=""></a>
 										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?=$ROW->description?></h2>
								<p>Web ID: 1089772</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>EUR €<?=$ROW->price?></span>
									<label>Quantità:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Aggiungi al carrello
									</button>
								</span>
								<p><b>Disponibile?:</b> Si</p>
								
								<p><b>Compagnia:</b> Museo Marte</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							
							
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Paolo</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>13 APR 2024</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Scrivi la tua opinione!</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Il tuo nome"/>
											<input type="email" placeholder="Email"/>
										</span>
										<textarea name="" ></textarea>
										
										<button type="button" class="btn btn-default pull-right">
											Manda
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					
					
				<!--end product-->
				<?php else: ?>
					<div style="padding: 1em;background-color: grey;color:white;margin:1em;text-align: center;"><h2>That product was not found</h2></div>
				<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

<?php $this->view("footer",$data); ?>