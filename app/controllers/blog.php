<?php 

Class Blog extends Controller
{

	public function index()
	{
		//pagination formula
		$limit = 10;
		$offset = Page::get_offset($limit);

		//check if its a search
		$search = false;
		if(isset($_GET['find']))
		{
			$find = addslashes($_GET['find']);
			$search = true;
		}
		
		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();

		if($search){
			$arr['title'] = "%". $find . "%";
			$ROWS = $DB->read("select * from blogs where title like :title limit $limit offset $offset",$arr);
		}else{
			$ROWS = $DB->read("select * from blogs order by id desc limit $limit offset $offset");
		}

		$data['page_title'] = "Blog";

		if($ROWS){
			foreach ($ROWS as $key => $row) {
				# code...
				$ROWS[$key]->image = $image_class->get_thumb_blog_post($ROWS[$key]->image);
				$ROWS[$key]->user_data = $User->get_user($ROWS[$key]->user_url);
			}
		}

		//get all categories
		$category = $this->load_model('category');
		$data['categories'] = $category->get_all();
 
		$data['ROWS'] = $ROWS;
		$data['show_search'] = true;
		$this->view("blog",$data);
	}


}