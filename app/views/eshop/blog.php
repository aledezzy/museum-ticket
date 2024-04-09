<?php $this->view("header",$data); ?>
	
	<section>
		<div class="container">
			<div class="row">
				
				<?php $this->view("sidebar.inc",$data); ?>

				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						
						<?php if(isset($ROWS) && is_array($ROWS)):?>
							<?php foreach($ROWS  as $row):?>
								<!--single-blog-post-->
								<div class="single-blog-post" style="border-bottom: solid thin #ccc">
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
									<a href="<?=ROOT?>post/<?=$row->url_address?>">
										<img src="<?=ROOT . $row->image?>" alt="<?=htmlspecialchars($row->title)?>">
									</a>
									<p><?=nl2br(htmlspecialchars(substr($row->post, 0,300)))?>...</p>
									<a  class="btn btn-primary" href="<?=ROOT?>post/<?=$row->url_address?>">Read More</a>
								</div>
								<!--end single-blog-post-->
  							<?php endforeach;?>
  						<?php endif;?>

						<?php Page::show_links()?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $this->view("footer",$data); ?>