<?php 

Class Admin extends Controller
{

	public function index()
	{
		
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$data['page_title'] = "Admin";
		$data['current_page'] = "dashboard";
		$this->view("admin/index",$data);
	}

	
	public function categories()
	{
		
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();

		$limit = 10;
		$offset = Page::get_offset($limit);
		$categories_all = $DB->read("select * from categories order by id desc limit $limit offset $offset");

 		$categories = $DB->read("select * from categories where disabled = 0 order by id desc");

		$category = $this->load_model("Category");
		$tbl_rows = $category->make_table($categories_all);
		$data['tbl_rows'] = $tbl_rows;
		$data['categories'] = $categories;
	 
		$data['page_title'] = "Admin - Categories";
		$data['current_page'] = "categories";
		$this->view("admin/categories",$data);
	}

	public function products()
	{
		
		$search = false;
		if(isset($_GET['search'])){
			//show($_GET);
			$search = true;
		}
 
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();

		$limit = 10;
		$offset = Page::get_offset($limit);

		if($search){

			//generate a search query
			$query = Search::make_query($_GET);
			$products = $DB->read($query);

		}else{
			$products = $DB->read("SELECT prod.*,brands.brand as brand_name,cat.category as category_name FROM products as prod join brands on brands.id = prod.brand join categories as cat on cat.id = prod.category order by prod.id desc limit $limit offset $offset");
		}

 		$categories = $DB->read("select * from categories where disabled = 0 order by views desc");
 		$brands = $DB->read("select * from brands where disabled = 0 order by views desc");

		$product = $this->load_model("Product");
		$category = $this->load_model("Category");
		
		$tbl_rows = $product->make_table($products,$category);
		$data['tbl_rows'] = $tbl_rows;
		$data['categories'] = $categories;
		$data['brands'] = $brands;
	 
		$data['page_title'] = "Admin - Products";
		$data['current_page'] = "products";
		$this->view("admin/products",$data);
	}

 	public function orders()
	{
		$User = $this->load_model('User');
		$Order = $this->load_model('Order');

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}


		$orders = $Order->get_all_orders();

		if(is_array($orders)){
			foreach ($orders as $key => $row) {
				# code...
				$details = $Order->get_order_details($row->id);
				$orders[$key]->grand_total = 0;

				if(is_array($details)){
					$totals = array_column($details, "total");
					$grand_total = array_sum($totals);
					$orders[$key]->grand_total = $grand_total;
				}

				$orders[$key]->details = $details;

				$user = $User->get_user($row->user_url);
				$orders[$key]->user = $user;
			}
		}

		$data['orders'] = $orders;

		$data['page_title'] = "Admin - Orders";
		$data['current_page'] = "orders";
		$this->view("admin/orders",$data);
	}

	function users($type = "customers"){

		$User = $this->load_model('User');
		$Order = $this->load_model('Order');

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		if($type == "admins"){
			$users = $User->get_admins();
		}else{
			$users = $User->get_customers();
		}

		if(is_array($users)){
			foreach ($users as $key => $row) {
				# code...
				$orders_num = $Order->get_orders_count($row->url_address);
				$users[$key]->orders_count = $orders_num;
			}
		}
		

		$data['users'] = $users;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "users";
		$this->view("admin/users",$data);
	}

	function settings($type = '')
	{

		$User = $this->load_model('User');
		$Settings = new Settings();

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//select the right page
		if($type == "socials"){

			if(count($_POST) > 0)
			{
				$errors = $Settings->save_settings($_POST);
				header(("Location: " . ROOT . "admin/settings/socials"));
				die;
			}

			$data['settings'] = $Settings->get_all_settings();
		}else
		if($type == "slider_images"){

			$Slider = $this->load_model('Slider');
			$data['action'] = "show";

			//read all slider images
			$data['rows'] = $Slider->get_all();
			
			if(isset($_GET['action']) && $_GET['action'] == "add"){

				$data['action'] = "add";

				//if new row was posted
				if(count($_POST) > 0)
				{
					$Image = $this->load_model('Image');
					$data['errors'] = $Slider->create($_POST,$_FILES,$Image);
					
					$data['POST'] = $_POST;
					header(("Location: " . ROOT . "admin/settings/slider_images"));
					die;
				}

			}else
			if(isset($_GET['action']) && $_GET['action'] == "edit"){
				$data['action'] = "edit";
				$data['id'] = null;
				if(isset($_GET['id'])){
					$data['id'] = $_GET['id'];
				}


			}else
			if(isset($_GET['action']) && $_GET['action'] == "delete"){

			}else
			if(isset($_GET['action']) && $_GET['action'] == "delete_comfirmed"){

			}
		}

		$data['type'] = $type;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "settings";
		$this->view("admin/settings",$data);
	}

	function messages($type = ''){

		$type = 'Messages';

		$User = $this->load_model('User');
		$Message = $this->load_model('Message');

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$mode = "read";
		if(isset($_GET['delete'])){
			$mode = "delete";
		}

		if(isset($_GET['delete_confirmed'])){
			$mode = "delete_confirmed";
			$id = $_GET['delete_confirmed'];
			$messages = $Message->delete($id);
		}


  
  		if($mode == "delete"){
  			$id = $_GET['delete'];
			$messages = $Message->get_one($id);
  		}else{
			$messages = $Message->get_all();
  		}

		$data['mode'] = $mode;
		$data['messages'] = $messages;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "messages";
		$this->view("admin/messages",$data);
	}

	function blogs($type = ''){

		
		$type = 'Blog Posts';
		
		$User = $this->load_model('User');
		$post_class = $this->load_model('post');
		$image_class = $this->load_model('Image');

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$mode = "read";
		if(isset($_GET['delete'])){
			$mode = "delete";
		}
		
		if(isset($_GET['add_new'])){
			$mode = "add_new";
		}
		
		if(isset($_GET['edit'])){
			$mode = "edit";
		}

		if(isset($_GET['delete_confirmed'])){
			$mode = "delete_confirmed";
			$id = $_GET['delete_confirmed'];
			$posts = $post_class->delete($id);
		}

  
  		if($mode == "edit"){
  			$id = $_GET['edit'];
			$blogs = $post_class->get_one($id);
 
			$data['POST'] = (array)$blogs;

  		}else
  		if($mode == "delete"){
  			$id = $_GET['delete'];
			$blogs = $post_class->get_one($id);

			if($blogs){
				if(file_exists($blogs->image)){
					$blogs->image = $image_class->get_thumb_post($blogs->image);
				}

				$blogs->user_data = $User->get_user($blogs->user_url);
			}

			$data['POST'] = (array)$blogs;

  		}else{
			$blogs = $post_class->get_all();
			if($blogs){
			foreach ($blogs as $key => $row) {
					# code...
					if(file_exists($blogs[$key]->image)){
						$blogs[$key]->image = $image_class->get_thumb_post($blogs[$key]->image);
					}

					$blogs[$key]->user_data = $User->get_user($blogs[$key]->user_url);
				}
			}

  		}

  		//if something was posted
  		if(count($_POST) > 0)
  		{
  			$post = $this->load_model('post');
  			$image_class = $this->load_model('image');
  			
  			if($mode == "edit"){
  				$post_class->edit($_POST,$_FILES,$image_class);
  			}else{
  				$post_class->create($_POST,$_FILES,$image_class);
  			}
  		
  			if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
  				$data['errors'] = $_SESSION['error'];
  				$data['POST'] = $_POST;
  			}else{
  				redirect("admin/blogs");
  			}
  		}

		$data['mode'] = $mode;
		$data['blogs'] = $blogs;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "blogs";
		$this->view("admin/blogs",$data);
	}

}