<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getSubMenu($id = null)
	{
		if($id) :
			$sql = "SELECT submenu.*, menu.menu_name
			FROM submenu JOIN menu
			ON submenu.menu_id = menu.id AND submenu.id = '$id'";

			return $this->db->query($sql)->row_array();
		else:
			$sql = "SELECT submenu.*, menu.menu_name
			FROM submenu JOIN menu
			ON submenu.menu_id = menu.id";

		return $this->db->query($sql)->result_array();
		endif;
	}

	public function first($table, $key, $value)
	{
		$this->db->where($key, $value); #memfilter/mendapatkan satu data.
		$sql = $this->db->get($table);
		return $this->check_sql($sql);
	}

	public function check_sql($sql) 
	{
		if ($sql->num_rows() > 0) :
			return $sql;
		else:
			return NULL;
		endif;
	}

	public function update($key, $value, $data, $table)
	{
		$this->db->where($key, $value);
		$this->db->update($table, $data);
	}

	public function delete($key, $value, $table)
	{
		$this->db->where($key, $value);
		$this->db->delete($table);
	}

}