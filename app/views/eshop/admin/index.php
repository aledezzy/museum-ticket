<?php $this->view("admin/header",$data); ?>

<?php $this->view("admin/sidebar",$data); ?>
<h3>Pagina admin</h3>
<div class="row mtbox">
	<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
    	<div class="box1">
			<span class="fa fa-user"></span>
			<h3>€ <?=get_payment_total()?> </h3>
        </div>
		<p><?=get_payment_total()?> Ricavato totale!</p>
    </div>
	<div class="col-md-2 col-sm-2 box0">
        <div class="box1">
			<span class="fa fa-copy"></span>
			<h3><?=get_categories_count()?></h3>
        </div>
		<p><?=get_categories_count()?> Categorie presenti:</p>
    </div>
    <div class="col-md-2 col-sm-2 box0">
    	<div class="box1">
		<span class="fa fa-paste"></span>
		<h3><?=get_customer_count()?></h3>
    	</div>
		<p>Hai ben <?=get_customer_count()?> Clienti:</p>
    </div>
    <div class="col-md-2 col-sm-2 box0">
        <div class="box1">
			<span class="fa fa-paste"></span>
			<h3><?=get_order_count()?></h3>
        </div>
		<p>Più di <?=get_order_count()?> ordini ricevuto.</p>
    </div>
    <div class="col-md-2 col-sm-2 box0">
        <div class="box1">
			<span class="fa fa-user"></span>
			<h3><?=get_admin_count()?></h3>
        </div>
		<p>Hai attivi <?=get_admin_count()?> admins.</p>
    </div>
	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span class="fa fa-user"></span>
			<h3>Seleziona un anno</h3>
		</div>
		<p>Seleziona un anno per vedere le esposizioni tematiche che si sono tenute in quel periodo</p>
		<form method="post">
			<select name="year" class="form-control">
				<?php
					$year = date("Y");
					for($i = $year; $i >= 2000; $i--){
						echo "<option value='$i'>$i</option>";
					}
					?>
			</select>
			<button type="submit" class="btn btn-primary">Seleziona</button>
		</form>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<?php
			// Salva il livello di errore corrente
			$old_error_reporting = error_reporting();
			// Disabilita i warning temporaneamente
			error_reporting($old_error_reporting & ~E_WARNING);
			if(isset($_POST['year'])){
				$yearNEW = $_POST['year'];
				echo '
					<div class="box1">
						<span class="fa fa-user"></span>
						<h3>'.$exhibitions = get_exhibitions($yearNEW);
						foreach($exhibitions as $exhibition){
							echo " ".$exhibition->description." dal ".$exhibition->data_inizio." al ".$exhibition->data_fine." ";
						}'
						</h3>
					</div>
					<p>i titoli e le date delle esposizioni tematiche che si sono tenute nel periodo 1 gennaio xxxx – 31 dicembre xxxx di un determinato anno'.
					$exhibitions = @get_exhibitions($yearNEW);
					//echo var_dump($exhibitions);
					//result of var_dump= Arrayarray(1) { [0]=> object(stdClass)#4 (15) { ["id"]=> int(1) ["user_url"]=> string(10) "dvd7Hmns5V" ["description"]=> string(16) "Biglietto Intero" ["category"]=> int(1) ["brand"]=> int(1) ["price"]=> float(30) ["quantity"]=> int(50) ["image"]=> string(19) "uploads/ticket2.jpg" ["image2"]=> string(19) "uploads/ticket3.jpg" ["image3"]=> string(19) "uploads/ticket2.jpg" ["image4"]=> string(19) "uploads/ticket3.jpg" ["date"]=> string(19) "2024-04-15 07:51:13" ["slag"]=> string(16) "biglietto-intero" ["data_inizio"]=> string(10) "2024-04-23" ["data_fine"]=> string(10) "2024-04-30" } }
					//now print the description of all elements of the array
					foreach($exhibitions as $exhibition){
						echo " ".$exhibition->description." dal ".$exhibition->data_inizio." al ".$exhibition->data_fine." ";
					}'</p>';
			}?>
	</div>





	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span class="fa fa-user"></span>
			<h3>Seleziona un id</h3>
		</div>
		<p>Seleziona un id-biglietto per numero dei biglietti emessi per una determinata esposizione</p>
		<form method="post">
			<input type="text" name="id" id="id" class="form-control" placeholder="Inserisci id-biglietto">
			<button type="submit" class="btn btn-primary">Seleziona</button>
		</form>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<?php
			// Salva il livello di errore corrente
			$old_error_reporting = error_reporting();
			// Disabilita i warning temporaneamente
			error_reporting($old_error_reporting & ~E_WARNING);
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				echo '
					<div class="box1">
						<span class="fa fa-user"></span>
						<h3>'.$biglietti = get_tickets($id);
						foreach($biglietti as $biglietto){
							echo " Trovati ".$biglietto->quantity." biglietti";
						}'
						</h3>
					</div>
					<p>numero dei biglietti emessi per una determinata esposizione'.
					$biglietti = get_tickets($id);
					//echo var_dump($exhibitions);
					//result of var_dump= Arrayarray(1) { [0]=> object(stdClass)#4 (15) { ["id"]=> int(1) ["user_url"]=> string(10) "dvd7Hmns5V" ["description"]=> string(16) "Biglietto Intero" ["category"]=> int(1) ["brand"]=> int(1) ["price"]=> float(30) ["quantity"]=> int(50) ["image"]=> string(19) "uploads/ticket2.jpg" ["image2"]=> string(19) "uploads/ticket3.jpg" ["image3"]=> string(19) "uploads/ticket2.jpg" ["image4"]=> string(19) "uploads/ticket3.jpg" ["date"]=> string(19) "2024-04-15 07:51:13" ["slag"]=> string(16) "biglietto-intero" ["data_inizio"]=> string(10) "2024-04-23" ["data_fine"]=> string(10) "2024-04-30" } }
					//now print the description of all elements of the array
					foreach($biglietti as $biglietto){
						echo " Trovati ".$biglietto->quantity." biglietti";
					}'</p>';
			}?>
	</div>



	<div class="col-md-2 col-sm-2 box0">
		<div class="box1">
			<span class="fa fa-user"></span>
			<h3>Seleziona un id</h3>
		</div>
		<p>Seleziona un id per ottenere il ricavato della vendita di tutti biglietti di una determinata esposizione</p>
		<form method="post">
			<input type="text" name="id1" id="id1" class="form-control" placeholder="Inserisci id-biglietto">
			<button type="submit" class="btn btn-primary">Seleziona</button>
		</form>
	</div>
	<div class="col-md-2 col-sm-2 box0">
		<?php
			// Salva il livello di errore corrente
			$old_error_reporting = error_reporting();
			// Disabilita i warning temporaneamente
			error_reporting($old_error_reporting & ~E_WARNING);
			if(isset($_POST['id1'])){
				$id1 = $_POST['id1'];
				echo '
					<div class="box1">
						<span class="fa fa-user"></span>
						<h3>'.$biglietti1 = get_revenue($id1);
						foreach($biglietti1 as $biglietto1){
							echo " Ricavato= ".$biglietto1->price*$biglietto1->quantity;
						}'
						</h3>
					</div>
					<p>numero dei biglietti emessi per una determinata esposizione'.
					$biglietti1 = get_revenue($id1);
					foreach($biglietti1 as $biglietto1){
						echo " Ricavato= ".$biglietto1->price*$biglietto1->quantity;
					}'</p>';
			}?>
	</div>
				  	
</div><!-- /row mt -->
<?php $this->view("admin/footer",$data); ?>
      