<?php 

Class Order extends Controller
{
	public $errors = array();

	public function validate($POST){

		$this->errors = array();
		foreach ($POST as $key => $value) {
			# code...

			if($key == "country"){
				if($value == "" || $value == "-- Country --"){
					$this->errors[] = "Please enter a valid country";
				}
			}

			if($key == "state"){
				if($value == "" || $value == "-- State / Province / Region --"){
					$this->errors[] = "Please enter a valid state";
				}
			}

			if($key == "address1"){
				if(empty($value)){
					$this->errors[] = "Please enter a valid address 1";
				}
			}

			if($key == "postal_code"){
				if(empty($value)){
					$this->errors[] = "Please enter a valid postal code";
				}
			}

			if($key == "mobile_phone"){
				if(empty($value)){
					$this->errors[] = "Please enter a valid mobile number";
				}
			}

			
			
		}
	}

	public function save_order($POST,$ROWS,$user_url,$sessionid)
	{
 

		$db = Database::newInstance();

		if(is_array($ROWS) && count($this->errors) == 0){

			$countries = $this->load_model('Countries');

			$data = array();
			$data['user_url'] = $user_url;
			$data['sessionid'] = $sessionid;
			$data['delivery_address'] = $POST['address1'] . " ". $POST['address2'];
			$data['total'] = $POST['total'];
			$data['description'] = $POST['description'];
			//$country_obj = $countries->get_country($POST['country']);
			$data['country'] = $POST['country'];
			//$state_obj = $countries->get_state($POST['state']);
			$data['state'] = $POST['state'];
			$data['zip'] = $POST['postal_code'];
			$data['tax'] = 0;
			$data['shipping'] = 0;
			$data['date'] = date("Y-m-d H:i:s");
			$data['home_phone'] = $POST['home_phone'];
			$data['mobile_phone'] = $POST['mobile_phone'];

			//save details
			$orderid = 0;
			$query = "select id from orders order by id desc limit 1";
			$result = $db->read($query);

			if(is_array($result)){
				$orderid = $result[0]->id + 1;
			}


			$query = "insert into orders (description,user_url,delivery_address,total,country,state,zip,tax,shipping,date,sessionid,mobile_phone,home_phone) 
			values 
			(:description,:user_url,:delivery_address,:total,:country,:state,:zip,:tax,:shipping,:date,:sessionid,:mobile_phone,:home_phone)";

			$result = $db->write($query,$data);


			foreach ($ROWS as $row) {
				# code...
				$data = array();
				$data['orderid'] = $orderid;
				$data['qty'] = $row->cart_qty;
				$data['description'] = $row->description;
				$data['amount'] = $row->price;
				$data['total'] = $row->cart_qty * $row->price;
				$data['productid'] = $row->id;

				$query = "insert into order_details (orderid,qty,description,amount,total,productid) values (:orderid,:qty,:description,:amount,:total,:productid)";
				$result = $db->write($query,$data);
			}
		}
	}

	public function get_orders_by_user($user_url){

		$orders = false;

		$db = Database::newInstance();
		$data['user_url'] = $user_url;

		$query = "select * from orders where user_url = :user_url order by id desc limit 100";
		$orders = $db->read($query,$data);

		return $orders;

	}

	public function get_orders_count($user_url){

		$db = Database::newInstance();
		$data['user_url'] = $user_url;

		$query = "select id from orders where user_url = :user_url ";
		$result = $db->read($query,$data);

		$orders = is_array($result) ? count($result) : 0;
		return $orders;

	}

	

	public function get_all_orders(){

		$orders = false;

		$db = Database::newInstance();

		$limit = 10;
		$offset = Page::get_offset($limit);

		$query = "select * from orders order by id desc limit $limit offset $offset";
		$orders = $db->read($query);

		return $orders;

	}

	public function get_order_details($id){

		$details = false;
		$data['id'] = addslashes($id);
		$db = Database::newInstance();

		$query = "select * from order_details where orderid = :id order by id desc";
		$details = $db->read($query,$data);

		return $details;

	}

	

}