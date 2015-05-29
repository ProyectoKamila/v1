<?php
class save_img extends CI_Model 
{	
	function __construct() 
	{
		parent::__construct();
	}
	
	public function save($title, $url, $id_user)
	{
		$this->db->set('id_user', $id_user);
		$this->db->set('title', $title);
		$this->db->set('image', $url);
		$this->db->insert('images');
	}
}
?>