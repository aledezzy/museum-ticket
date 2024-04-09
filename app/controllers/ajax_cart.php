<?php 

Class Ajax_cart extends Controller
{

	public function index()
	{


	}

	public function delete_item($data = ""){

		$obj = json_decode($data);
		$id = esc($obj->id);

		$id = esc($id);
		if(isset($_SESSION['CART'])){
			foreach ($_SESSION['CART'] as $key => $item) {
				# code...
				if($item['id'] == $id){

					unset($_SESSION['CART'][$key]);
					$_SESSION['CART'] = array_values($_SESSION['CART']);
					break;
				}
			}
		}

		$obj->data_type = "delete_item";
		echo json_encode($obj);
	}

	public function edit_quantity($data = "")
	{

		$obj = json_decode($data);

		$quantity = esc($obj->quantity);
		$id = esc($obj->id);
		if(isset($_SESSION['CART'])){
			foreach ($_SESSION['CART'] as $key => $item) {
				# code...
				if($item['id'] == $id){

					$_SESSION['CART'][$key]['qty'] = (int)$quantity;
					break;
				}
			}
		}

		$obj->data_type = "edit_quantity";
		echo json_encode($obj);
	}

	

}