<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_model extends CI_Model {
	/*
	* 	 args['set'] = insert values. array.
	*	 args['table'] = insert target table.
	*/
	public function insert($args) {
		$this->db->set($args['set']);
		$this->db->insert($args['table']);
	}
}
?>
