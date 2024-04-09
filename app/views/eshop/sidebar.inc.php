<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			
			<?php if(isset($categories) && is_array($categories)):?>
				<?php foreach($categories as $cat):

						if($cat->parent > 0){
							continue;
						}

						$parents = array_column($categories, "parent");
					?>

 					<!--category with children-->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a <?= in_array($cat->id, $parents) ? 'data-toggle="collapse"': '' ; ?>  data-parent="#accordian" href="<?= in_array($cat->id, $parents) ? '#'.$cat->category : ROOT . "shop/category/" . $cat->category;?>">
									<?=$cat->category?>
									<?php if(in_array($cat->id, $parents)):?>
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
									<?php endif;?>
								</a>
							</h4>
						</div>
						<?php if(in_array($cat->id, $parents)):?>
							<div id="<?=$cat->category?>" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="<?=ROOT . "shop/category/" . $cat->category;?>">ALL</a></li>
										<?php foreach($categories as $sub_cat):?>
											<?php if($sub_cat->parent == $cat->id):?>
												<li><a href="<?=ROOT . "shop/category/" . $sub_cat->category;?>"><?=$sub_cat->category?></a></li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						<?php endif;?>
					</div>
					 <!--category without children
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a href="#"><?=$cat->category?></a></h4>
						</div>
					</div>-->

			 	<?php endforeach; ?>
		 	<?php endif; ?>

		</div><!--/category-products-->
	
		                 <h2>Advanced Search</h2>
                      	 <!--searchbox-->
                      	 <style>
                      	 	.my-table{
                      	 		background-color: #eee;
                      	 	}
                      	 	.my-table th{
                      	 		background-color: #ddd;
                      	 	}
                      	 	
                      	 </style>

                      	 <form method="get">
                      	 		<table class="my-table table table-condensed">
                       	 				<tr>
                       	 				 
                       	 					<td>
                       	 						<input value="<?php Search::get_sticky('textbox','description')?>" autofocus="true" type="text" class="form-control" name="description" placeholder="Type Product name">
                       	 					</td>
                       	 				
                       	 				</tr>
                       	 			 	<tr>
                       	 					<td>
                       	 						<select class="form-control" name="category">
                       	 							<option>--Select Category--</option>
                       	 							<?php Search::get_categories('category')?>
                       	 						</select>
                       	 					</td>
                       	 			 	</tr>
                       	 				<tr>
                        	 				<td>
                        	 					<div>Brands:</div>
                        	 					<?php Search::get_brands()?>
                        	 				</td>
                       	 				</tr>
                       	 				
                       	 				<tr>
                       	 					<td>
                       	 					<div>Price Range:</div>
                       	 					<div class="well text-center price-range" style="margin-top: 0px;margin-bottom: 0px;">
												 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[<?php Search::get_sticky('number','min-price','',0)?>,<?php Search::get_sticky('number','max-price','',1000)?>]" id="sl2" ><br />
												 <b class="pull-left">$ 0</b> <b class="pull-right">$ 1000</b>
 
                        	 						<input value="<?php Search::get_sticky('number','min-price')?>" class="form-control min-value" type="hidden" step="0.01" name="min-price">
                       	 							<input value="<?php Search::get_sticky('number','max-price')?>" class="form-control max-value" type="hidden" step="0.01" name="max-price">
                       	 						 
											</div>

                       	 						
                       	 					</td>
                       	 				</tr>
                       	 				<tr>
                       	 					<td>
                       	 					<div>Quantity</div>
                       	 						<div class="form-inline" >
	                       	 						
	                       	 						<div class="well text-center quantity-range" style="margin-top: 0px;margin-bottom: 0px;">
														 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[<?php Search::get_sticky('number','min-qty','',0)?>,<?php Search::get_sticky('number','max-qty','',1000)?>]" id="sl3" ><br />
														 <b class="pull-left">0</b> <b class="pull-right">1000</b>

	                       	 							<input class="form-control min-value" type="hidden" value="<?php Search::get_sticky('number','min-qty')?>" step="1" name="min-qty">
	                       	 							<input class="form-control max-value" type="hidden" value="<?php Search::get_sticky('number','max-qty')?>" step="1" name="max-qty">
                       	 						
													</div>
                       	 						</div>
                       	 					</td>
                       	 				</tr>
                       	 			 
                       	 				<tr>
                        	 				<td>
                       	 						<select class="form-control" name="year">
                       	 							<option>--Select Year--</option>
                       	 							 <?php Search::get_years('year')?>

                       	 						</select>
                       	 					</td>
                       	 				</tr>
 										<tr><td ><input type="submit" name="search" value="Search" class="btn btn-success pull-right"></td></tr>
                      	 		</table>
                      	 </form>
                      	 	
                      	 <!--end searchbox-->

		<div class="shipping text-center"><!--shipping-->
			<img src="<?= ASSETS . THEME ?>images/home/shipping.jpg" alt="" />
		</div><!--/shipping-->
	
	</div>
</div>

<script>
	
	var price_range = document.querySelector(".price-range");
	price_range.addEventListener('mousemove',change_price_range);
	
	var quantity_range = document.querySelector(".quantity-range");
	quantity_range.addEventListener('mousemove',change_price_range);

	function change_price_range(e)
	{
		var tooltip = e.currentTarget.querySelector(".tooltip-inner");
		var min_price = e.currentTarget.querySelector(".min-value");
		var max_price = e.currentTarget.querySelector(".max-value");
		
		var values = tooltip.innerHTML;
		var parts = values.split(":");

		min_price.value = parts[0].trim();
		max_price.value = parts[1].trim();
		
	}


</script>