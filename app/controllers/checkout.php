<?php 

Class Checkout extends Controller
{

	public function index()
	{
		
		$User = $this->load_model('User');

		$image_class = $this->load_model('Image');
		
		//make sure the user is logged in
		$user_data = $User->check_login(true, ["admin","customer"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		$ROWS = false;
		$prod_ids = array();
		
		if(isset($_SESSION['CART'])){

			$prod_ids = array_column($_SESSION['CART'], 'id');
			$ids_str = "'" . implode("','", $prod_ids) . "'";

			$ROWS = $DB->read("select * from products where id in ($ids_str)");
		}
 	 

		if(is_array($ROWS)){
			foreach ($ROWS as $key => $row) {
				# code...

				foreach ($_SESSION['CART'] as $item) {
					# code...
					if($row->id == $item['id']){
						$ROWS[$key]->cart_qty = $item['qty'];
						break;
					}
				}
				
			}
		}


		$data['page_title'] = "Checkout";
		$data['sub_total'] = 0;

		if($ROWS){
			foreach ($ROWS as $key => $row) {
				# code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
				$mytotal = $row->price * $row->cart_qty;

				$data['sub_total'] += $mytotal;
			}
		}

		if(is_array($ROWS)){
			rsort($ROWS);
		}
		$data['ROWS'] = $ROWS;

		//get countries
		$countries = $this->load_model('Countries');
		$data['countries'] = $countries->get_countries();

		//check if old post data exists
		if(isset($_SESSION['POST_DATA'])){
			$data['POST_DATA'] = $_SESSION['POST_DATA'];
		}

		if(count($_POST) > 0){
  
  			$order = $this->load_model('Order');
 			$order->validate($_POST);
			$data['errors'] = $order->errors;
			$_POST['order_id'] = get_order_id();

			$_SESSION['POST_DATA'] = $_POST;
			$data['POST_DATA'] = $_POST;

			if(count($order->errors) == 0){
				header("Location:".ROOT."checkout/summary");
				die;
			}
		}

		$this->view("checkout",$data);
	}

	public function summary()
	{
		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');

		//make sure the user is logged in
		$user_data = $User->check_login(true, ["admin","customer"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//get data
		$DB = Database::newInstance();
		$ROWS = false;
		$prod_ids = array();
		
		if(isset($_SESSION['CART'])){

			$prod_ids = array_column($_SESSION['CART'], 'id');
			$ids_str = "'" . implode("','", $prod_ids) . "'";

			$ROWS = $DB->read("select * from products where id in ($ids_str)");
		}
 
		if(is_array($ROWS)){
			foreach ($ROWS as $key => $row) {
				# code...

				foreach ($_SESSION['CART'] as $item) {
					# code...
					if($row->id == $item['id']){
						$ROWS[$key]->cart_qty = $item['qty'];
						break;
					}
				}
				
			}
		}
 
		$data['sub_total'] = 0;
		if($ROWS){
			foreach ($ROWS as $key => $row) {
				# code...
 				$mytotal = $row->price * $row->cart_qty;

				$data['sub_total'] += $mytotal;
			}
		}

		$data['order_details'] = $ROWS;

		if(isset($_SESSION['POST_DATA'])){
			$data['orders'][] = $_SESSION['POST_DATA'];
		}
		
		$data['page_title'] = "Checkout Summary";

		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['POST_DATA'])){

 			$sessionid = session_id();
			$user_url = "";
			if(isset($_SESSION['user_url'])){
				$user_url = $_SESSION['user_url'];
			}

			$order = $this->load_model('Order');
			$_SESSION['POST_DATA']['total'] = get_total($ROWS);
			$_SESSION['POST_DATA']['description'] = get_order_id();

			$order->save_order($_SESSION['POST_DATA'],$ROWS,$user_url,$sessionid);
			$data['errors'] = $order->errors;
			
			//unset($_SESSION['POST_DATA']);
			unset($_SESSION['CART']);

			header("Location:".ROOT."checkout/pay");
			die;
		}

		$this->view("checkout.summary",$data);

	}

	public function pay()
	{

		$User = $this->load_model('User');

		//make sure the user is logged in
		$user_data = $User->check_login(true, ["admin","customer"]);

		$data['page_title'] = "Pay Now";
		$this->view("checkout.pay",$data);
	}
	
	public function thank_you()
	{

		if(isset($_SESSION['POST_DATA'])){
			unset($_SESSION['POST_DATA']);
		}
		
		if(isset($_SESSION['CART'])){
			unset($_SESSION['CART']);
		}

		$data['page_title'] = "Thank you";
		$this->view("checkout.thank_you",$data);
	}


}