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


/*
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `image2` varchar(500) DEFAULT NULL,
  `image3` varchar(500) DEFAULT NULL,
  `image4` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL,
  `slag` varchar(100) NOT NULL,
  `data-inizio` date DEFAULT NULL,
  `data-fine` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_url`, `description`, `category`, `brand`, `price`, `quantity`, `image`, `image2`, `image3`, `image4`, `date`, `slag`, `data-inizio`, `data-fine`) VALUES
(1, 'dvd7Hmns5V', 'Biglietto Intero', 1, 1, 30, 50, 'uploads/ticket2.jpg', 'uploads/ticket3.jpg', 'uploads/ticket2.jpg', 'uploads/ticket3.jpg', '2024-04-15 07:51:13', 'biglietto-intero', NULL, NULL),
(2, 'dvd7Hmns5V', 'Audioguida', 2, 1, 5, 125, 'uploads/audioguide.jpg', 'uploads/audioguide.jpg', 'uploads/audioguide.jpg', 'uploads/audioguide.jpg', '2024-04-15 07:51:13', 'audioguide-extra', NULL, NULL),
(3, 'dvd7Hmns5V', 'Accompagnatore Riservato', 2, 3, 0, 5, 'uploads/guidaDisabili.jpg', 'uploads/guidaDisabili.jpg', 'uploads/guidaDisabili.jpg', 'uploads/guidaDisabili.jpg', '2024-04-30 15:16:40', 'Accompagnatore-disabili', NULL, NULL);


--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_url` varchar(60) NOT NULL,
  `description` varchar(20) NOT NULL,
  `delivery_address` varchar(1024) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `tax` double DEFAULT 0,
  `shipping` double DEFAULT 0,
  `date` datetime NOT NULL,
  `sessionid` varchar(30) NOT NULL,
  `home_phone` varchar(15) NOT NULL,
  `mobile_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_url`, `description`, `delivery_address`, `total`, `country`, `state`, `zip`, `tax`, `shipping`, `date`, `sessionid`, `home_phone`, `mobile_phone`) VALUES
(23, '1USntCLPNNv0sMCpiuw6nlPryskHxIzAltBYHyLkyThl93nXZdYnw9', '1', 'asdasdas ', 25, 'Italia', 'asd', '54', 0, 0, '2024-04-29 07:14:07', '3a3rugdt3mte0d2gt1or2apefi', '', 'sda');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `orderid` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL,
  `productid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderid`, `qty`, `description`, `amount`, `total`, `productid`) VALUES
(22, 0, 1, 'Biglietto Ridotto', 25, 25, 2);


CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `raw` text NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `trans_id`, `raw`, `event_type`, `amount`, `status`, `order_id`, `summary`, `first_name`, `last_name`, `email`, `payer_id`) VALUES
(1, '2021-07-06 12:34:23', 'WH-72368620FC4839506-578153864S1803135', '{\"id\":\"WH-72368620FC4839506-578153864S1803135\",\"event_version\":\"1.0\",\"create_time\":\"2021-07-03T18:36:26.977Z\",\"resource_type\":\"checkout-order\",\"resource_version\":\"2.0\",\"event_type\":\"CHECKOUT.ORDER.APPROVED\",\"summary\":\"An order has been approved by buyer\",\"resource\":{\"create_time\":\"2021-07-03T18:31:44Z\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"6.00\",\"breakdown\":{\"item_total\":{\"currency_code\":\"USD\",\"value\":\"4.00\"},\"shipping\":{\"currency_code\":\"USD\",\"value\":\"2.00\"},\"tax_total\":{\"currency_code\":\"USD\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"eathorne2012-facilitator@yahoo.com\",\"merchant_id\":\"QKRY6BTWMQQ8C\"},\"description\":\"My item description\",\"shipping\":{\"name\":{\"full_name\":\"test buyer\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B\",\"rel\":\"update\",\"method\":\"PATCH\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/8D5278164K216725B/capture\",\"rel\":\"capture\",\"method\":\"POST\"}],\"id\":\"8D5278164K216725B\",\"intent\":\"CAPTURE\",\"payer\":{\"name\":{\"given_name\":\"test\",\"surname\":\"buyer\"},\"email_address\":\"eathorne2012-buyer@yahoo.com\",\"payer_id\":\"QCEPS6HXTCW9N\",\"address\":{\"country_code\":\"US\"}},\"status\":\"APPROVED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-72368620FC4839506-578153864S1803135\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-72368620FC4839506-578153864S1803135/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}', 'CHECKOUT.ORDER.APPROVED', 20.00, 'APPROVED', 'My item description', 'An order has been approved by buyer', 'test', 'buyer', 'eathorne2012-buyer@yahoo.com', 'QCEPS6HXTCW9N'),
(2, '2021-07-09 19:26:44', 'WH-4U387217Y0402090W-29K29120XX664362Y', '{\"id\":\"WH-4U387217Y0402090W-29K29120XX664362Y\",\"event_version\":\"1.0\",\"create_time\":\"2021-07-09T19:26:34.680Z\",\"resource_type\":\"checkout-order\",\"resource_version\":\"2.0\",\"event_type\":\"CHECKOUT.ORDER.APPROVED\",\"summary\":\"An order has been approved by buyer\",\"resource\":{\"update_time\":\"2021-07-09T19:26:33Z\",\"create_time\":\"2021-07-09T19:25:30Z\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"22.98\",\"breakdown\":{\"item_total\":{\"currency_code\":\"USD\",\"value\":\"22.98\"},\"shipping\":{\"currency_code\":\"USD\",\"value\":\"0.00\"},\"tax_total\":{\"currency_code\":\"USD\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"eathorne2012-facilitator@yahoo.com\",\"merchant_id\":\"QKRY6BTWMQQ8C\"},\"description\":\"order 5\",\"shipping\":{\"name\":{\"full_name\":\"test buyer\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"29B44561UF627130H\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"22.98\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"USD\",\"value\":\"22.98\"},\"paypal_fee\":{\"currency_code\":\"USD\",\"value\":\"0.97\"},\"net_amount\":{\"currency_code\":\"USD\",\"value\":\"22.01\"}},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/29B44561UF627130H\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/29B44561UF627130H/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/60J70994M39520325\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2021-07-09T19:26:33Z\",\"update_time\":\"2021-07-09T19:26:33Z\"}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/60J70994M39520325\",\"rel\":\"self\",\"method\":\"GET\"}],\"id\":\"60J70994M39520325\",\"intent\":\"CAPTURE\",\"payer\":{\"name\":{\"given_name\":\"test\",\"surname\":\"buyer\"},\"email_address\":\"eathorne2012-buyer@yahoo.com\",\"payer_id\":\"QCEPS6HXTCW9N\",\"address\":{\"country_code\":\"US\"}},\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4U387217Y0402090W-29K29120XX664362Y\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-4U387217Y0402090W-29K29120XX664362Y/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}', 'CHECKOUT.ORDER.APPROVED', 22.98, 'COMPLETED', 'order 5', 'An order has been approved by buyer', 'test', 'buyer', 'eathorne2012-buyer@yahoo.com', 'QCEPS6HXTCW9N'),
(3, '2021-07-13 10:19:20', 'WH-7T326909W98431811-0PA11016TB7979214', '{\"id\":\"WH-7T326909W98431811-0PA11016TB7979214\",\"event_version\":\"1.0\",\"create_time\":\"2021-07-13T10:18:33.518Z\",\"resource_type\":\"checkout-order\",\"resource_version\":\"2.0\",\"event_type\":\"CHECKOUT.ORDER.APPROVED\",\"summary\":\"An order has been approved by buyer\",\"resource\":{\"update_time\":\"2021-07-13T10:18:17Z\",\"create_time\":\"2021-07-13T10:17:05Z\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"1.05\",\"breakdown\":{\"item_total\":{\"currency_code\":\"USD\",\"value\":\"1.05\"},\"shipping\":{\"currency_code\":\"USD\",\"value\":\"0.00\"},\"tax_total\":{\"currency_code\":\"USD\",\"value\":\"0.00\"}}},\"payee\":{\"email_address\":\"eathorne2012-facilitator@yahoo.com\",\"merchant_id\":\"QKRY6BTWMQQ8C\"},\"description\":\"order 6\",\"shipping\":{\"name\":{\"full_name\":\"test buyer\"},\"address\":{\"address_line_1\":\"1 Main St\",\"admin_area_2\":\"San Jose\",\"admin_area_1\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"payments\":{\"captures\":[{\"id\":\"1BE01178RF206244J\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"1.05\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"seller_receivable_breakdown\":{\"gross_amount\":{\"currency_code\":\"USD\",\"value\":\"1.05\"},\"paypal_fee\":{\"currency_code\":\"USD\",\"value\":\"0.33\"},\"net_amount\":{\"currency_code\":\"USD\",\"value\":\"0.72\"}},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1BE01178RF206244J\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1BE01178RF206244J/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4PA73887R93208929\",\"rel\":\"up\",\"method\":\"GET\"}],\"create_time\":\"2021-07-13T10:18:17Z\",\"update_time\":\"2021-07-13T10:18:17Z\"}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/4PA73887R93208929\",\"rel\":\"self\",\"method\":\"GET\"}],\"id\":\"4PA73887R93208929\",\"intent\":\"CAPTURE\",\"payer\":{\"name\":{\"given_name\":\"test\",\"surname\":\"buyer\"},\"email_address\":\"eathorne2012-buyer@yahoo.com\",\"payer_id\":\"QCEPS6HXTCW9N\",\"address\":{\"country_code\":\"US\"}},\"status\":\"COMPLETED\"},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7T326909W98431811-0PA11016TB7979214\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7T326909W98431811-0PA11016TB7979214/resend\",\"rel\":\"resend\",\"method\":\"POST\"}]}', 'CHECKOUT.ORDER.APPROVED', 1.05, 'COMPLETED', 'order 6', 'An order has been approved by buyer', 'test', 'buyer', 'eathorne2012-buyer@yahoo.com', 'QCEPS6HXTCW9N');

*/

