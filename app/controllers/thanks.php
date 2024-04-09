<?php 

Class Thanks extends Controller
{

	public function index()
	{
		$data['page_title'] = "Thanks";
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
 			
			$user = $this->load_model("User");
			
		}

		$this->view("thanks",$data);
	}


}