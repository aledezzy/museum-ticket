<?php 


Class Countries{

	public function get_countries(){

		$DB = Database::newInstance();
		$query = "select * from countries order by id desc";
		$data = $DB->read($query);

		return $data;
	}

	public function get_states($country){

		$arr['country'] = addslashes($country);

		$DB = Database::newInstance();
		$query = "select * from countries where country = :country limit 1";
		
		$check = $DB->read($query,$arr);
		$data = false;

		if(is_array($check)){
			$arr = false;
			$arr['id'] = $check[0]->id;

			$query = "select * from states where parent = :id order by id desc";
			$data = $DB->read($query,$arr);
		}
		

		return $data;
	}


	public function get_country($id){

		$id = (int)$id;
		$DB = Database::newInstance();
		$query = "select * from countries where id = '$id' ";
		$data = $DB->read($query);

		return is_array($data) ? $data[0] : false ;
	}

	public function get_state($id){

		$arr['id'] = (int)$id;

		$DB = Database::newInstance();
		$query = "select * from states where id = :id ";
		$data = $DB->read($query,$arr);

		return is_array($data) ? $data[0] : false ;
	}

	

	
}