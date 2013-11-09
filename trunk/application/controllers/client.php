<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class client extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> library('xmlrpc');

		$server_url = site_url('server');
		$this -> xmlrpc -> server($server_url, 80);
	}

	function index() {
		$this -> xmlrpc -> method('getPost');
		//$this->xmlrpc->set_debug(TRUE);
		if (!$this -> xmlrpc -> send_request()) {
			echo $this -> xmlrpc -> display_error();

		} else {
			//echo '<pre>';
			print_r($this -> xmlrpc -> display_response());
			//echo '</pre>';
		}
	}

}
?>