// i titoli e le date delle esposizioni tematiche che si sono tenute nel periodo 1 gennaio xxxx – 31 dicembre xxxx di un determinato anno;
// il numero dei biglietti emessi per una determinata esposizione;
// il ricavato della vendita di tutti biglietti di una determinata esposizione

// Funzione per ottenere i titoli e le date delle esposizioni tematiche che si sono tenute dal 1 gennaio xxxx al 31 dicembre xxxx di un determinato anno

function get_exhibitions($year) {
	$DB = Database::newInstance();
	$query = "SELECT * FROM products WHERE data_inizio >= '$year-01-01' AND data_fine <= '$year-12-31'";
	$result = $DB->read($query);

	if(is_array($result)){
		
		return $result;
	}
	return 0;
}

// Funzione per ottenere il numero dei biglietti emessi per una determinata esposizione
function get_tickets($exhibition_id) {
	$DB = Database::newInstance();
	$query = "SELECT SUM(qty) as total_tickets FROM order_details WHERE productid = $exhibition_id";
	$result = $DB->read($query);
	return $result[0]->total_tickets;
}

// Funzione per ottenere il ricavato della vendita di tutti biglietti di una determinata esposizione
function get_revenue($exhibition_id) {
	$DB = Database::newInstance();
	$query = "SELECT SUM(total) as total_revenue FROM order_details WHERE productid = $exhibition_id";
	$result = $DB->read($query);
	return $result[0]->total_revenue;
}








