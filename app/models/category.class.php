<?php 

Class Category
{


	public function create($DATA)
	{

		$DB = Database::newInstance(); 
		$arr['category'] 	= ucwords($DATA->category);
		$arr['parent'] 		= ucwords($DATA->parent);

		if(!preg_match("/^[a-zA-Z ]+$/", trim($arr['category'])))
		{
			$_SESSION['error'] = "Please enter a valid category name";
		}

		if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
			$query = "insert into categories (category,parent) values (:category,:parent)";
			$check = $DB->write($query,$arr);

			if($check){
				return true;
			}
		}

		return false;

	}

	public function edit($data)
	{
		$DB = Database::newInstance();
		$arr['id'] = $data->id;
		$arr['category'] = $data->category;
		$arr['parent'] = $data->parent;
		$query = "update categories set category = :category, parent = :parent where id = :id limit 1";
		$DB->write($query,$arr);
	}

	public function delete($id)
	{ 

		$DB = Database::newInstance();
		$id = (int)$id;
		$query = "delete from categories where id = '$id' limit 1";
		$DB->write($query);
	}

	public function get_all()
	{

		$limit = 10;
		$offset = Page::get_offset($limit);

		$DB = Database::newInstance();
		return $DB->read("select * from categories order by views desc limit $limit offset $offset");

	}

	public function get_one($id)
	{

		$id = (int)$id;

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where id = '$id' limit 1");
		return $data[0];
	}

	public function get_one_by_name($name)
	{

		$name = addslashes($name);

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where category like :name limit 1",["name"=>$name]);
		
		if(is_array($data)){
			$DB->write("update categories set views = views + 1 where id = :id limit 1",["id"=>$data[0]->id]);
		}
		
		return $data[0];
	}

	

	public function make_table($cats)
	{

		$result = "";
		if(is_array($cats)){
			foreach ($cats as $cat_row) {
				# code...

				$color = $cat_row->disabled ? "#ae7c04" : "#5bc0de";
				$cat_row->disabled = $cat_row->disabled ? "Disabled" : "Enabled";
				
				$args = $cat_row->id.",'".$cat_row->disabled."'";
				$edit_args = $cat_row->id.",'".addslashes($cat_row->category)."',".$cat_row->parent;
				$parent = "";
				
				foreach ($cats as $cat_row2) {
					if($cat_row->parent == $cat_row2->id){
						$parent = $cat_row2->category;
					}
				}

 				$result .= "<tr>";
				
					$result .= '
						<td><a href="basic_table.html#">'.$cat_row->category.'</a></td>
						<td><a href="basic_table.html#">'.$parent.'</a></td>
	                  <td><span  onclick="disable_row('.$args.')"  class="label label-info label-mini" style="cursor:pointer;background-color:'.$color.';">'.$cat_row->disabled.'</span></td>
	                  <td>
	                      
	                      <button onclick="show_edit_category('.$edit_args.',event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
	                      <button onclick="delete_row('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
	                  </td>
					';
						
				$result .= "</tr>";
			}
		}

		return $result;
	}






}