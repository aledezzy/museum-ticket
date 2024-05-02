<?php $this->view("admin/header",$data); ?>

<?php $this->view("admin/sidebar",$data); ?>

<style type="text/css">
	
	.details{

		background-color: #eee;
		box-shadow: 0px 0px 10px #aaa;
		width: 100%;
		position: absolute;
		left: 0px;
		padding: 10px;
		min-height: 100px;
		z-index: 2;
	}

</style>
<table class="table table-striped table-advance table-hover">

	<thead>
		<tr><th>Id utente</th><th>Nome</th><th>Email</th><th>Data creazione</th><th>Categoria speciale</th><th>Numero ordini</th></tr>
	</thead>
	<tbody>
		<?php if(isset($users) && is_array($users)):?>
			<?php foreach($users as $user):?>

				<tr style="position: relative;"><td><?=$user->id?></td><td><a href="<?=ROOT?>profile/<?=$user->url_address?>"><?=$user->name?></a></td><td><?=$user->email?></td><td><?=date("jS M Y H:i a",strtotime($user->date))?></td><td><?=$user->categories?></td>

					<td>
						<?=$user->orders_count?>
					</td>
					<td>
						<? 
						//Make something (such as a form) to modify the value of $user->categories. Value can be 1 to 10. Than modify the value of $user->categories in the database.
						//If you want to modify the value of $user->categories, you can use the following code:
						
							//create a form to take in input tha category value. and than update the value in the database.
							
							
							
						// $DB->write("update users set categories = :categories where id = :id",array("categories"=>$user->categories,"id"=>$user->id));
						






						
						
		
						?>
					</td>
					
				</tr>
			<?php endforeach;?>
		<?php endif;?>
	</tbody>

</table>
 

<?php $this->view("admin/footer",$data); ?>