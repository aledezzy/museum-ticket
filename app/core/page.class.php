<?php

/**
 * for pagination
 */
class Page
{

	public static function get_offset($limit)
	{

		$limit = (int)$limit;
		$page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1 ;
		$page_number = $page_number < 1 ? 1 : $page_number;
		return ($page_number - 1) * $limit;
	}

	public static function show_links()
	{
		?>
		<br style="clear: both;">
		<ul class="pagination">
			<li><a href="<?=self::links()->prev?>">Prev</a></li>
				<?php
					$max = self::links()->current + 5;
					$cur = (self::links()->current > 5) ? self::links()->current - 5 : 1;

				?>
				<?php for ($i=$cur; $i < $max; $i++):?> 
				 
					<li <?=(self::links()->current == $i) ? 'class="active"' : '';?>><a href="<?=self::generate($i)?>"><?=$i?></a></li>
						<!--<li><a href="">&raquo;</a></li>-->
					
				<?php endfor;?>

			<li><a href="<?=self::links()->next?>">Next</a></li>
		</ul>
		<?php 
	}


	public static function generate($number)
	{

		$number = (int)$number;
		$query_string = str_replace("url=", "", $_SERVER['QUERY_STRING']);

		$current_link = ROOT . $query_string;
		if(!strstr($query_string, "pg=")){
			$current_link .= "&pg=1";
		}

		return preg_replace("/pg=[^&?=]+/", "pg=" . $number, $current_link);
	}

	public static function links()
	{
		$links = (object)[];

		$links->prev = "";
		$links->next = "";
		$query_string = str_replace("url=", "", $_SERVER['QUERY_STRING']);

		$page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1 ;
		$page_number = $page_number < 1 ? 1 : $page_number;

		$next_page = $page_number + 1;
		$prev_page = ($page_number > 1) ? $page_number - 1 : 1;

		$current_link = ROOT . $query_string;
		if(!strstr($query_string, "pg=")){
			$current_link .= "&pg=1";
		}

		$links->prev = preg_replace("/pg=[^&?=]+/", "pg=" . $prev_page, $current_link);
		$links->next = preg_replace("/pg=[^&?=]+/", "pg=" . $next_page, $current_link);
		$links->current = $page_number;
		
		return $links;
	}

}