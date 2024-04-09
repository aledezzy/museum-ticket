<?php 


function show($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function check_error()
{

	if(isset($_SESSION['error']) && $_SESSION['error'] != "")
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
}

function esc($data)
{
	return addslashes($data);
}

function redirect($link)
{
	header("Location: " . ROOT . $link);
	die;
}


function str_to_url($url) {
   $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
   $url = trim($url, "-");
   $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
   $url = strtolower($url);
   $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
   return $url;
}

function get_order_id(){

	$order = 1;
	$DB = Database::newInstance();
	$ROWS = $DB->read("select id from orders order by id desc limit 1");

	if(is_array($ROWS)){
		$order = "order " . ($ROWS[0]->id + 1);
	}

	return $order;
}

function get_total($ROWS){

	$total = 0;
	foreach ($ROWS as $key => $row) {
		# code...
		$total += $row->cart_qty * $row->price;
	}

	return $total;
}

function is_paid($order){

	$arr['amount'] = addslashes($order->total);
	$arr['order_id'] = addslashes($order->description);

	$DB = Database::newInstance();
	$payment = $DB->read("select id from payments where amount = :amount && order_id = :order_id limit 1",$arr);

	if(is_array($payment)){
		return "<button class='btn btn-success'>Paid</button>";
	}

	return "<button class='btn btn-warning'>Not Paid</button>";
}

function is_paid_bol($order){

	$arr['amount'] = addslashes($order->total);
	$arr['order_id'] = addslashes($order->description);

	$DB = Database::newInstance();
	$payment = $DB->read("select id from payments where amount = :amount && order_id = :order_id limit 1",$arr);

	if(is_array($payment)){
		return true;
	}

	return false;
}

function get_admin_count(){

	$DB = Database::newInstance();
	$ROWS = $DB->read("select id from users where rank = 'admin' ");

	if(is_array($ROWS)){
		return count($ROWS);
	}

	return 0;
}

function get_customer_count(){

	$DB = Database::newInstance();
	$ROWS = $DB->read("select id from users where rank = 'customer' ");

	if(is_array($ROWS)){
		return count($ROWS);
	}

	return 0;
}


function get_order_count(){

	$DB = Database::newInstance();
	$ROWS = $DB->read("select id from orders ");

	if(is_array($ROWS)){
		return count($ROWS);
	}

	return 0;
}

function get_categories_count(){

	$DB = Database::newInstance();
	$ROWS = $DB->read("select id from categories ");

	if(is_array($ROWS)){
		return count($ROWS);
	}

	return 0;
}

function get_payment_total(){

	$DB = Database::newInstance();
	$ROWS = $DB->read("select amount from payments ");

	if(is_array($ROWS)){
		
		$amounts = array_column($ROWS, 'amount');
		return array_sum($amounts);
	}

	return 0;
}






