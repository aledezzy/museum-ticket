<?php 

Class Settings
{
	public $error = array();
	protected static $SETTINGS = null;

	public function get_all_settings()
	{
	
		$db = Database::newInstance();
		$query = "select * from settings";
		return $db->read($query);
	}

	static function __callStatic($name, $params)
	{
		if(self::$SETTINGS){

			$settings = self::$SETTINGS;
		}else{
			$settings = self::get_all_settings_as_object();
		}
		
		if(isset($settings->$name)){
			return $settings->$name;
		}

		return "";
	}

	public static function get_all_settings_as_object()
	{
		$db = Database::newInstance();
		$query = "select * from settings";
		$data = $db->read($query);

		$settings = (object)[];
		if(is_array($data)){
			foreach ($data as $row) {
				# code...
				$setting_name = $row->setting;
				$settings->$setting_name = $row->value;
			}
		}

		self::$SETTINGS = $settings;
		return $settings;
	}

	public function save_settings($POST)
	{

		$this->$error = array();

		$db = Database::newInstance();
		
		foreach ($POST as $key => $value) {
			# code...
			$arr = array();
			$arr['setting'] = $key;

			if(strstr($key, "_link")){

				if(trim($value) != "" && !strstr($value, "https://")){
					$value = "https://" . $value;
				}

				$arr['value'] = $value;

			}else{
				$arr['value'] = $value;
			}

			$query = "update settings set value = :value where setting = :setting limit 1";
			$db->write($query,$arr);
			
		}

		return $this->$error;
	}
}
