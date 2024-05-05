<?php $this->view("header",$data); ?>

	<section>
		<div class="container">
			<div class="row">

				<?php //$this->view("sidebar.inc",$data); ?>

				<div class="col-sm-9">

					<?php if(isset($row) && is_object($row)):?>

						<div class="blog-post-area">
							<h2 class="title text-center">Le ultime dal blog</h2>
							<div class="single-blog-post">
								<h3><?=htmlspecialchars($row->title)?></h3>
								<div class="post-meta">
									<ul>
										<li><i class="fa fa-user"></i><?=$row->user_data->name?></li>
										<li><i class="fa fa-clock-o"></i><?=date("H:i a",strtotime($row->date))?></li>
										<li><i class="fa fa-calendar"></i><?=date("M jS, Y",strtotime($row->date))?></li>
									</ul>
									<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</div>
								<img src="<?=ROOT . $row->image?>" style="width: 40%;" alt="<?=htmlspecialchars($row->title)?>">
								<br><br>
								<p><?=nl2br(htmlspecialchars($row->post))?></p>

								<div class="pager-area">
									<ul class="pager pull-right">
										<li><a href="#">Pre</a></li>
										<li><a href="#">Succ</a></li>
									</ul>
								</div>
							</div>
						</div><!--/blog-post-area-->

						

						

					<?php else:?>

						<div class="status alert alert-danger" style="font-size: 18px;text-align: center;">Il post selezionato non è disponibile, si è rotto tutto!</div>
					<?php endif;?>

				</div>
			</div>
		</div>
	</section>


<?php $this->view("footer",$data); ?>