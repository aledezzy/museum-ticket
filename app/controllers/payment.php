<?php 

Class Payment extends Controller
{

	public function index()
	{
		
		$data = file_get_contents('php://input');
		//$data = '{"id":"WH-72368620FC4839506-578153864S1803135","event_version":"1.0","create_time":"2021-07-03T18:36:26.977Z","resource_type":"checkout-order","resource_version":"2.0","event_type":"CHECKOUT.ORDER.APPROVED","summary":"An order has been approved by buyer","resource":{"create_time":"2021-07-03T18:31:44Z","purchase_units":[{"reference_id":"default","amount":{"currency_code":"USD","value":"6.00","breakdown":{"item_total":{"currency_code":"USD","value":"4.00"},"shipping":{"currency_code":"USD","value":"2.00"},"tax_total":{"currency_code":"USD","value":"0.00"}}},"payee":{"email_address":"eathorne2012-facilitator@yahoo.com","merchant_id":"QKRY6BTWMQQ8C"},"description":"My item description","shipping":{"name":{"full_name":"test buyer"},"address":{"address_line_1":"1 Main St","admin_area_2":"San Jose","admin_area_1":"CA","postal_code":"95131","country_code":"US"}}}],"links":[{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B","rel":"update","method":"PATCH"},{"href":"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B/capture","rel":"capture","method":"POST"}],"id":"8D5278164K216725B","intent":"CAPTURE","payer":{"name":{"given_name":"test","surname":"buyer"},"email_address":"eathorne2012-buyer@yahoo.com","payer_id":"QCEPS6HXTCW9N","address":{"country_code":"US"}},"status":"APPROVED"},"links":[{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-72368620FC4839506-578153864S1803135","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-72368620FC4839506-578153864S1803135/resend","rel":"resend","method":"POST"}]}';

		//$filename = time() . "_.txt";
		//file_put_contents($filename, $data);

		$obj = json_decode($data);
		$DB = Database::newInstance();

		if(is_object($obj)){

			$arr = array();
			$arr['trans_id'] 	= $obj->id;
			$arr['event_type'] 	= $obj->event_type;
			$arr['amount'] 		= $obj->resource->purchase_units[0]->amount->value;
			$arr['order_id']	= $obj->resource->purchase_units[0]->description;
			$arr['status'] 		= $obj->resource->status;
			$arr['first_name'] 	= $obj->resource->payer->name->given_name;
			$arr['last_name'] 	= $obj->resource->payer->name->surname;
			$arr['email'] 		= $obj->resource->payer->email_address;
			$arr['payer_id'] 	= $obj->resource->payer->payer_id;
			$arr['summary'] 	= $obj->summary;
			$arr['raw'] 		= $data;
			$arr['date'] 		= date("Y-m-d H:i:s");

			$query = "insert into payments (

			trans_id,event_type,amount,order_id,status,first_name,last_name,email,summary,raw,payer_id,date
			) values (

			:trans_id,:event_type,:amount,:order_id,:status,:first_name,:last_name,:email,:summary,:raw,:payer_id,:date
			)";
			$DB->write($query,$arr);
 
		}
 		
	}


}