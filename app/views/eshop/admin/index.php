<?php $this->view("admin/header",$data); ?>

<?php $this->view("admin/sidebar",$data); ?>

          		<h3>Main admin page.</h3>
           

          		 	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="fa fa-user"></span>
					  			<h3>$ <?=get_payment_total()?> </h3>
                  			</div>
					  			<p><?=get_payment_total()?> payment total so far!</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="fa fa-copy"></span>
					  			<h3><?=get_categories_count()?></h3>
                  			</div>
					  			<p><?=get_categories_count()?> total categories.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="fa fa-paste"></span>
					  			<h3><?=get_customer_count()?></h3>
                  			</div>
					  			<p>You have <?=get_customer_count()?> customers.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3><?=get_order_count()?></h3>
                  			</div>
					  			<p>More than <?=get_order_count()?> orders were received.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3><?=get_admin_count()?></h3>
                  			</div>
					  			<p>Your have <?=get_admin_count()?> admins.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	

<?php $this->view("admin/footer",$data); ?>
      